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
            $fail('O CPF informado é inválido.');
            return;
        }

        // Check if all digits are the same (invalid CPF)
        if (preg_match('/(\d)\1{10}/', $document)) {
            $fail('O CPF informado é inválido.');
            return;
        }

        // Calculate the first verification digit
        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--) {
            $sum += $document[$i] * $j;
        }
        $remainder = $sum % 11;
        $firstDigit = ($remainder < 2) ? 0 : 11 - $remainder;

        // Calculate the second verification digit
        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--) {
            $sum += $document[$i] * $j;
        }
        $remainder = $sum % 11;
        $secondDigit = ($remainder < 2) ? 0 : 11 - $remainder;

        // Check if the verification digits are correct
        if ($document[9] != $firstDigit || $document[10] != $secondDigit) {
            $fail('O CPF informado é inválido.');
        }
    }
}
