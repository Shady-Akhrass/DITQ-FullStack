<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SanitizeErrorResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Only handle JSON responses
        if (!$response instanceof \Illuminate\Http\JsonResponse) {
            return $response;
        }

        $data = $response->getData(true);
        
        // Sanitize error messages to prevent API key exposure
        if (isset($data['error']) && is_string($data['error'])) {
            $originalError = $data['error'];
            $data['error'] = $this->sanitizeErrorMessage($originalError);
            
            // Log the original error for debugging
            if ($originalError !== $data['error']) {
                Log::warning('Sanitized error message to prevent API key exposure', [
                    'original' => $originalError,
                    'sanitized' => $data['error'],
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                ]);
            }
        }

        if (isset($data['message']) && is_string($data['message'])) {
            $originalMessage = $data['message'];
            $data['message'] = $this->sanitizeErrorMessage($originalMessage);
            
            // Log the original message for debugging
            if ($originalMessage !== $data['message']) {
                Log::warning('Sanitized message to prevent API key exposure', [
                    'original' => $originalMessage,
                    'sanitized' => $data['message'],
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                ]);
            }
        }

        // Sanitize nested error details
        if (isset($data['details']) && is_string($data['details'])) {
            $originalDetails = $data['details'];
            $data['details'] = $this->sanitizeErrorMessage($originalDetails);
            
            // Log the original details for debugging
            if ($originalDetails !== $data['details']) {
                Log::warning('Sanitized error details to prevent API key exposure', [
                    'original' => $originalDetails,
                    'sanitized' => $data['details'],
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                ]);
            }
        }

        $response->setData($data);
        return $response;
    }

    /**
     * Sanitize error message to prevent API key exposure
     *
     * @param string $message
     * @return string
     */
    private function sanitizeErrorMessage($message)
    {
        // List of patterns that might indicate API keys or secrets
        $sensitivePatterns = [
            '/sk_test_[a-zA-Z0-9]+/', // Stripe test keys
            '/sk_live_[a-zA-Z0-9]+/',  // Stripe live keys
            '/whsec_[a-zA-Z0-9]+/',    // Stripe webhook secrets
            '/api[_-]?key/i',
            '/secret[_-]?key/i',
            '/private[_-]?key/i',
            '/access[_-]?token/i',
            '/bearer[_-]?token/i',
            '/password/i',
            '/credential/i',
            '/auth[_-]?token/i',
        ];

        $sanitized = $message;

        // Replace sensitive patterns with generic message
        foreach ($sensitivePatterns as $pattern) {
            if (preg_match($pattern, $sanitized)) {
                return 'هناك خطأ في البيانات الخاصة في ال api key';
            }
        }

        // Check for common error patterns that might expose sensitive data
        if (
            stripos($sanitized, 'stripe') !== false ||
            stripos($sanitized, 'authentication') !== false ||
            stripos($sanitized, 'unauthorized') !== false ||
            stripos($sanitized, 'forbidden') !== false ||
            stripos($sanitized, 'invalid api') !== false
        ) {
            return 'هناك خطأ في البيانات الخاصة في ال api key';
        }

        return $sanitized;
    }
}
