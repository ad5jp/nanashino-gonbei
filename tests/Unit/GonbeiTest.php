<?php

use AD5jp\NanashinoGonbei\Entities\Gonbei;
use AD5jp\NanashinoGonbei\Enums\Generation;
use AD5jp\NanashinoGonbei\Enums\Sex;
use PHPUnit\Framework\TestCase;

class GonbeiTest extends TestCase
{
    public function testGetter()
    {
        $firstName = "田中";
        $firstNameKana = "たなか";
        $lastName = "太郎";
        $lastNameKana = "たろう";
        $sex = Sex::MALE;
        $generation = Generation::SHOWA;

        $gonbei = new Gonbei(
            $firstName,
            $firstNameKana,
            $lastName,
            $lastNameKana,
            $sex,
            $generation
        );

        $separator = "/";

        $this->assertEquals($lastName . $firstName, $gonbei->fullName());
        $this->assertEquals($lastName . $separator . $firstName, $gonbei->fullName($separator));
        $this->assertEquals($lastNameKana . $firstNameKana, $gonbei->fullNameKana());
        $this->assertEquals($lastNameKana . $separator . $firstNameKana, $gonbei->fullNameKana($separator));

        $this->assertEquals($lastName, $gonbei->lastName());
        $this->assertEquals($lastNameKana, $gonbei->lastNameKana());
        $this->assertEquals($firstName, $gonbei->firstName());
        $this->assertEquals($firstNameKana, $gonbei->firstNameKana());
        $this->assertEquals($sex, $gonbei->sex());
        $this->assertEquals($generation, $gonbei->generation());
    }
}
