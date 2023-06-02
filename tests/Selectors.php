<?php

use PHPUnit\Framework\AssertionFailedError;

/**
 * All tests in this file are run against the HTML in {@link ../resources/views/welcome.blade.php}
 */

it('gets elements matching a selector', function () {
    /** @var DOMNodeList $elements */
    $elements = $this->get('/')
                     ->getSelectorMatches('main > ul > li');

    expect($elements)
        ->toBeInstanceOf(DOMNodeList::class)
        ->toHaveCount(5);
});

it("throws an exception when the selector doesn't have any matches", function () {
    $this->expectException(AssertionFailedError::class);

    $this->get('/')
         ->assertSelectorContains('main div.single-string .does-not-exist', 'a value');
});

test('the selector exists')
    ->get('/')
    ->assertSelectorExists('main div.single-string .item');

test('the selector does not exist')
    ->get('/')
    ->assertSelectorNotExists('main div.single-string .does-not-exist');

test("the selector has the expected number of matches")
    ->get('/')
    ->assertSelectorCount('main div.single-string .item', 1)
    ->assertSelectorCount('main div.multiple-same-string .item', 3)
    ->assertSelectorCount('main div.multiple-same-string .does-not-exist', 0);

test("any of a selector's matches contains a value (string)")
    ->get('/')
    ->assertSelectorContains('main div.single-string .item', 'a value');

test("any of a selector's matches contains a value (int)")
    ->get('/')
    ->assertSelectorContains('main div.single-int .item', 1234);

test("all of a selector's matches contain a value (string)")
    ->get('/')
    ->assertSelectorsAllContain('main > ul > li', 'List item');

test("all of a selector's matches contain a value (int)")
    ->get('/')
    ->assertSelectorsAllContain('main > ul > li', 999);

test("any of a selector's matches equals a value (string)")
    ->get('/')
    ->assertSelectorEquals('main div.single-string .item', 'a value');

test("any of a selector's matches equals a value (int)")
    ->get('/')
    ->assertSelectorEquals('main div.int-value', 1234);

test("all of a selector's matches equal the same value (string)")
    ->get('/')
    ->assertSelectorsAllEqual('main div.multiple-same-string .item', 'same value');

test("all of a selector's matches equal the same value (int)")
    ->get('/')
    ->assertSelectorsAllEqual('main div.multiple-same-int .item', 1234);

test("any of a selector's matches does not equal a value (string)")
    ->get('/')
    ->assertSelectorNotEquals('main div.multiple-different-string .item', 'not the value')
    ->assertSelectorNotEquals('main div.multiple-different-string .item', 'same value')
    ->assertSelectorNotEquals('main div.multiple-different-string .item', 'different value');

test("any of a selector's matches does not equal a value (int)")
    ->get('/')
    ->assertSelectorNotEquals('main div.multiple-different-int .item', 4567)
    ->assertSelectorNotEquals('main div.multiple-different-int .item', 1234)
    ->assertSelectorNotEquals('main div.multiple-different-int .item', 2345);

test("all of a selector's matches do not equal a value (string)")
    ->get('/')
    ->assertSelectorsAllNotEqual('main div.multiple-same-string .item', 'not the value');

test("all of a selector's matches do not equal a value (int)")
    ->get('/')
    ->assertSelectorsAllNotEqual('main div.multiple-same-int .item', 2345);

test("an attribute exists on any of a selector's matches")
    ->get('/')
    ->assertSelectorAttributeExists('main ul li', 'data-foo');

test("an attribute does not exist on any of a selector's matches")
    ->get('/')
    ->assertSelectorAttributeNotExists('main ul li', 'data-does-not-exist');

test("an attribute equals a value on any of a selector's matches (string)")
    ->get('/')
    ->assertSelectorAttributeEquals('main ul li', 'data-foo', 'bar');

test("an attribute equals a value on any of a selector's matches (int)")
    ->get('/')
    ->assertSelectorAttributeEquals('main ul li', 'data-int', 1234);

test("an attribute does not equal a value on any of a selector's matches (string)")
    ->get('/')
    ->assertSelectorAttributeNotEquals('main ul li', 'data-foo', 'not the value');

test("an attribute does not equal a value on any of a selector's matches (int)")
    ->get('/')
    ->assertSelectorAttributeNotEquals('main ul li', 'data-int', 2345);
