<?php

namespace App\Logging;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use Monolog\Level;
use GuzzleHttp\Client;
use Throwable;

class LokiHandler extends AbstractProcessingHandler
{
    protected string $host;
    protected int $port;
    protected string $appName;
    protected ?Client $client = null;

    public function __construct(
        string $host = 'inqed-loki',
        int $port = 3100,
        int|string|Level $level = Level::Debug,
        bool $bubble = true,
        ?string $appName = null
    ) {
        parent::__construct($level, $bubble);
        $this->host = $host;
        $this->port = $port;
        $this->appName = $appName ?? config('app.name', 'HerculesPrintingPro');
    }

    protected function getClient(): Client
    {
        if ($this->client === null) {
            $this->client = new Client([
                'base_uri' => "http://{$this->host}:{$this->port}",
                'timeout' => 1.5,
                'connect_timeout' => 1.0,
                'http_errors' => false,
            ]);
        }
        return $this->client;
    }

    /**
     * Writes the record down to the log of the implementing handler.
     */
    protected function write(LogRecord $record): void
    {
        try {
            $timestampNano = $record->datetime->format('U') . str_pad($record->datetime->format('u'), 6, '0') . '000';

            $payloadContext = $record->context;
            if (isset($payloadContext['exception']) && $payloadContext['exception'] instanceof Throwable) {
                $e = $payloadContext['exception'];
                $payloadContext['exception'] = [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                    'file' => $e->getFile().':'.$e->getLine(),
                    'trace' => array_slice(explode("\n", $e->getTraceAsString()), 0, 10),
                ];
            }

            $userId = null;
            try {
                $userId = auth()->id() ?? $payloadContext['user_id'] ?? null;
            } catch (Throwable) {}

            $correlationId = 'N/A';
            try {
                $correlationId = $payloadContext['correlation_id'] ?? request()?->attributes?->get('correlation_id') ?? 'N/A';
            } catch (Throwable) {}

            $logData = [
                'message' => $record->message,
                'level' => strtolower($record->level->name),
                'channel' => $record->channel,
                'correlation_id' => $correlationId,
                'user_id' => $userId,
                'context' => $payloadContext,
                'extra' => $record->extra,
                'datetime' => $record->datetime->format('c'),
            ];

            $jsonMessage = json_encode($logData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            $body = [
                'streams' => [
                    [
                        'stream' => [
                            'app' => $this->appName,
                            'env' => config('app.env', 'local'),
                            'level' => strtolower($record->level->name),
                            'channel' => $record->channel,
                        ],
                        'values' => [
                            [$timestampNano, $jsonMessage],
                        ],
                    ],
                ],
            ];

            $this->getClient()->post('/loki/api/v1/push', [
                'json' => $body,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
            ]);
        } catch (Throwable) {
            // Loki log push failure should never crash the user application request
        }
    }
}
