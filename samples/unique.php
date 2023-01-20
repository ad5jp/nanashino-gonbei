<?php

declare(strict_types=1);

use AD5jp\NanashinoGonbei\Nanashi;

include(__DIR__ . '/../vendor/autoload.php');

// ユニークモード
$nanashi = new Nanashi();
$nanashi->unique();

for ($i = 0; $i < 100; $i++) {
    echo $nanashi->fullName() . "\n"; // 全て違う名前が生成される
}

// ユニークモード（その２）
$nanashi = new Nanashi();
$nanashi->unique();

for ($i = 0; $i < 100; $i++) {
    $gonbei = $nanashi->born();
    echo $gonbei->fullName() . "\n"; // 全て違う名前が生成される
}

// 名字のみ、名前のみを取得する場合は、重複が発生する
$nanashi = new Nanashi();
$nanashi->unique();

for ($i = 0; $i < 100; $i++) {
    echo $nanashi->lastName() . "\n"; // 同じ名前が生じる可能性がある
}
