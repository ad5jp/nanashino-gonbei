自然な日本人の名前をランダムに生成できるライブラリです。  
生成できる氏名は100万通り以上。  
テスト用データの生成に最適です。  

# Features

- 漢字氏名とふりがな等をセットで生成できます。
- 連続生成する際、重複した名前を生成しないユニークモードを搭載。
- 男性の名前だけ、女性の名前だけを生成することもできます。生成された名前が男女いずれかを判定することもできます。
- イマドキな名前だけ、昭和な名前だけを生成することもできます。

# Installation

```shell
composer require ad5jp/nanashino-gonbei
```

# Requirements

- PHP7.4以上

# Usage

## 基本の使い方

```php
use AD5jp\NanashinoGonbei\Nanashi;

// 漢字氏名とふりがな等をまとめて生成
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
```

## ユニークモード

```php
use AD5jp\NanashinoGonbei\Nanashi;

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
```

ユニークの基準は漢字フルネームです。  
同じ漢字で違うふりがなが発生することはありませんが、違う漢字で同じふりがなが発生することはあります。  

## 条件指定

```php
use AD5jp\NanashinoGonbei\Enums\Generation;
use AD5jp\NanashinoGonbei\Enums\Sex;
use AD5jp\NanashinoGonbei\Nanashi;

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
```
