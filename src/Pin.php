<?php

declare(strict_types=0);

namespace Intellicore\Pin;

class Pin
{
    public function generate($length = 4)
    {
        $start = str_pad(1, $length, "0");
        $end   = str_pad(12, $length, "12");

        $pin = mt_rand($start, $end);

        if ($this->isPalindrome($pin) || $this->isSequential($pin) || $this->isPinDigitRepeated($pin)) {
            $this->generate($pin);
        };

        return $pin;
    }

    public function isPalindrome(string $pin)
    {
        return strrev($pin) === $pin;
    }

    public function isSequential($pin)
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

            if ($pin == (integer) $previousDigit + 1) {
                return false;
            }

            $previousDigit = $pin;
        }

        return true;
    }

    public function isPinDigitRepeated(string $pin)
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
