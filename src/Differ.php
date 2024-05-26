<?php

namespace Hexlet\Code;

use function Functional\sort;
use function Functional\reduce_left;

function genDiff(string $pathToFile1, string $pathToFile2): string
{
    $content1 = json_decode(file_get_contents($pathToFile1), true);
    $content2 = json_decode(file_get_contents($pathToFile2), true);

    $allKeys = array_unique(array_merge(array_keys($content1), array_keys($content2)));
    $sortedKeys = sort($allKeys, function ($left, $right) {
        return strcmp($left, $right);
    });

    $diff = reduce_left($sortedKeys, function ($key, $index, $collection, $acc) use ($content1, $content2) {
        $value1 = $content1[$key] ?? null;
        $value2 = $content2[$key] ?? null;

        if (array_key_exists($key, $content1) && !array_key_exists($key, $content2)) {
            $acc[] = "  - {$key}: " . json_encode($value1);
        } elseif (!array_key_exists($key, $content1) && array_key_exists($key, $content2)) {
            $acc[] = "  + {$key}: " . json_encode($value2);
        } elseif ($value1 !== $value2) {
            $acc[] = "  - {$key}: " . json_encode($value1);
            $acc[] = "  + {$key}: " . json_encode($value2);
        } else {
            $acc[] = "    {$key}: " . json_encode($value1);
        }

        return $acc;
    }, []);

    return "{\n" . implode("\n", $diff) . "\n}";
}
