<?php

namespace HeroAdventure\Mob\Skill;

interface ISkill
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * should return whether the damage modifier is additive (+) or multiplicative (*)
     * @return bool
     */
    public function isDamageModifierAdditive(): bool;

    /**
     * should return the damage modifier
     * @return float|int
     */
    public function getDamageModifier();
}
