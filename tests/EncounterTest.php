<?php


use HeroAdventure\Encounter;
use HeroAdventure\Mob\Mob;
use HeroAdventure\Exception\InvalidEncounterParametersException;
use HeroAdventure\Mob\MobFactory;
use HeroAdventure\Mob\MobType;
use HeroAdventure\Mob\Skill\Defence\MagicShield;
use HeroAdventure\Mob\Skill\Offence\RapidStrike;
use HeroAdventure\Mob\Skill\SkillSet;
use PHPUnit\Framework\TestCase;

class EncounterTest extends TestCase
{
    public function testInvalidEncouterParametersException()
    {
        $this->expectException(InvalidEncounterParametersException::class);
        $encounter = new Encounter($this->createStub(Mob::class), $this->createStub(Mob::class), -20);
    }
    public function test__constructor()
    {
        $encounter = new Encounter($this->createStub(Mob::class), $this->createStub(Mob::class));
        $this->assertInstanceOf(Encounter::class, $encounter);
    }
    public function testBattleLuckDefence()
    {
        $skillSet = new SkillSet();
        $skillSet->addSkill(new MagicShield(), 100);
        $skillSet->addSkill(new RapidStrike(), 100);

        $defender = MobFactory::createBeast(MobType::WILD_BEAST, '', [
            'health' => [100, 100],
            'strength' => [60, 90],
            'defence' => [40, 60],
            'speed' => [40, 60],
            'luck' => [100, 100]
        ], $skillSet);
        $attacker = MobFactory::createHero('Orderus', [
            'health' => [100, 100],
            'strength' => [70, 80],
            'defence' => [45, 55],
            'speed' => [40, 50],
            'luck' => [100, 100]
        ], $skillSet);

        $encounter = new Encounter($attacker, $defender, 1);
        $this->assertCount(4, $encounter->startEncounter());
    }

    public function testAttackerWon()
    {
        $skillSet = new SkillSet();
        $skillSet->addSkill(new MagicShield(), 100);
        $skillSet->addSkill(new RapidStrike(), 100);

        $defender = MobFactory::createBeast(MobType::WILD_BEAST, '', [
            'health' => [30, 30],
            'strength' => [60, 90],
            'defence' => [30, 30],
            'speed' => [40, 60],
            'luck' => [0, 0]
        ], $skillSet);
        $attacker = MobFactory::createHero('Orderus', [
            'health' => [100, 100],
            'strength' => [100, 100],
            'defence' => [45, 55],
            'speed' => [40, 50],
            'luck' => [0, 0]
        ], $skillSet);

        $encounter = new Encounter($attacker, $defender, 1);
        $this->assertCount(5, $encounter->startEncounter());
    }


    public function testDefenderWon()
    {
        $skillSet = new SkillSet();
        $skillSet->addSkill(new MagicShield(), 100);
        $skillSet->addSkill(new RapidStrike(), 100);

        $defender = MobFactory::createBeast(MobType::WILD_BEAST, '', [
            'health' => [100, 100],
            'strength' => [100, 100],
            'defence' => [30, 30],
            'speed' => [40, 60],
            'luck' => [0, 0]
        ], $skillSet);
        $attacker = MobFactory::createHero('Orderus', [
            'health' => [10, 10],
            'strength' => [10, 10],
            'defence' => [45, 55],
            'speed' => [40, 50],
            'luck' => [0, 0]
        ], $skillSet);

        $encounter = new Encounter($attacker, $defender, 1);
        $this->assertCount(7, $encounter->startEncounter());
    }
}
