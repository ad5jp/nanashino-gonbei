<?php

declare(strict_types=1);

namespace AD5jp\NanashinoGonbei;

use AD5jp\NanashinoGonbei\Entities\Gonbei;

class Nanashi
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

    /**
     * @var array<int, array{0:string, 1:string, 2:\AD5jp\NanashinoGonbei\Enums\Sex::*, 3:\AD5jp\NanashinoGonbei\Enums\Generation::*}>
     */
    private array $dictionaryFirstName = [];

    /**
     * @var array<int, array{0:string, 1:string}>
     */
    private array $dictionaryLastName = [];

    /**
     * @var array<int, array{0:string, 1:string, 2:\AD5jp\NanashinoGonbei\Enums\Sex::*, 3:\AD5jp\NanashinoGonbei\Enums\Generation::*}>
     */
    private array $nomineesFirstName = [];

    /**
     * @var array<int, array{0:string, 1:string}>
     */
    private array $nomineesLastName = [];

    public function __construct()
    {
        $this->dictionaryFirstName = Dictionary::FIRST_NAMES; // @phpstan-ignore-line @todo
        $this->dictionaryLastName = Dictionary::LAST_NAMES;
        $this->nomineesFirstName = Dictionary::FIRST_NAMES; // @phpstan-ignore-line @todo
        $this->nomineesLastName = Dictionary::LAST_NAMES;
    }

    public function unique(bool $unique = true) : void
    {
        $this->unique = $unique;
    }

    /**
     * @param \AD5jp\NanashinoGonbei\Enums\Sex::*|null $sex
     */
    public function setSex(int $sex = null) : void
    {
        $this->sex = $sex;
        $this->nomineesFirstName = array_values(array_filter($this->dictionaryFirstName, [$this, 'filterFirstName']));
        $this->nomineesLastName = $this->dictionaryLastName;
    }

    /**
     * @param \AD5jp\NanashinoGonbei\Enums\Generation::*|null $generation
     */
    public function setGeneration(int $generation = null) : void
    {
        $this->generation = $generation;
        $this->nomineesFirstName = array_values(array_filter($this->dictionaryFirstName, [$this, 'filterFirstName']));
        $this->nomineesLastName = $this->dictionaryLastName;
    }

    public function born(int $retry = 3) : Gonbei
    {
        $first_name_key = array_rand($this->nomineesFirstName);
        $last_name_key = array_rand($this->nomineesLastName);

        if ($this->unique) {
            $nominee = $this->nomineesLastName[$last_name_key][0] . $this->nomineesFirstName[$first_name_key][0];
            if (in_array($nominee, $this->known) && $retry > 0) {
                return $this->born($retry - 1);
            }
            $this->known[] = $nominee;
        }

        return new Gonbei(
            $this->nomineesFirstName[$first_name_key][Dictionary::INDEX_KANJI],
            $this->nomineesFirstName[$first_name_key][Dictionary::INDEX_KANA],
            $this->nomineesLastName[$last_name_key][Dictionary::INDEX_KANJI],
            $this->nomineesLastName[$last_name_key][Dictionary::INDEX_KANA],
            $this->nomineesFirstName[$first_name_key][Dictionary::INDEX_SEX],
            $this->nomineesFirstName[$first_name_key][Dictionary::INDEX_GENERATION]
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

    /**
     * @param positive-int $number
     * @return Gonbei[]
     */
    public function group(int $number) : array
    {
        $group = [];

        for ($i = 0; $i < $number; $i++) {
            $group[] = $this->born();
        }

        usort($group, fn ($a, $b) => $a->fullNameKana() <=> $b->fullNameKana());

        return $group;
    }

    /**
     * @param array{0:string, 1:string, 2:\AD5jp\NanashinoGonbei\Enums\Sex::*, 3:\AD5jp\NanashinoGonbei\Enums\Generation::*} $first_name_array
     * @return boolean
     */
    private function filterFirstName(array $first_name_array) : bool
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
