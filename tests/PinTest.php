<?php

use Intellicore\Pin\Facades\Pin;

test('generate default length pin', function () {
    $pin    = Pin::generate();
    $length = config('pin.length');
    expect(strlen($pin))->toBe($length);
});

test('test can generate valid pin 4942', function () {
    $pin = Pin::validPin('4942');
    expect($pin)->toBeTrue();
});
test('test can generate valid pin 7912', function () {
    $pin = Pin::validPin('7912');
    expect($pin)->toBeTrue();
});
test('test can generate valid pin 9772', function () {
    $pin = Pin::validPin('9772');
    expect($pin)->toBeFalse();
});
test('test can generate valid pin 23914', function () {
    $pin = Pin::validPin('23914');
    expect($pin)->toBeTrue();
});
test('test can generate valid pin 001654', function () {
    $pin = Pin::validPin('001654');
    expect($pin)->toBeFalse();
});
test('test can generate valid pin 234953', function () {
    $pin = Pin::validPin('234953');
    expect($pin)->toBeTrue();
});
test('test can generate valid pin 763315', function () {
    $pin = Pin::validPin('763315');
    expect($pin)->toBeFalse();
});

test('test pin is palindrome', function () {
    $value = Pin::isPalindrome('5436');
    expect($value)->toBeFalse();
});

test('test pin digits repeated', function () {
    $pin   = '1115';
    $value = Pin::isPinDigitRepeated($pin);
    expect($value)->toBeTrue();
});

test('test if pin digits not repeated', function () {
    $pin   = '3969';
    $value = Pin::isPinDigitRepeated($pin);
    expect($value)->toBeTrue();
});

test('test is pin sequential', function () {
    $pin   = '5362';
    $value = Pin::isSequential($pin);
    expect($value)->toBeFalse();
});

