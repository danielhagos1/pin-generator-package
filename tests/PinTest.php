<?php

use Intellicore\Pin\Facades\Pin;

test('test can generate the default 4 digit pin', function () {
    $value  = Pin::standardPin(4);
    $actual = strlen($value);
    $expectedPinLength = 4;
    expect($actual)->toBe($expectedPinLength);
});
test('test can generate different 6 lengths of digits', function () {
    $value  = Pin::standardPin(6);
    $pinLength = strlen($value);
    expect($pinLength)->toBe(6);
});

test('test pin is not palindrome', function () {
    $pin    = mt_rand(1000, 9999);
    $newPin = (string) $pin;
    $value  = Pin::isPalindrome($newPin);
    expect($value)->toBeFalse();
});

test('test if pin digits repeated', function () {
    $newPin = '1193';
    $value  = Pin::isPinDigitRepeated($newPin);
    $strVal = (string) $value;
    expect($strVal)->toBeFalsy();
});

test('test if pin digits not repeated', function () {
    $value  = 3369;
    $strVal = (string) $value;
    expect($strVal)->toBeTruthy();
});

test('test pin should not be sequential', function () {
    $newPin = 1234;
    $value  = Pin::isSequential($newPin);
    expect($value)->toBeFalse();
});
