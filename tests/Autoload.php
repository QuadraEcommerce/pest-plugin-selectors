<?php

use Illuminate\Testing\TestResponse;

it('adds macros to TestResponse', function (string $name) {
    expect(TestResponse::hasMacro($name))
        ->toBeTrue();
})->with([
    'getSelectorMatches',
    'assertSelectorExists',
    'assertSelectorNotExists',
    'assertSelectorCount',
    'assertSelectorContains',
    'assertSelectorsAllContain',
    'assertSelectorEquals',
    'assertSelectorNotEquals',
    'assertSelectorsAllEqual',
    'assertSelectorsAllNotEqual',
    'assertSelectorAttributeExists',
    'assertSelectorAttributeNotExists',
    'assertSelectorAttributeEquals',
    'assertSelectorAttributeNotEquals',
]);
