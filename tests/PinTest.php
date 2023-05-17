<?php

use Intellicore\Pin\Facades\Pin;

test('test can generate the default 4 digit pin', function () {
    $pin = Pin::generate();
    expect(strlen($pin))->toBe(4);
});
test('test can generate different 6 lengths of digits', function () {
    $pin = Pin::generate(6);
    expect(strlen($pin))->toBe(6);
});

test('test pin is not palindrome', function () {
    $pin = Pin::generate();
    $value = Pin::isPalindrome($pin);
    expect($value)->toBeFalse();
});

test('test if pin digits repeated', function () {
    $pin = '1193';
    $value = Pin::isPinDigitRepeated($pin);
    expect($value)->toBeFalse();
});

test('test if pin digits not repeated', function () {
    $value  = 3369;
    $strVal = (string) $value;
    expect($strVal)->toBeTruthy();
});

test('test pin should not be sequential', function () {
    $pin = 1234;
    $value  = Pin::isSequential($pin);
    expect($value)->toBeFalse();;
});
