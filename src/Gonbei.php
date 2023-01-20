<?php

declare(strict_types=1);

namespace AD5jp\NanashinoGonbei;

use AD5jp\NanashinoGonbei\Entities\WhatsHerName;

class Gonbei
{
    private bool $unique = false;

    /**
     * @var \AD5jp\NanashinoGonbei\Enums\Sex::*|null
     */
    private ?int $sex = null;

    /**
     * @var \AD5jp\NanashinoGonbei\Enums\Generation::*|null
     */
    private ?int $generation = null;

    /**
     * @var string[]
     */
    private array $known = [];

    public function setUnique(bool $unique = true) : void
    {
        $this->unique = $unique;
    }

    /**
     * @param \AD5jp\NanashinoGonbei\Enums\Sex::*|null $sex
     */
    public function setSex(int $sex = null) : void
    {
        $this->sex = $sex;
    }

    /**
     * @param \AD5jp\NanashinoGonbei\Enums\Generation::*|null $generation
     */
    public function setGeneration(int $generation = null) : void
    {
        $this->generation = $generation;
    }

    public function born() : WhatsHerName
    {
        $first_name_nominees = array_values(array_filter(Dictionary::FIRST_NAMES, [$this, 'filterFirstName']));
        $first_name_key = array_rand($first_name_nominees);

        $last_name_nominees = Dictionary::LAST_NAMES;
        $last_name_key = array_rand($last_name_nominees);

        if ($this->unique) {
            $nominee = $last_name_nominees[$last_name_key][0] . $first_name_nominees[$first_name_key][0];
            if (in_array($nominee, $this->known)) {
                return $this->born();
            }
            $this->known[] = $nominee;
        }

        return new WhatsHerName(
            $first_name_nominees[$first_name_key][Dictionary::INDEX_KANJI],
            $first_name_nominees[$first_name_key][Dictionary::INDEX_KANA],
            $last_name_nominees[$last_name_key][Dictionary::INDEX_KANJI],
            $last_name_nominees[$last_name_key][Dictionary::INDEX_KANA],
            $first_name_nominees[$first_name_key][Dictionary::INDEX_SEX],
            $first_name_nominees[$first_name_key][Dictionary::INDEX_GENERATION]
        );
    }

    public function fullName(string $separator = "") : string
    {
        return $this->born()->fullName($separator);
    }

    public function fullNameKana(string $separator = "") : string
    {
        return $this->born()->fullNameKana($separator);
    }

    public function firstName() : string
    {
        return $this->born()->firstName();
    }

    public function firstNameKana() : string
    {
        return $this->born()->firstNameKana();
    }

    public function lastName() : string
    {
        return $this->born()->lastName();
    }

    public function lastNameKana() : string
    {
        return $this->born()->lastNameKana();
    }

    private function filterFirstName(array $first_name_array)
    {
        if ($this->sex !== null && $this->sex !== $first_name_array[Dictionary::INDEX_SEX]) {
            return false;
        }

        if ($this->generation !== null && $this->generation !== $first_name_array[Dictionary::INDEX_GENERATION]) {
            return false;
        }

        return true;
    }

}
