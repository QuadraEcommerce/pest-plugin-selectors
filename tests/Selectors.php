<?php

it('gets elements matching a selector', function () {
    /** @var DOMNodeList $elements */
    $elements = $this->get('/')
                     ->getSelectorMatches('main > ul > li');

    expect($elements)
        ->toBeInstanceOf(DOMNodeList::class)
        ->toHaveCount(5);
});

it('asserts that a selector contains a value', function () {
    $this->get('/')
         ->assertSelectorContains('main div.foo .bar', 'baz');
});

it('asserts that multiple selectors all contain the same value', function () {
    $this->get('/')
         ->assertSelectorsAllContain('main > ul > li', 'List item');
});

it("asserts that a selector's attribute equals a value", function () {
    $this->get('/')
         ->assertSelectorAttributeEquals('footer', 'data-foo', 'bar');
});
