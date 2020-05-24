<?php

namespace HeroAdventure\Mob\Skill\Offence;

use HeroAdventure\Mob\Skill\ISkill;
use HeroAdventure\Mob\Skill\Mob;
use HeroAdventure\Mob\Skill\SkillSet;

class RapidStrike implements ISkill
{
    /**
     * @var string
     */
    private string $name = 'Rapid strike';
    /**
     * @var string
     */
    private string $type = SkillSet::OFFENCE_TYPE;

    /**
     * @var bool
     */
    private bool $additive = false;
    /**
     * @var float|int
     */
    private float $modifier = 2;

    /**
     * RapidStrike constructor.
     */
    public function __construct()
    {
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

    /**
     * should return whether the damage modifier is additive (+) or multiplicative (*)
     * @return bool
     */
    public function isDamageModifierAdditive(): bool
    {
        return $this->additive;
    }

    /**
     * @return float|int
     */
    public function getDamageModifier()
    {
        return $this->modifier;
    }
}
