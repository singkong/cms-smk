<?php

if (!function_exists('highlightKeyword')) {
    function highlightKeyword(string $text, string $keyword): string
    {
        if (empty($keyword) || empty($text)) {
            return $text;
        }
        $words = explode(' ', trim($keyword));
        $pattern = '';
        foreach ($words as $w) {
            $w = trim($w);
            if (strlen($w) > 1) {
                $pattern .= preg_quote($w, '/') . '|';
            }
        }
        if (empty($pattern)) {
            return $text;
        }
        $pattern = '/(' . rtrim($pattern, '|') . ')/iu';
        return preg_replace($pattern, '<mark>$1</mark>', $text);
    }
}
