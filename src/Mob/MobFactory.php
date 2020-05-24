<?php


namespace HeroAdventure\Mob;

use HeroAdventure\Exception\InvalidMobPropertiesException;
use HeroAdventure\Exception\InvalidMobStatsException;
use HeroAdventure\Exception\InvalidMobTypeException;
use HeroAdventure\Mob\Skill\SkillSet;

class MobFactory
{
    /**
     * @param string $name
     * @param array $statRanges
     * @param SkillSet $skillSet
     * @return Mob
     * @throws InvalidMobPropertiesException
     * @throws InvalidMobTypeException
     */
    public static function createHero(string $name, array $statRanges, SkillSet $skillSet)
    {
        $name = trim(rtrim($name));
        if ($name === '') {
            throw new InvalidMobPropertiesException();
        }
        try {
            $mobStats = new MobStats($statRanges);
        } catch (InvalidMobStatsException $e) {
            throw new InvalidMobPropertiesException();
        }
        try {
            $hero = new Mob(MobType::HERO, $name, $mobStats, $skillSet);
        } catch (InvalidMobTypeException $e) {
            throw $e;
        }
        return $hero;
    }

    /**
     * @param string $type
     * @param string $name
     * @param array $statRanges
     * @param SkillSet $skillSet
     * @return Mob
     * @throws InvalidMobPropertiesException
     * @throws InvalidMobTypeException
     */
    public static function createBeast(string $type, string $name, array $statRanges, SkillSet $skillSet)
    {
        if (!MobType::isKnownBeastType($type)) {
            throw new InvalidMobTypeException();
        }
        $name = trim(rtrim($name));
        try {
            $mobStats = new MobStats($statRanges);
        } catch (InvalidMobStatsException $e) {
            throw new InvalidMobPropertiesException();
        }
        try {
            $beast = new Mob($type, $name, $mobStats, $skillSet);
        } catch (InvalidMobTypeException $e) {
            throw $e;
        }
        return $beast;
    }

}
