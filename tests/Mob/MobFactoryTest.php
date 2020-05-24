<?php

use HeroAdventure\Exception\InvalidMobPropertiesException;
use HeroAdventure\Exception\InvalidMobTypeException;
use HeroAdventure\Mob\Mob;
use HeroAdventure\Mob\MobFactory;
use HeroAdventure\Mob\Skill\SkillSet;
use PHPUnit\Framework\TestCase;

class MobFactoryTest extends TestCase
{

    public function testCreateHeroInvalidMobPropertiesException()
    {
        $this->expectException(InvalidMobPropertiesException::class);
        $mob = MobFactory::createHero('    ', [], new SkillSet());

    }
    public function testCreateHeroWrongStats()
    {
        $this->expectException(InvalidMobPropertiesException::class);
        $mob = MobFactory::createHero('Test', [], new SkillSet());

    }
    public function testCreateHero()
    {
        $mob = MobFactory::createHero('Test', [
            'health' => [10, 10],
            'strength' => [20, 20],
            'defence' => [30, 30],
            'speed' => [40, 40],
            'luck' => [50, 50]
        ], new SkillSet());
        $this->assertInstanceOf(
            Mob::class,
            $mob
        );
    }
    public function testCreateBeastInvalidMobTypeException()
    {
        $this->expectException(InvalidMobTypeException::class);
        $mob = MobFactory::createBeast('', '    ', [], new SkillSet());
    }
    public function testCreateBeastWrongStats()
    {
        $this->expectException(InvalidMobPropertiesException::class);
        $mob = MobFactory::createBeast(\HeroAdventure\Mob\MobType::WILD_BEAST, 'Test', [], new SkillSet());

    }
    public function testCreateBeast()
    {
        $mob = MobFactory::createBeast(\HeroAdventure\Mob\MobType::WILD_BEAST, 'Test', [
            'health' => [10, 10],
            'strength' => [20, 20],
            'defence' => [30, 30],
            'speed' => [40, 40],
            'luck' => [50, 50]
        ], new SkillSet());
        $this->assertInstanceOf(
            Mob::class,
            $mob
        );
    }
}
