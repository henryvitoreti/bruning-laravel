<?php

namespace App\Helpers;

use Carbon\Carbon;

class StringHelper
{
    /**
     * @param string $item
     * @return string
     */
    public static function onlyNumbers(string $item): string
    {
        return preg_replace('/[^0-9]/', '', $item);
    }

    public static function formatDate(string $date, string $format = 'd/m/Y'): string
    {
        return Carbon::createFromFormat($format, $date)->format('Y-m-d');
    }

    /**
     * @param $document
     * @return string|null
     */
    public static  function formatDocument($document): ?string
    {
        $document = preg_replace('/[^0-9]/', '', $document);

        if (strlen($document) != 11) {
            return null;
        }

        return substr($document, 0, 3) . '.' .
            substr($document, 3, 3) . '.' .
            substr($document, 6, 3) . '-' .
            substr($document, 9, 2);
    }
}
