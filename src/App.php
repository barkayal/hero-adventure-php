<?php


namespace HeroAdventure;

use HeroAdventure\Entity\Adventure;
use HeroAdventure\Mob\MobFactory;
use HeroAdventure\Mob\MobType;
use HeroAdventure\Mob\Skill\Defence\MagicShield;
use HeroAdventure\Mob\Skill\Offence\RapidStrike;
use HeroAdventure\Mob\Skill\SkillSet;

class App
{
    /**
     * App constructor.
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * @return bool
     */
    public function start(): bool
    {
        try {
            return $this->startInteraction();
        } catch (Exception $e) {
            print "Fatal error while trying to run the app";
            return false;
        }
    }

    /**
     * @return bool
     */
    private function startInteraction(): bool
    {
        print "Welcome to a new adventure hero" . PHP_EOL;

        $hero = $this->createHero();
        $beast = $this->createWildBeast();

        $ambush = false;

        if ($hero->getStats()->getSpeed() <= $beast->getStats()->getSpeed()) {
            if ($hero->getStats()->getSpeed() == $beast->getStats()->getSpeed() && $hero->getStats()->getLuck() >= $beast->getStats()->getLuck()) {
                print "Our {$hero} was ambushed and attacked by a {$beast} however due to his luck he managed to attack it first" . PHP_EOL;
            } else {
                $ambush = true;
                print "Our {$hero} was ambushed and attacked by a {$beast}" . PHP_EOL;
            }
        } else {
            print "Our {$hero} encountered a {$beast} and attacked it" . PHP_EOL;
        }
        print "The {$hero} has the stats: {$hero->getStats()}" . PHP_EOL;
        print "The {$beast} has the stats: {$beast->getStats()}" . PHP_EOL;
        list($attacker, $defender) = $ambush ? [$beast, $hero] : [$hero, $beast];

        try {
            $encounter = new Encounter($attacker, $defender);
        } catch (Exception\InvalidEncounterParametersException $e) {
            throw new EncounterCreationException();
        }
        $encounterLog = $encounter->startEncounter();
        print implode(PHP_EOL, $encounterLog);
        print PHP_EOL;
        return true;
    }

    /**
     * @return Mob\Mob
     */
    private function createHero()
    {
        $heroSkillSet = new SkillSet();
        try {
            $heroSkillSet->addSkill(
                new RapidStrike(), 10
            );
        } catch (Exception\InvalidSkillTypeException $e) {
            throw new EncounterCreationException();
        }
        try {
            $heroSkillSet->addSkill(
                new MagicShield(), 20
            );
        } catch (Exception\InvalidSkillTypeException $e) {
            throw new EncounterCreationException();
        }
        try {
            return MobFactory::createHero('Orderus', [
                'health' => [70, 100],
                'strength' => [70, 80],
                'defence' => [45, 55],
                'speed' => [40, 50],
                'luck' => [10, 30]
            ], $heroSkillSet);
        } catch (Exception\InvalidMobPropertiesException $e) {
            throw new EncounterCreationException();
        } catch (Exception\InvalidMobTypeException $e) {
            throw new EncounterCreationException();
        }
    }

    /**
     * @return Mob\Mob
     */
    private function createWildBeast()
    {
        try {
            return MobFactory::createBeast(MobType::WILD_BEAST, '', [
                'health' => [60, 90],
                'strength' => [60, 90],
                'defence' => [40, 60],
                'speed' => [40, 60],
                'luck' => [25, 40]
            ], new SkillSet());
        } catch (Exception\InvalidMobPropertiesException $e) {
            throw new EncounterCreationException();
        } catch (Exception\InvalidMobTypeException $e) {
            throw new EncounterCreationException();
        }
    }


}
