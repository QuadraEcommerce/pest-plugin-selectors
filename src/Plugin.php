<?php

namespace QuadraEcom\PestSelectors;

use DOMDocument;
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

TestResponse::macro('assertSelectorContains', function (string $selector, string $value): TestResponse {
    $selectorContents = $this->getSelectorMatches($selector);

    if (empty($selectorContents)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    foreach ($selectorContents as $element) {
        if (Str::contains($element->textContent, $value)) {
            PHPUnit::assertTrue(true);

            return $this;
        }
    }

    PHPUnit::fail("The selector '$selector' did not contain the value '$value'.");
});

TestResponse::macro('assertSelectorsAllContain', function (string $selector, string $value): TestResponse {
    $selectorContents = $this->getSelectorMatches($selector);

    if (empty($selectorContents)) {
        PHPUnit::fail("The selector '$selector' was not found in the response.");
    }

    foreach ($selectorContents as $element) {
        if (! Str::contains($element->textContent, $value)) {
            PHPUnit::fail("The selector '$selector' did not contain the value '$value'.");
        }
    }

    PHPUnit::assertTrue(true);

    return $this;
});

TestResponse::macro('assertSelectorAttributeEquals', function (string $selector, string $attribute, $expected): TestResponse {
    $nodes = $this->getSelectorMatches($selector);

    if (count($nodes) === 0) {
        PHPUnit::fail("The selector '$selector was not found in the response.");
    }

    $firstNode = $nodes[0];

    PHPUnit::assertEquals($expected, $firstNode->getAttribute($attribute));

    return $this;
});
