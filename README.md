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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pest-plugin-selectors test view</title>
</head>
<body>

<main>
    <ul>
        <li>List item 1</li>
        <li>List item 2</li>
        <li>List item 3</li>
        <li>List item 4</li>
        <li>List item 5</li>
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
```

---

> If you want to start testing your application with Pest, visit the main **[Pest Repository](https://github.com/pestphp/pest)**.

### Package Author

This package was created and is maintained by [Quadra Ecommerce](https://github.com/QuadraEcommerce).

- Website: **[QuadraEcom.com](https://quadraecom.com)**
- GitHub: **[QuadraEcommerce](https://github.com/QuadraEcommerce)**

[The original test assertions](src/Plugin.php) were based on code originally written
by [Liam Hammett (@ImLiam)](https://github.com/ImLiam) that can be found in
[this post on his blog](https://liamhammett.com/laravel-testing-css-selector-assertion-macros-D9o0YAQJ).
*Thank you, Liam!* 🙌🏻
