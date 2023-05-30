<?php

use Intellicore\Pin\Facades\Pin;

test('generate default length pin', function () {
    $pin    = Pin::generate();
    $length = config('pin.length');
    expect(strlen($pin))->toBe($length);
});

test('can generate valid pin 4942', function () {
    $pin = Pin::validPin('1234');
    expect($pin)->toBeTrue();
});

test('can generate valid pin 7912', function () {
    $pin = Pin::validPin('7912');
    expect($pin)->toBeTrue();
});

test('can generate valid pin 9772', function () {
    $pin = Pin::validPin('9772');
    expect($pin)->toBeTrue();
});

test('can generate pin 23914', function () {
    $pin = Pin::validPin('23914');
    expect($pin)->toBeTrue();
});

test('test valid pin 001654', function () {
    $pin = Pin::validPin('001654');
    expect($pin)->toBeTrue();
});

test('test valid pin 234953', function () {
    $pin = Pin::validPin('234953');
    expect($pin)->toBeTrue();
});

test('test valid pin 763315', function () {
    $pin = Pin::validPin('763315');
    expect($pin)->toBeTrue();
});

test('test is pin palindrome', function () {
    $value = Pin::isPalindrome('2222');
    expect($value)->toBeTrue();
});

test('test pin digits repeated', function () {
    $pin   = '1615';
    $value = Pin::isPinDigitRepeated($pin);
    expect($value)->toBeTrue();
});

test('test pin not sequential', function () {
    $pin   = '8305';
    $value = Pin::isSequential($pin);
    expect($value)->toBeTrue();
});

test('test invalid sequential pin', function () {
    $pin   = '1238';
    $value = Pin::isSequential($pin);
    expect($value)->toBeTrue();
});


