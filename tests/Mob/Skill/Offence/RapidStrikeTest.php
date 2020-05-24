<?php declare(strict_types=1);

use HeroAdventure\Mob\Skill\Offence\RapidStrike;
use HeroAdventure\Mob\Skill\SkillSet;
use PHPUnit\Framework\TestCase;

class RapidStrikeTest extends TestCase
{
    protected RapidStrike $skill;

    protected function setUp(): void
    {
        $this->skill = new RapidStrike();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(
            RapidStrike::class,
            $this->skill
        );
    }

    public function testGetName()
    {
        $this->assertEquals(
            'Rapid strike',
            $this->skill->getName()
        );
    }

    public function testGetType()
    {
        $this->assertEquals(
            SkillSet::OFFENCE_TYPE,
            $this->skill->getType()
        );
    }

    public function testIsDamageModifierAdditive()
    {
        $this->assertEquals(
            false,
            $this->skill->isDamageModifierAdditive()
        );

    }

    public function testGetDamageModifier()
    {
        $this->assertEquals(
            2,
            $this->skill->getDamageModifier()
        );

    }
}
