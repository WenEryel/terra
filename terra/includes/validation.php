<?php

const EMAIL_REGEX    = '/^[A-Za-z0-9._%+\-]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*\.[A-Za-z]{2,}$/';

const NAME_REGEX     = '/^(?!.*[A-Z]{2})(?!.*\s{2,})(?!\s)(?!.*\s$)[A-Za-z\s]+$/';
// At least one letter and one number.
const PASSWORD_REGEX = '/^(?=.*[A-Za-z])(?=.*\d).+$/';

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function field_error(array $errors, string $key, string $for): void
{
    if (isset($errors[$key])) {
        echo '<label class="error" for="' . e($for) . '">' . e($errors[$key]) . '</label>';
    }
}

function input_class(array $errors, string $key): string
{
    return isset($errors[$key]) ? 'error' : '';
}
