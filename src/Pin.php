<?php

declare(strict_types=1);

namespace Intellicore\Pin;

class Pin
{
    public function generate($pin)
    {
        switch ($pin) {
            case 4:
                $pin    = mt_rand(1000, 9999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(4);
                };
                break;
            case 5:
                $pin    = mt_rand(10000, 99999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(5);
                };
                break;
            case 6:
                $pin    = mt_rand(100000, 999999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(6);
                };
                break;
            case 7:
                $pin    = mt_rand(1000000, 9999999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(7);
                };
                break;
            case 8:
                $pin    = mt_rand(10000000, 99999999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(8);
                };
                break;
            case 9:
                $pin    = mt_rand(100000000, 999999999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(9);
                };
                break;
            case 10:
                $pin    = mt_rand(1000000000, 9999999999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(10);
                };
                break;
            case 11:
                $pin    = mt_rand(10000000000, 99999999999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(11);
                };
                break;
            case 12:
                $pin    = mt_rand(100000000000, 999999999999);
                $newPin = (string) $pin;
                if ($this->isPalindrome($newPin) && $this->isSequential($newPin) && $this->isPinDigitRepeated($newPin)) {
                    $this->generate(12);
                };
                break;
        }
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
