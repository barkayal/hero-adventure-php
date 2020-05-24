<?php

use HeroAdventure\Mob\Skill\Defence\MagicShield;
use HeroAdventure\Mob\Skill\Offence\RapidStrike;
use HeroAdventure\Mob\Skill\SkillSet;
use PHPUnit\Framework\TestCase;

class SkillSetTest extends TestCase
{

    public function test__construct()
    {
        $skillSet = new SkillSet();
        $this->assertInstanceOf(
            SkillSet::class,
            $skillSet
        );
        $this->assertEmpty($skillSet->getAllDefenceSkills());
        $this->assertEmpty($skillSet->getAllOffenceSkills());
    }

    public function testInvalidSkillTypeException()
    {
        $this->expectException(HeroAdventure\Exception\InvalidSkillTypeException::class);

        $stub = $this->createStub(MagicShield::class);
        $stub->method('getType')
            ->willReturn('wrong type');

        $skillSet = new SkillSet();
        $skillSet->addSkill($stub, 100);


    }

    public function testAddSkill()
    {
        $skillSet = new SkillSet();
        $skillSet->addSkill(new MagicShield(), 100);
        $skillSet->addSkill(new RapidStrike(), 100);
        $this->assertCount(1, $skillSet->getAllDefenceSkills());
        $this->assertCount(1, $skillSet->getAllOffenceSkills());
    }

    public function testGetActiveOffenceSkillAlways()
    {
        $skillSet = new SkillSet();
        $skillSet->addSkill(new RapidStrike(), 100);
        $this->assertNotNull($skillSet->getActiveOffenceSkill());

    }

    public function testGetActiveDefenceSkillAlways()
    {
        $skillSet = new SkillSet();
        $skillSet->addSkill(new MagicShield(), 100);
        $this->assertNotNull($skillSet->getActiveDefenceSkill());

    }

    public function testGetActiveOffenceSkillNever()
    {
        $skillSet = new SkillSet();
        $skillSet->addSkill(new RapidStrike(), 0);
        $this->assertEmpty($skillSet->getActiveOffenceSkill());

    }

    public function testGetActiveDefenceSkillNever()
    {
        $skillSet = new SkillSet();
        $skillSet->addSkill(new MagicShield(), 0);
        $this->assertEmpty($skillSet->getActiveOffenceSkill());

    }
}
