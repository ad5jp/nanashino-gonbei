<?php

declare(strict_types=1);

use AD5jp\NanashinoGonbei\Enums\Generation;
use AD5jp\NanashinoGonbei\Enums\Sex;
use AD5jp\NanashinoGonbei\Nanashi;

include(__DIR__ . '/../vendor/autoload.php');

// 男性の名前だけ生成
$nanashi = new Nanashi();
$nanashi->setSex(Sex::MALE);

for ($i = 0; $i < 10; $i++) {
    echo $nanashi->fullName() . "\n";
}

// 女性の名前だけ生成
$nanashi = new Nanashi();
$nanashi->setSex(Sex::FEMALE);

for ($i = 0; $i < 10; $i++) {
    echo $nanashi->fullName() . "\n";
}

// 昭和な名前だけ生成
$nanashi = new Nanashi();
$nanashi->setGeneration(Generation::SHOWA);

for ($i = 0; $i < 10; $i++) {
    echo $nanashi->fullName() . "\n";
}

// イマドキの名前だけ生成
$nanashi = new Nanashi();
$nanashi->setGeneration(Generation::KIRAKIRA);

for ($i = 0; $i < 10; $i++) {
    echo $nanashi->fullName() . "\n";
}

// 昭和な男性の名前だけ生成
$nanashi = new Nanashi();
$nanashi->setSex(Sex::MALE);
$nanashi->setGeneration(Generation::SHOWA);

for ($i = 0; $i < 10; $i++) {
    echo $nanashi->fullName() . "\n";
}

