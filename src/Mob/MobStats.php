<?php

namespace HeroAdventure\Mob;

use HeroAdventure\Exception\InvalidMobStatsException;

class MobStats
{
    /**
     * @var int
     */
    private int $health;
    /**
     * @var int
     */
    private int $strength;
    /**
     * @var int
     */
    private int $defence;
    /**
     * @var int
     */
    private int $speed;
    /**
     * @var int
     */
    private int $luck;
    /**
     * @var string[]
     */
    private array $listOfStats = ['health', 'strength', 'defence', 'speed', 'luck'];

    /**
     * MobStats constructor.
     * @param array $statRanges
     * @throws InvalidMobStatsException
     */
    public function __construct(array $statRanges)
    {
        if (!empty(array_diff($this->listOfStats, array_keys($statRanges)))) {
            throw new InvalidMobStatsException();
        }
        foreach ($statRanges as $stat => $range) {
            if (!is_array($range) || count($range) != 2) {
                throw new InvalidMobStatsException();
            }
            $this->{$stat} = rand(max(0, (int)$range[0]), max(0, (int)$range[1]));
        }
        if ($this->getHealth() == 0 || $this->getStrength() == 0) {
            throw new InvalidMobStatsException();
        }
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $damage
     */
    public function takeDamage(int $damage): void
    {
        $this->health = max(0, $this->health - max(0, $damage));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->getHealth()} health, {$this->getStrength()} strength, {$this->getDefence()} defence, {$this->getSpeed()} speed, {$this->getLuck()} luck";
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

}
