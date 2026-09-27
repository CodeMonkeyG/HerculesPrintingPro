<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Webkul\Shop\Mail\ContactUs;
use Webkul\Customer\Facades\Captcha;
use Throwable;

class ContactController extends Controller
{
    /**
     * Handle contact form submissions from the custom frontend.
     */
    public function send(Request $request): JsonResponse
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'service' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];

        if (Captcha::isActive()) {
            $rules['captchaToken'] = ['required', 'captcha'];
        } else {
            $rules['captchaToken'] = ['nullable', 'string'];
        }

        $validated = $request->validate($rules);

        // Always log all submission details immediately so data is never lost
        Log::info('Contact form submission received from ' . $validated['email'], [
            'event'        => 'contact_form_submission',
            'site'         => 'HerculesPrintingPro',
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'service'      => $validated['service'] ?? null,
            'message'      => $validated['message'],
            'ip'           => $request->ip(),
            'user_agent'   => $request->userAgent(),
            'referer'      => $request->header('referer'),
            'submitted_at' => now()->toIso8601String(),
        ]);

        $message = $validated['message'];

        if (! empty($validated['service'])) {
            $message = "Service Requested: {$validated['service']}\n\n{$message}";
        }

        try {
            Mail::send(new ContactUs([
                'name'    => $validated['name'],
                'email'   => $validated['email'],
                'contact' => $validated['service'] ?? null,
                'message' => $message,
            ]));

            Log::info('Contact form email dispatched successfully', [
                'event'        => 'contact_email_sent',
                'site'         => 'HerculesPrintingPro',
                'sender_email' => $validated['email'],
            ]);
        } catch (Throwable $e) {
            Log::error('Contact form email failed to dispatch: ' . $e->getMessage(), [
                'event'        => 'contact_email_failed',
                'site'         => 'HerculesPrintingPro',
                'sender_email' => $validated['email'],
                'exception'    => $e,
            ]);
        }

        return response()->json([
            'message' => 'Thank you! Your quote request has been sent.',
        ]);
    }
}
