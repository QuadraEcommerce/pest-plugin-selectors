# CSS Selector Plugin for Pest

> Add CSS selector-based testing capabilities to Pest

### Install

```shell
composer require quadraecom/pest-plugin-selectors --dev
```

### Usage

Using the following response body:

```html
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>quadraecom/pest-plugin-selectors test view</title>
</head>
<body>

<main>
    <ul>
        <li>List item 1</li>
        <li>List item 2</li>
        <li>List item 3</li>
        <li>List item 4</li>
        <li data-foo="bar">List item 5</li>
    </ul>

    <div class="single">
        <div class="item">a value</div>
    </div>

    <div class="multiple-same">
        <div class="item">same value</div>
        <div class="item">same value</div>
        <div class="item">same value</div>
    </div>

    <div class="multiple-different">
        <div class="item">same value</div>
        <div class="item">same value</div>
        <div class="item">different value</div>
    </div>
</main>

<footer data-foo="bar"></footer>

</body>
</html>
```

The following tests will all pass:

```php
use PHPUnit\Framework\AssertionFailedError;

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
         ->assertSelectorContains('main div.single .does-not-exist', 'a value');
});

it('asserts that the selector exists')
    ->get('/')
    ->assertSelectorExists('main div.single .item');

it('asserts that the selector does not exist')
    ->get('/')
    ->assertSelectorNotExists('main div.single .does-not-exist');

it("asserts that the selector matches the expected count")
    ->get('/')
    ->assertSelectorCount('main div.single .item', 1)
    ->assertSelectorCount('main div.multiple-same .item', 3)
    ->assertSelectorCount('main div.multiple-same .does-not-exist', 0);

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

it("asserts that an attribute exists on any of a selector's matches")
    ->get('/')
    ->assertSelectorAttributeExists('main ul li', 'data-foo');

it("asserts that an attribute does not exist on any of a selector's matches")
    ->get('/')
    ->assertSelectorAttributeNotExists('main ul li', 'data-does-not-exist');

it("asserts that an attribute equals a value on any of a selector's matches")
    ->get('/')
    ->assertSelectorAttributeEquals('main ul li', 'data-foo', 'bar');

it("asserts that an attribute does not equal a value on any of a selector's matches")
    ->get('/')
    ->assertSelectorAttributeNotEquals('main ul li', 'data-foo', 'not the value');
```

---

> If you want to start testing your application with Pest, visit the main
> **[Pest Repository](https://github.com/pestphp/pest)**.

### Package Author

This package was created and is maintained by [Quadra, Inc](https://github.com/QuadraEcommerce).

- Website: **[GoQuadra.com](https://goquadra.com)**
- GitHub: **[QuadraEcommerce](https://github.com/QuadraEcommerce)**

[The test assertions](src/Plugin.php) were inspired by code written
by [Liam Hammett (@ImLiam)](https://github.com/ImLiam) that can be found in
[this post on his blog](https://liamhammett.com/laravel-testing-css-selector-assertion-macros-D9o0YAQJ).
*Thank you, Liam!* 🙌🏻
