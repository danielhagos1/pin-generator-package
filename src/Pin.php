<?php

declare(strict_types=0);

namespace Intellicore\Pin;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Pin
{
    public function validPin($length = 4): bool
    {
        $pin = $this->makePin($length);

        if ($this->isPalindrome($pin) || !$this->isSequential($pin) || $this->isPinDigitRepeated($pin)) {
            return true;
        }

        return false;
    }

    public function generate($length = 4): bool
    {
        $pin = $this->validPin($length);

        if ($pin) {
            return $this->generate($length);
        }

        $this->cachePin($pin);

        return $pin;
    }

    public function makePin($length = 4): string
    {
        $start = str_pad('1', $length, "0");
        $end   = str_pad('7', $length, "7");

        return mt_rand((int) $start, (int) $end);
    }

    public function isPalindrome(string $pin): bool
    {
        return strrev($pin) === $pin;
    }

    public function isSequential(string $pin): bool
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

    public function isPinDigitRepeated(string $pin): bool
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

    public function cachePin(string $pin): bool
    {
        //store the pin if not already present
        return Cache::add('pin', $pin);
    }
}
