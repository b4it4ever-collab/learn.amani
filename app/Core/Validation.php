<?php

namespace App\Core;

class Validation
{
    public static function make(array $data, array $rules): array
    {
        $errors = [];

        foreach ($rules as $field => $fieldRules) {
            $fieldRules = is_array($fieldRules) ? $fieldRules : explode('|', $fieldRules);
            $value = $data[$field] ?? null;

            foreach ($fieldRules as $rule) {
                $params = [];
                if (str_contains($rule, ':')) {
                    [$rule, $paramsString] = explode(':', $rule, 2);
                    $params = array_map('trim', explode(',', $paramsString));
                }

                if ($rule === 'required' && self::isEmpty($value)) {
                    $errors[$field][] = 'The ' . $field . ' field is required.';
                    continue;
                }

                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = 'The ' . $field . ' field must be a valid email address.';
                }

                if ($rule === 'min' && is_string($value) && mb_strlen($value) < (int) ($params[0] ?? 0)) {
                    $errors[$field][] = 'The ' . $field . ' field must be at least ' . $params[0] . ' characters.';
                }

                if ($rule === 'same' && ($value ?? '') !== ($data[$params[0] ?? ''] ?? '')) {
                    $errors[$field][] = 'The ' . $field . ' field must match ' . ($params[0] ?? 'the confirmation field') . '.';
                }
            }
        }

        return $errors;
    }

    private static function isEmpty(mixed $value): bool
    {
        return $value === null || $value === '' || $value === [];
    }
}
