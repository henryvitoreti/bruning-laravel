<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove non-numeric characters
        $document = preg_replace('/[^0-9]/', '', $value);

        // Check if the CPF has 11 digits
        if (strlen($document) != 11) {
            $fail(__('The provided Document is invalid.'));
            return;
        }

        // Check if all digits are the same (invalid CPF)
        if (preg_match('/(\d)\1{10}/', $document)) {
            $fail(__('The provided Document is invalid.'));
            return;
        }

        // Calculate the first verification digit
        for ($i = 9, $j = 0, $sum = 0; $i > 0; $i--, $j++) {
            $sum += $document[$j] * $i;
        }
        $remainder = $sum % 11;
        $firstDigit = ($remainder < 2) ? 0 : 11 - $remainder;

        // Calculate the second verification digit
        for ($i = 10, $j = 0, $sum = 0; $i > 1; $i--, $j++) {
            $sum += $document[$j] * $i;
        }
        $sum += $firstDigit * 2;
        $remainder = $sum % 11;
        $secondDigit = ($remainder < 2) ? 0 : 11 - $remainder;

        // Check if the verification digits are correct
        if ($document[9] != $firstDigit || $document[10] != $secondDigit) {
            $fail(__('The provided Document is invalid.'));
        }
    }
}
