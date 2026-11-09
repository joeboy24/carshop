<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\RateLimiter;

class InquiryGuard
{
    public static function token(): string
    {
        return Crypt::encryptString((string) now()->timestamp);
    }

    /**
     * Return a visitor-facing reason to stop, "quiet" when a bot should see success, or null to allow the send.
     */
    public static function rejection(Request $request): ?string
    {
        if (trim((string) $request->input('company_url')) !== '') {
            return 'quiet';
        }

        $tokenError = self::tokenError($request);
        if ($tokenError) {
            self::hitIp($request);
            return $tokenError;
        }

        if (preg_match_all('#https?://#i', (string) $request->input('message')) >= 3) {
            self::hitIp($request);
            return 'Please send the message with fewer links.';
        }

        if (self::limited($request)) {
            return 'Too many messages from this connection. Please wait a few minutes and try again.';
        }

        return null;
    }

    public static function record(Request $request): void
    {
        self::hitIp($request);

        $email = strtolower(trim((string) $request->input('email')));
        if ($email !== '') {
            RateLimiter::hit('inquire-mail:'.$email, 3600);
        }

        $message = strtolower(trim((string) $request->input('message')));
        if ($message !== '') {
            RateLimiter::hit('inquire-body:'.sha1($message), 3600);
        }
    }

    private static function tokenError(Request $request): ?string
    {
        try {
            $opened = (int) Crypt::decryptString((string) $request->input('opened'));
        } catch (\Throwable $e) {
            return 'Please reload the page and send the message again.';
        }

        $age = now()->timestamp - $opened;
        if ($age < 3) {
            return 'Please take a moment to review your message, then send it again.';
        }
        if ($age > 60 * 60 * 6) {
            return 'This form has expired. Reload the page and send the message again.';
        }

        return null;
    }

    private static function limited(Request $request): bool
    {
        if (RateLimiter::tooManyAttempts(self::ipKey($request), 3)) {
            return true;
        }

        $email = strtolower(trim((string) $request->input('email')));
        if ($email !== '' && RateLimiter::tooManyAttempts('inquire-mail:'.$email, 3)) {
            return true;
        }

        $message = strtolower(trim((string) $request->input('message')));
        if ($message !== '' && RateLimiter::tooManyAttempts('inquire-body:'.sha1($message), 2)) {
            return true;
        }

        return false;
    }

    private static function hitIp(Request $request): void
    {
        RateLimiter::hit(self::ipKey($request), 900);
    }

    private static function ipKey(Request $request): string
    {
        return 'inquire-ip:'.$request->ip();
    }
}
