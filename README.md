# CSS Selector Plugin for Pest

> Add CSS selector-based testing capabilities to Pest

### Install

```shell
composer require quadraecom/pest-plugin-selectors --dev
```

### Usage

```php
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
```

> If you want to start testing your application with Pest, visit the main **[Pest Repository](https://github.com/pestphp/pest)**.

### Package Author

This package was created and is maintained by [Quadra Ecommerce](https://github.com/QuadraEcommerce).

- Website: **[QuadraEcom.com](https://quadraecom.com)**
- GitHub: **[QuadraEcommerce](https://github.com/QuadraEcommerce)**

[The test assertions](src/Plugin.php) are based on code originally written
by [Liam Hammett (@ImLiam)](https://github.com/ImLiam) that can be found in
[this post on his blog](https://liamhammett.com/laravel-testing-css-selector-assertion-macros-D9o0YAQJ).
*Thank you, Liam!* 🙌🏻
