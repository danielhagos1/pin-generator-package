<?php

declare(strict_types=0);

namespace Intellicore\Pin;

use Illuminate\Database\Eloquent\Collection;
use Intellicore\Pin\Models\PinModel;

class Pin
{
    public array $data = [];

    public function generate(int $length = null): string
    {
        $length = $this->getDefaultLength($length);
        $pin    = $this->makePin($length);

        if (!$this->validPin($pin)) {
            $this->generate($length);
        }

        $values = $this->getAllPins();
        if ($values->isNotEmpty()) {
            foreach ($values as $val) {
                if ($val !== $pin) {
                    $this->savePin($pin);
                }
            }
        }

        return $pin;
    }

    public function validPin(string $pin): bool
    {
        if ($this->isPalindrome($pin) || !$this->isSequential($pin) || !$this->isPinDigitRepeated($pin)) {
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

    function isSequential($pin, $consecutiveNums = 3): bool
    {
        $con = 1;
        for ($i = 1; $i < strlen($pin); $i++) {
            if ($pin[$i] == ($pin[$i - 1] + 1)) {
                $con++;
                if ($con >= $consecutiveNums) {
                    return true;
                }
            } else {
                $con = 1;
            }
        }
        return false;
    }

    public function isPinDigitRepeated(string $pin, $sameDigit = 3): bool
    {
        $sm = 1;
        for ($i = 0; $i < strlen($pin); $i++) {
            for ($j = 1; $j < strlen($pin); $j++) {
                if ($pin[$i] == $pin[$j]) {
                    $sm++;
                    if ($sm >= $sameDigit) {
                        return true;
                    }
                } else {
                    $sm = 1;
                }
            }
        }
        return false;
    }

    public function savePin(string $pin): mixed
    {
        return PinModel::firstOrCreate([
            'pin' => $pin
        ]);
    }

    protected function getDefaultLength($length)
    {
        if ($length === null) {
            return config('pin.length');
        }
        return $length;
    }

    public function getAllPins()
    {
        $pins = PinModel::all();
        if ($pins->isNotEmpty()) {
            return $pins;
        }
        return $pins;
    }
}
