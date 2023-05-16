<?php

use Intellicore\Pin\Facades\Pin;

test('test can generate the right pin', function () {
    $pin    = mt_rand(1000, 9999);
    $newPin = (string) $pin;
    $value  = Pin::generate($newPin);
    expect($value)->toBe($value);
});

test('test pin is not palindrome', function () {
    $pin    = mt_rand(1000, 9999);
    $newPin = (string) $pin;
    $value  = Pin::isPalindrome($newPin);
    expect($value)->toBeFalse();
});

test('test if pin digits repeated', function () {
    $pin    = mt_rand(1000, 9999);
    $newPin = (string) $pin;
    $value  = Pin::isPinDigitRepeated($newPin);
    $strVal = (string) $value;
    expect($strVal)->toBeFalsy();
});

test('test if pin digits not repeated', function () {
    $pin    = mt_rand(1000, 9999);
    $newPin = (string) $pin;
    $value  = Pin::isPinDigitRepeated($newPin);
    $strVal = (string) $value;
    expect($strVal)->toBeFalsy();
});

test('test pin should not be sequential', function () {
    $pin    = mt_rand(1000, 9999);
    $newPin = (string) $pin;
    $value  = Pin::isSequential($newPin);
    expect($value)->toBeFalse();
});
