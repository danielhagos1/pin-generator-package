<?php

declare(strict_types=1);

namespace Intellicore\Pin;

class Pin
{
    public static function generatePins(string $pin)
    {
        $pin = mt_rand(1000, 9999);
        $newPin = (string)$pin;
        if (self::isPalindrome($newPin) && self::isSequential($newPin) && self::isPinDigitRepeated($newPin)) {
            return true;
        } else {
            return false;
        }
    }

    public static function isPalindrome(string $pin)
    {
        $temp = strrev($pin);
        if ($temp == $pin) {
            return true;
        } else {
            return false;
        }
    }

    public static function isSequential($pin)
    {
        $pinDigits = str_split($pin);

        $previousDigit = null;

        foreach ($pinDigits as $pin) {
            if (!$previousDigit) {
                $previousDigit = $pin;
                continue;
            }

            if ($pin == $previousDigit) {
                return false;
            }

            if ($pin == (integer)$previousDigit + 1) {
                return false;
            }

            $previousDigit = $pin;
        }

        return true;
    }

    public static function isPinDigitRepeated(string $pin)
    {
        $parts = str_split($pin);

        $previousPart = null;

        foreach ($parts as $part) {
            if (!$previousPart) {
                $previousPart = $part;
                continue;
            }

            if ($part == $previousPart) {
                return true;
            }

            $previousPart = $part;
        }

        return false;
    }
}
