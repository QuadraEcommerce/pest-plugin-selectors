<?php

it('gets elements matching a selector', function () {
    /** @var DOMNodeList $elements */
    $elements = $this->get('/')
                     ->getSelectorMatches('main > ul > li');

    expect($elements)
        ->toBeInstanceOf(DOMNodeList::class)
        ->toHaveCount(5);
});

it("asserts that any of a selector's matches contains a value")
    ->get('/')
    ->assertSelectorContains('main div.single .item', 'a value');

it("asserts that all of a selector's matches contain a value")
    ->get('/')
    ->assertSelectorsAllContain('main > ul > li', 'List item');

it("asserts that any of a selector's matches equals a value")
    ->get('/')
    ->assertSelectorEquals('main div.single .item', 'a value');

it("asserts that all of a selector's matches equal the same value")
    ->get('/')
    ->assertSelectorsAllEqual('main div.multiple-same .item', 'same value');

it("asserts that any of a selector's matches does not equal a value")
    ->get('/')
    ->assertSelectorNotEquals('main div.multiple-different .item', 'not the value')
    ->assertSelectorNotEquals('main div.multiple-different .item', 'same value')
    ->assertSelectorNotEquals('main div.multiple-different .item', 'different value');

it("asserts that all of a selector's matches do not equal a value")
    ->get('/')
    ->assertSelectorsAllNotEqual('main div.multiple-same .item', 'not the value');

it("asserts that a selector match's attribute equals a value")
    ->get('/')
    ->assertSelectorAttributeEquals('footer', 'data-foo', 'bar');

it("asserts that a selector match's attribute does not equal a value")
    ->get('/')
    ->assertSelectorAttributeNotEquals('footer', 'data-foo', 'not the value');
