<?php

namespace App\Core;

class Csrf
{
    public static function token(Session $session): string
    {
        $token = $session->get('_csrf_token');
        if (!$token) {
            $token = bin2hex(random_bytes(32));
            $session->set('_csrf_token', $token);
        }

        return $token;
    }

    public static function validate(Session $session, Request $request): bool
    {
        $tokenFromSession = $session->get('_csrf_token');
        $tokenFromRequest = $request->input('_token');

        return is_string($tokenFromSession) && is_string($tokenFromRequest) && hash_equals($tokenFromSession, $tokenFromRequest);
    }
}
