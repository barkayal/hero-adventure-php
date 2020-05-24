<?php declare(strict_types=1);

use HeroAdventure\Mob\Skill\Defence\MagicShield;
use HeroAdventure\Mob\Skill\SkillSet;
use PHPUnit\Framework\TestCase;

class MagicShieldTest extends TestCase
{
    protected MagicShield $skill;

    protected function setUp(): void
    {
        $this->skill = new MagicShield();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(
            MagicShield::class,
            $this->skill
        );
    }

    public function testGetName()
    {
        $this->assertEquals(
            'Magic shield',
            $this->skill->getName()
        );
    }

    public function testGetType()
    {
        $this->assertEquals(
            SkillSet::DEFENCE_TYPE,
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
            0.5,
            $this->skill->getDamageModifier()
        );

    }
}
