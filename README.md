# CSS Selector Plugin for Pest

> Add CSS selector-based testing capabilities to Pest

### Install

```shell
composer require quadraecom/pest-plugin-selectors --dev
```

### Usage

This package adds these methods:

```php
getSelectorMatches(string $selector): DOMNodeList
```

This package adds these assertions:

```php
assertSelectorExists(string $selector)
assertSelectorNotExists(string $selector)
assertSelectorCount(string $selector, int $count)
assertSelectorContains(string $selector, string $value)
assertSelectorsAllContain(string $selector, string $value)
assertSelectorEquals(string $selector, string $value)
assertSelectorsAllEqual(string $selector, string $value)
assertSelectorNotEquals(string $selector, string $value)
assertSelectorsAllNotEqual(string $selector, string $value)
assertSelectorAttributeExists(string $selector, string $attribute)
assertSelectorAttributeNotExists(string $selector, string $attribute)
assertSelectorAttributeEquals(string $selector, string $attribute, $value)
assertSelectorAttributeNotEquals(string $selector, string $attribute, $value)
```

See [tests/Selectors.php](tests/Selectors.php) for example usage.

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
