<?php
declare(strict_types = 1);
namespace Kawaii\Utility;

/**
 * Utilities for working with iterables.
 */
final class Iterables {
    private function __construct() {
    }

    /**
     * @template T
     * @param iterable<T,string> $elements
     */
    public static function implode(string $separator, iterable $elements): string {
        $result = '';
        $first = TRUE;
        foreach ($elements as $element) {
            if (!$first) {
                $result .= $separator;
            }
            $result .= $element;
            $first = FALSE;
        }
        return $result;
    }
}
