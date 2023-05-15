<?php

use Intellicore\Pin\Facades\Pin;

test('test can generate the right pin', function () {
    $newPin = '3827';
    $value = \Intellicore\Pin\Pin::generatePins($newPin);
    expect($value)->toBeFalse();
});

test('test pin is not palindrome', function () {
    $newPin = '3827';
    $value = \Intellicore\Pin\Pin::isPalindrome($newPin);
    expect($value)->toBeFalse();
});

test('test pin is palindrome', function () {
    $newPin = '2332';
    $value = \Intellicore\Pin\Pin::isPalindrome($newPin);
    expect($value)->toBeTrue();
});

test('test if pin digits repeated', function () {
    $newPin = mt_rand(1000, 9999);
    $value = \Intellicore\Pin\Pin::isPinDigitRepeated($newPin);
    $strVal = (string)$value;
    expect($strVal)->toBeTruthy();
});

test('test if pin digits not repeated', function () {
    //$newPin = mt_rand(1000, 9999);
    $newPin = 7224;
    $value = \Intellicore\Pin\Pin::isPinDigitRepeated($newPin);
    $strVal = (string)$value;
    expect($strVal)->toBeTruthy();
});

test('test pin should not be sequential', function () {
    //$newPin = mt_rand(1000, 9999);
    $newPin = "1234";
    $value = \Intellicore\Pin\Pin::isSequential($newPin);
    expect($value)->toBeFalse();
});
test('test pin sequential', function () {
    $newPin = mt_rand(1000, 9999);
    $strPin = (string)$newPin;
    $value = \Intellicore\Pin\Pin::isSequential($strPin);
    expect($value)->toBeTrue();
});
