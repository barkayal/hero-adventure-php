<?php


namespace HeroAdventure\Mob;


use HeroAdventure\Exception\InvalidMobTypeException;
use HeroAdventure\Mob\Skill\SkillSet;

class Mob
{
    /**
     * @var string
     */
    private string $type;
    /**
     * @var string
     */
    private string $name;

    /**
     * @var MobStats
     */
    private MobStats $stats;
    /**
     * @var SkillSet
     */
    private SkillSet $skillSet;

    /**
     * Mob constructor.
     * @param string $type
     * @param string $name
     * @param MobStats $stats
     * @param SkillSet $skillSet
     * @throws InvalidMobTypeException
     */
    public function __construct(string $type, string $name, MobStats $stats, SkillSet $skillSet)
    {
        if (!MobType::isKnownType($type)) {
            throw new InvalidMobTypeException();
        }
        $this->type = $type;
        $this->setName($name);
        $this->setStats($stats);
        $this->skillSet = $skillSet;
        return $this;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param MobStats $stats
     */
    private function setStats(MobStats $stats): void
    {
        $this->stats = $stats;
    }

    /**
     * @return SkillSet
     */
    public function getSkills()
    {
        return $this->skillSet;
    }

    /**
     * @return bool
     */
    public function isAlive(): bool
    {
        return $this->getStats()->getHealth() > 0;
    }

    /**
     * @return MobStats
     */
    public function getStats(): MobStats
    {
        return $this->stats;
    }

    /**
     * @return bool
     */
    public function ladyLuckSmiles(): bool
    {
        return rand(1, 100) <= $this->getStats()->getLuck();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getType() . ($this->getName() === '' ? '' : " {$this->getName()}");
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}

