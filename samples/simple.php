<?php

declare(strict_types=1);

include(__DIR__ . '/../vendor/autoload.php');

use AD5jp\NanashinoGonbei\Nanashi;

// 漢字氏名とふりがなをまとめて生成
$nanashi = new Nanashi();
$gonbei = $nanashi->born();

echo $gonbei->fullName() . "\n"; // 田中太郎
echo $gonbei->fullName(" ") . "\n"; // 田中 太郎
echo $gonbei->fullNameKana() . "\n"; // たなかたろう
echo $gonbei->fullNameKana(" ") . "\n"; // たなか たろう
echo $gonbei->firstName() . "\n"; // 太郎
echo $gonbei->firstNameKana() . "\n"; // たろう
echo $gonbei->lastName() . "\n"; // 田中
echo $gonbei->lastNameKana() . "\n"; // たなか
echo $gonbei->sex() . "\n"; // 1:男性 2:女性
echo $gonbei->generation() . "\n"; // 1:昭和 2:今どき

// 必要なものだけ生成
$nanashi = new Nanashi();

echo $nanashi->fullName() . "\n"; // 鈴木一郎
echo $nanashi->fullName(" ") . "\n"; // 佐藤 次郎
echo $nanashi->fullNameKana() . "\n"; // こばやしさぶろう
echo $nanashi->fullNameKana(" ") . "\n"; // たなか しろう
echo $nanashi->firstName() . "\n"; // 健二
echo $nanashi->firstNameKana() . "\n"; // けんじ
echo $nanashi->lastName() . "\n"; // 伊藤
echo $nanashi->lastNameKana() . "\n"; // まつい

