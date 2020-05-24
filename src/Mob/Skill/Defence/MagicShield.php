<?php

namespace HeroAdventure\Mob\Skill\Defence;

use HeroAdventure\Mob\Skill\ISkill;
use HeroAdventure\Mob\Skill\Mob;
use HeroAdventure\Mob\Skill\SkillSet;

class MagicShield implements ISkill
{
    /**
     * @var string
     */
    private string $name = 'Magic shield';
    /**
     * @var string
     */
    private string $type = SkillSet::DEFENCE_TYPE;

    /**
     * @var bool
     */
    private bool $additive = false;
    /**
     * @var float
     */
    private float $modifier = 0.5;

    /**
     * MagicShield constructor.
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
