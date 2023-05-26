<?php

namespace QuadraEcom\PestSelectors;

use DOMDocument;
use DOMNode;
use DOMNodeList;
use DOMXPath;
use Illuminate\Support\Str;
use Illuminate\Testing\Assert as PHPUnit;
use Illuminate\Testing\TestResponse;
use Symfony\Component\CssSelector\CssSelectorConverter;

// The functions below are based on the functions found at the following URL:
// https://liamhammett.com/laravel-testing-css-selector-assertion-macros-D9o0YAQJ

TestResponse::macro('getSelectorMatches', function (string $selector): DOMNodeList {
    $dom = new DOMDocument();

    if (! @$dom->loadHTML(
        mb_convert_encoding($this->getContent(), 'HTML-ENTITIES', 'UTF-8'),
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
    )) {
        throw new \DOMException('Failed to load HTML into DOMDocument');
    }

    $converter = new CssSelectorConverter();
    $xpathSelector = $converter->toXPath($selector);

    $xpath = new DOMXPath($dom);
    $nodeList = $xpath->query($xpathSelector);

    if (! $nodeList instanceof DOMNodeList) {
        throw new \DOMException('Failed to evaluate XPath expression against DOMDocument');
    }

    return $nodeList;
});

TestResponse::macro('assertSelectorExists', function (string $selector): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorNotExists', function (string $selector): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (count($nodes)) {
        PHPUnit::fail("The selector '$selector' was found in the response.");
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorCount', function (string $selector, int $expectedCount): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);
    $actualCount = count($nodes);

    if ($actualCount !== $expectedCount) {
        PHPUnit::fail("The selector '$selector' has a count of $actualCount, not the expected count of $expectedCount.");
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorContains', function (string $selector, string $value): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    foreach ($nodes as $node) {
        if (Str::contains($node->textContent, $value)) {
            PHPUnit::assertTrue(true);

            return $this;
        }
    }

    PHPUnit::fail("The selector '$selector' did not contain the value '$value'.");
});

TestResponse::macro('assertSelectorsAllContain', function (string $selector, string $value): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    foreach ($nodes as $node) {
        if (! Str::contains($node->textContent, $value)) {
            PHPUnit::fail("The selector '$selector' did not contain the value '$value'.");
        }
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorEquals', function (string $selector, string $value): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    foreach ($nodes as $node) {
        if (trim($node->textContent) === $value) {
            PHPUnit::assertTrue(true);

            return $this;
        }
    }

    PHPUnit::fail("The selector '$selector' did not equal the value '$value'.");
});

TestResponse::macro('assertSelectorsAllEqual', function (string $selector, string $value): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    foreach ($nodes as $node) {
        if (trim($node->textContent) !== $value) {
            PHPUnit::fail("One or more matches of the selector '$selector' did not equal the value '$value'.");
        }
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorNotEquals', function (string $selector, string $value): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    foreach ($nodes as $node) {
        if (trim($node->textContent) !== $value) {
            PHPUnit::assertTrue(true);

            return $this;
        }
    }

    PHPUnit::fail("The selector '$selector' did equal the value '$value'.");
});

TestResponse::macro('assertSelectorsAllNotEqual', function (string $selector, string $value): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    foreach ($nodes as $node) {
        if (trim($node->textContent) === $value) {
            PHPUnit::fail("One or more matches of the selector '$selector' did equal the value '$value'.");
        }
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorAttributeExists', function (string $selector, string $attribute): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorAttributeNotExists', function (string $selector, string $attribute): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (count($nodes)) {
        PHPUnit::fail("The selector '$selector' was found in the response.");
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorAttributeEquals', function (string $selector, string $attribute, $expected): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector was not found in the response.");
    }

    /** @var DOMNode $firstNode */
    $firstNode = $nodes[0];

    PHPUnit::assertEquals($expected, $firstNode->getAttribute($attribute));

    return $this;
});

TestResponse::macro('assertSelectorAttributeNotEquals', function (string $selector, string $attribute, $expected): TestResponse {
    /** @var DOMNodeList $nodes */
    $nodes = $this->getSelectorMatches($selector);

    if (! count($nodes)) {
        PHPUnit::fail("The selector '$selector was not found in the response.");
    }

    /** @var DOMNode $firstNode */
    $firstNode = $nodes[0];

    PHPUnit::assertNotEquals($expected, $firstNode->getAttribute($attribute));

    return $this;
});
