<?php

declare(strict_types=1);

namespace AD5jp\NanashinoGonbei\Entities;

class Gonbei
{
    private string $firstName;
    private string $firstNameKana;
    private string $lastName;
    private string $lastNameKana;
    private int $sex;
    private int $generation;

    public function __construct(
        string $firstName,
        string $firstNameKana,
        string $lastName,
        string $lastNameKana,
        int $sex,
        int $generation
    ) {
        $this->firstName = $firstName;
        $this->firstNameKana = $firstNameKana;
        $this->lastName = $lastName;
        $this->lastNameKana = $lastNameKana;
        $this->sex = $sex;
        $this->generation = $generation;
    }

    public function fullName(string $separator = "") : string
    {
        return $this->lastName . $separator . $this->firstName;
    }

    public function fullNameKana(string $separator = "") : string
    {
        return $this->lastNameKana . $separator . $this->firstNameKana;
    }

    public function firstName() : string
    {
        return $this->firstName;
    }

    public function firstNameKana() : string
    {
        return $this->firstNameKana;
    }

    public function lastName() : string
    {
        return $this->lastName;
    }

    public function lastNameKana() : string
    {
        return $this->lastNameKana;
    }

    /**
     * @return \AD5jp\NanashinoGonbei\Enums\Sex::*
     */
    public function sex() : int
    {
        return $this->sex;
    }

    /**
     * @return \AD5jp\NanashinoGonbei\Enums\Generation::*
     */
    public function generation() : int
    {
        return $this->generation;
    }
}
