<?php

declare(strict_types=0);

namespace Intellicore\Pin;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Pin
{
    public array $data = [];

    public function generate(int $length = null): string
    {
        $length = $this->getDefaultLength($length);
        $pin    = $this->makePin($length);

        if ($this->validPin($pin)) {
            $this->generate($length);
        }

        $values[] = cache('pins');
        foreach ($values as $val) {
            if ($val === $pin) {
                return false;
            } else {
                $this->cachePin($pin);
            }
        }

        return $pin;
    }

    public function validPin(string $pin): bool
    {
        if ($this->isPalindrome($pin)) {
            return false;
        }

        if ($this->isSequential($pin)) {
            return false;
        }

        if ($this->isPinDigitRepeated($pin)) {
            return false;
        }

        return true;
    }

    protected function makePin($length = 4): string
    {
        $start = str_pad('1', $length, "0");
        $end   = str_pad('7', $length, "7");

        return mt_rand((int) $start, (int) $end);
    }

    protected function isPalindrome(string $pin): bool
    {
        return strrev($pin) === $pin;
    }

    protected function isSequential(string $pin): bool
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

    protected function isPinDigitRepeated(string $pin): bool
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

    public function cachePin(string $pin): mixed
    {
        $this->data[] = $pin;
        $values       = Cache::put('pins', $this->data);
        return cache()->remember('pins', 3, function () use ($values) {
            return $values;
        });
    }

    protected function getDefaultLength($length)
    {
        if ($length === null) {
            return config('pin.length');
        }
        return $length;
    }

    public function pins(): array
    {
        return cache('pins');
    }
}
