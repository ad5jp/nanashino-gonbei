<?php

declare(strict_types=1);

include(__DIR__ . '/../vendor/autoload.php');

use AD5jp\NanashinoGonbei\Nanashi;

// 一括生成
$nanashi = new Nanashi();
$nanashi->unique();

$gonbeis = $nanashi->group(30);

foreach ($gonbeis as $gonbei) {
    echo $gonbei->fullName() . " : " . $gonbei->fullNameKana() . "\n"; // 50音順にソートされている
}
