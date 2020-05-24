<?php


namespace HeroAdventure\Mob;

abstract class MobType
{

    public const HERO = 'hero';

    public const WILD_BEAST = 'wild beast';

    /**
     * @param string $type
     * @return bool
     */
    public static function isKnownType(string $type = '')
    {
        return self::isKnownHeroType($type) || self::isKnownBeastType($type);
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function isKnownHeroType(string $type = '')
    {
        return in_array($type, [self::HERO]);
    }

    /**
     * @param string $type
     * @return bool
     */
    public static function isKnownBeastType(string $type = '')
    {
        return in_array($type, [self::WILD_BEAST]);
    }
}
