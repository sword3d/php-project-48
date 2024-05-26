<?php

require __DIR__ . '/vendor/autoload.php';

use function Hexlet\Code\genDiff;

echo genDiff(__DIR__ . '/files/file1.json', __DIR__ . '/files/file2.json');
