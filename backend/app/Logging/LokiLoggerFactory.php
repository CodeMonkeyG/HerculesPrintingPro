<?php

namespace App\Logging;

use Monolog\Logger;

class LokiLoggerFactory
{
    /**
     * Create a custom Monolog instance.
     */
    public function __invoke(array $config): Logger
    {
        $logger = new Logger('loki');
        $host = $config['host'] ?? env('LOKI_HOST', 'inqed-loki');
        $port = (int) ($config['port'] ?? env('LOKI_PORT', 3100));
        $level = $config['level'] ?? env('LOG_LEVEL', 'debug');
        $appName = $config['app'] ?? env('LOKI_APP_NAME', config('app.name', 'HerculesPrintingPro'));

        $handler = new LokiHandler($host, $port, $level, true, $appName);
        $logger->pushHandler($handler);

        return $logger;
    }
}
