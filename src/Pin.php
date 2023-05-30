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

        $values[] = $this->pins();
        foreach ($values as $val) {
            if ($val !== $pin) {
                $this->cachePin($pin);
            }
        }

        return $pin;
    }

    public function validPin(string $pin): bool
    {
        if ($this->isPalindrome($pin) || !$this->isSequential($pin) || $this->isPinDigitRepeated($pin)) {
            return true;
        } else {
            return false;
        }
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
                return true;
            }

            $previousDigit = $pin;
        }

        return true;
    }

    public function isPinDigitRepeated(string $pin, $unique = 3)
    {
        if (count(count_chars($pin, 1)) < $unique) {
            return false;
        }
        return true;
    }

    public function cachePin(string $pin): mixed
    {
        $this->data[] = $pin;
        $values       = Cache::forever("pins", $this->data);
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
        return $this->data;
    }
}
