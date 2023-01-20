<?php

declare(strict_types=1);

namespace AD5jp\NanashinoGonbei;

use AD5jp\NanashinoGonbei\Enums\Generation;
use AD5jp\NanashinoGonbei\Enums\Sex;

class Dictionary
{
    const INDEX_KANJI = 0;
    const INDEX_KANA = 1;
    const INDEX_SEX = 2;
    const INDEX_GENERATION = 3;

    const LAST_NAMES = [
        ['鈴木', 'すずき'],
        ['佐藤', 'さとう'],
        ['小林', 'こばやし'],
        ['田中', 'たなか'],
    ];

    const FIRST_NAMES = [
        ['太郎', 'たろう', Sex::MALE, Generation::SHOWA],
        ['次郎', 'じろう', Sex::MALE, Generation::SHOWA],
        ['花子', 'はなこ', Sex::FEMALE, Generation::SHOWA],
        ['夏美', 'なつみ', Sex::FEMALE, Generation::SHOWA],
    ];

}
