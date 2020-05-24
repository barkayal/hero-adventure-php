<?php


use HeroAdventure\Mob\MobType;
use PHPUnit\Framework\TestCase;

class MobTypeTest extends TestCase
{
    public function testIsKnownHeroType()
    {
        $this->assertTrue(MobType::isKnownHeroType(MobType::HERO));
        $this->assertFalse(MobType::isKnownHeroType('non hero'));
    }
    public function testIsKnownBeastType()
    {
        $this->assertTrue(MobType::isKnownBeastType(MobType::WILD_BEAST));
        $this->assertFalse(MobType::isKnownBeastType('non beast'));
    }

    public function testIsKnownType()
    {
        $this->assertTrue(MobType::isKnownType(MobType::HERO));
        $this->assertTrue(MobType::isKnownType(MobType::WILD_BEAST));
        $this->assertFalse(MobType::isKnownType('false'));
    }
}
