<?php

declare(strict_types=0);

namespace Intellicore\Pin;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Intellicore\Pin\Models\PinModel;

class Pin
{
    public function generate(int $length = null): string
    {
        $length = $this->getDefaultLength($length);
        $pin    = $this->makePin($length);

        if (!$this->validPin($pin)) {
            $this->generate($length);
        }
        if(DB::table('pins')->where('pin', $pin)->doesntExist())
        {
            $this->savePin($pin);
        }

        return $pin;
    }

    public function validPin(string $pin): bool
    {
        if ($this->isPalindrome($pin) || $this->isSequential($pin) || $this->isPinDigitRepeated($pin)) {
            return false;
        } else {
            return true;
        }
    }

    public function makePin(int $length = null): string
    {
        $length = $this->getDefaultLength($length);
        $start = str_pad('1', $length, "0");
        $end   = str_pad('9', $length, "9");

        return mt_rand((int) $start, (int) $end);
    }

    public function isPalindrome(string $pin): bool
    {
        return strrev($pin) === $pin;
    }

    function isSequential($pin, $consecutiveNums = 4): bool
    {
        //compare the prev and next elements of the string array
        //if the difference is only by one $con increment by 1 till the four digits
        //appear to be consecutive.

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

    public function isPinDigitRepeated(string $pin, $sameDigit = 4): bool
    {
        //compare with nested for loop the first for loop start with 0 indexed element
        //the second for loop start with 1 indexed element and iterate through
        //both loop to check that if any element repeated if so $sm will be increment by 1 till the condition met
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
}
