<?php

use AD5jp\NanashinoGonbei\Entities\Gonbei;
use AD5jp\NanashinoGonbei\Enums\Generation;
use AD5jp\NanashinoGonbei\Enums\Sex;
use AD5jp\NanashinoGonbei\Nanashi;
use PHPUnit\Framework\TestCase;

class NanashiTest extends TestCase
{
    public function testBorn()
    {
        $nanashi = new Nanashi();

        $gonbei = $nanashi->born();
        $this->assertInstanceOf(Gonbei::class, $gonbei);
    }

    public function testGenerate()
    {
        $nanashi = new Nanashi();

        $fullName = $nanashi->fullName();
        $this->assertIsString($fullName);

        $fullNameKana = $nanashi->fullNameKana();
        $this->assertIsString($fullNameKana);

        $firstName = $nanashi->firstName();
        $this->assertIsString($firstName);

        $firstNameKana = $nanashi->firstNameKana();
        $this->assertIsString($firstNameKana);

        $lastName = $nanashi->lastName();
        $this->assertIsString($lastName);

        $lastNameKana = $nanashi->lastNameKana();
        $this->assertIsString($lastNameKana);
    }

    public function testUniqueBorn()
    {
        $nanashi = new Nanashi();
        $nanashi->unique();

        $results = [];

        for ($i = 0; $i < 1000; $i++) {
            $gonbei = $nanashi->born();
            $results[] = $gonbei->fullName();
        }

        $this->assertEquals(count($results), count(array_unique($results)));
    }

    public function testUniqueGenerate()
    {
        $nanashi = new Nanashi();
        $nanashi->unique();

        $results = [];

        for ($i = 0; $i < 1000; $i++) {
            $results[] = $nanashi->fullName();
        }

        $this->assertEquals(count($results), count(array_unique($results)));
    }

    public function testSetSex()
    {
        $sex = Sex::MALE;

        $nanashi = new Nanashi();
        $nanashi->setSex($sex);

        for ($i = 0; $i < 10; $i++) {
            $gonbei = $nanashi->born();
            $this->assertEquals($sex, $gonbei->sex());
        }
    }

    public function testSetGeneration()
    {
        $generation = Generation::SHOWA;

        $nanashi = new Nanashi();
        $nanashi->setGeneration($generation);

        for ($i = 0; $i < 10; $i++) {
            $gonbei = $nanashi->born();
            $this->assertEquals($generation, $gonbei->generation());
        }
    }

    public function testSetBoth()
    {
        $sex = Sex::FEMALE;
        $generation = Generation::KIRAKIRA;

        $nanashi = new Nanashi();
        $nanashi->setSex($sex);
        $nanashi->setGeneration($generation);

        for ($i = 0; $i < 10; $i++) {
            $gonbei = $nanashi->born();
            $this->assertEquals($sex, $gonbei->sex());
            $this->assertEquals($generation, $gonbei->generation());
        }
    }
}
