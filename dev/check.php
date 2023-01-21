<?php

declare(strict_types=1);

use AD5jp\NanashinoGonbei\Dictionary;

include(__DIR__ . '/../vendor/autoload.php');

// 名字の登録件数
$total_count = count(Dictionary::LAST_NAMES);
echo "LAST_NAME 登録数 {$total_count} 件 \n";

// 名字の重複チェック
$names = array_column(Dictionary::LAST_NAMES, Dictionary::INDEX_KANJI);
$duplicates = array_filter(array_count_values($names), fn ($v) => $v >= 2);
if (count($duplicates) === 0) {
    echo "LAST_NAME 重複なし \n";
} else {
    foreach ($duplicates as $name => $count) {
        echo "LAST_NAME 重複 {$name} => {$count} 件 \n";
    }
}

// 名前の登録件数
$total_count = count(Dictionary::FIRST_NAMES);
echo "FIRST_NAME 登録数 {$total_count} 件 \n";

// 名前の重複チェック
$names = array_column(Dictionary::FIRST_NAMES, Dictionary::INDEX_KANJI);
$duplicates = array_filter(array_count_values($names), fn ($v) => $v >= 2);
if (count($duplicates) === 0) {
    echo "FIRST_NAME 重複なし \n";
} else {
    foreach ($duplicates as $name => $count) {
        echo "FIRST_NAME 重複 {$name} => {$count} 件 \n";
    }
}

// 名前のSex別登録件数
$sex_labels = [1 => '男性', 2 => '女性'];
$sexes = array_column(Dictionary::FIRST_NAMES, Dictionary::INDEX_SEX);
foreach (array_count_values($sexes) as $sex => $count) {
    echo "FIRST_NAME {$sex_labels[$sex]} => {$count} 件 \n";
}

// 名前のGeneration別登録件数
$generation_labels = [1 => '昭和', 2 => 'キラキラ'];
$generations = array_column(Dictionary::FIRST_NAMES, Dictionary::INDEX_GENERATION);
foreach (array_count_values($generations) as $generation => $count) {
    echo "FIRST_NAME {$generation_labels[$generation]} => {$count} 件 \n";
}

// 名前のクロス集計
$cross = array_map(
    fn ($generation, $sex) => $generation_labels[$generation] . "-" . $sex_labels[$sex],
    array_column(Dictionary::FIRST_NAMES, Dictionary::INDEX_GENERATION),
    array_column(Dictionary::FIRST_NAMES, Dictionary::INDEX_SEX)
);
foreach (array_count_values($cross) as $label => $count) {
    echo "{$label} => {$count} 件 \n";
}

