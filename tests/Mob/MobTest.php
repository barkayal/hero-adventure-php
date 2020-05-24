<?php

use HeroAdventure\Exception\InvalidMobTypeException;
use HeroAdventure\Mob\Mob;
use HeroAdventure\Mob\MobStats;
use HeroAdventure\Mob\Skill\SkillSet;
use PHPUnit\Framework\TestCase;

class MobTest extends TestCase
{


    protected Mob $mob;
    protected MobStats $mobStats;

    protected function setUp(): void
    {
        $this->mobStats = new MobStats([
            'health' => [10, 10],
            'strength' => [20, 20],
            'defence' => [30, 30],
            'speed' => [40, 40],
            'luck' => [50, 50]
        ]);
        $this->mob = new Mob(\HeroAdventure\Mob\MobType::HERO, 'Test', $this->mobStats, new SkillSet());
    }

    public function test__construct()
    {
        $this->assertInstanceOf(
            Mob::class,
            $this->mob
        );
    }

    public function testInvalidMobTypeException()
    {
        $this->expectException(InvalidMobTypeException::class);
        $mob = new Mob('invalid type', '', $this->mobStats, new SkillSet());
    }


    public function testGetName()
    {
        $this->assertEquals('Test', $this->mob->getName());
    }

    public function testGetType()
    {
        $this->assertEquals(\HeroAdventure\Mob\MobType::HERO, $this->mob->getType());
    }

    public function testGetStats()
    {
        $this->assertInstanceOf(
            MobStats::class,
            $this->mob->getStats()
        );
    }

    public function testGetSkills()
    {
        $this->assertInstanceOf(
            SkillSet::class,
            $this->mob->getSkills()
        );
    }

    public function testIsAlive()
    {
        $this->assertTrue($this->mob->isAlive());
        $this->mob->getStats()->takeDamage(90);
        $this->assertFalse($this->mob->isAlive());
    }

    public function testLadyLuckSmiles()
    {
        $stub = $this->createStub(MobStats::class);
        $stub->method('getLuck')
            ->willReturn(100);

        $mob = new Mob(\HeroAdventure\Mob\MobType::HERO, 'Test', $stub, new SkillSet());
        $this->assertTrue($mob->ladyLuckSmiles());
    }

    public function test__toString()
    {
        $this->assertEquals("hero Test", (string) $this->mob);
    }
}
