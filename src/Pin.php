<?php

declare(strict_types=0);

namespace Intellicore\Pin;

class Pin
{
    public function generate($length = 4)
    {

        $pin = $this->standardPin();

        if ($this->isPalindrome($pin) || $this->isSequential($pin) || $this->isPinDigitRepeated($pin)) {
            $this->generate($length);
        };

        return $pin;
    }

    public function standardPin($length = 4)
    {
        $start = str_pad(1, $length, "0");
        $end   = str_pad(7, $length, "7");

        $pin = mt_rand((int) $start, (int) $end);

        return $pin;
    }

    public function isPalindrome(string $pin)
    {
        return strrev($pin) === $pin;
    }

    public function isSequential(string $pin)
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
                return false;
            }

            $previousPart = $part;
        }

        return true;
    }
}
