<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Webkul\Shop\Mail\ContactUs;
use Webkul\Customer\Facades\Captcha;

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

        $message = $validated['message'];

        if (! empty($validated['service'])) {
            $message = "Service Requested: {$validated['service']}\n\n{$message}";
        }

        Mail::send(new ContactUs([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'contact' => $validated['service'] ?? null,
            'message' => $message,
        ]));

        return response()->json([
            'message' => 'Thank you! Your quote request has been sent.',
        ]);
    }
}
