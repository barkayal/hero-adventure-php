<?php


namespace HeroAdventure\Mob\Skill;

use HeroAdventure\Exception\InvalidSkillTypeException;

class SkillSet
{
    const DEFENCE_TYPE = 'defence';
    const OFFENCE_TYPE = 'offence';

    /**
     * @var array[]
     */
    private array $skillSet = [
        self::DEFENCE_TYPE => [],
        self::OFFENCE_TYPE => [],
    ];

    /**
     * SkillSet constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param ISkill $skill
     * @param int $chanceToActivate this should be an integer between 0 and 100
     * @return $this
     * @throws InvalidSkillTypeException
     */
    public function addSkill(ISkill $skill, int $chanceToActivate = 0)
    {
        if (!in_array($skill->getType(), array_keys($this->skillSet))) {
            throw new InvalidSkillTypeException();
        }
        // 0 means there skill will never be active while 100 it will always activate
        array_push($this->skillSet[$skill->getType()], [
                'skill' => $skill,
                'chanceToActivate' => max(0, min($chanceToActivate, 100))]
        );
        return $this;
    }

    /**
     * @return ISkill|null
     */
    public function getActiveOffenceSkill()
    {
        return $this->getActiveSkill(self::OFFENCE_TYPE);
    }

    /**
     * @param string $type
     * @return ISkill|null
     */
    private function getActiveSkill(string $type)
    {
        $activeSkill = null;
        $countSkill = count($this->skillSet[$type]);
        for ($i = 0; $i < $countSkill; $i++) {
            if ($this->skillSet[$type][$i]['chanceToActivate'] === 0) {
                continue;
            }
            $canBeActivated = rand(1, 100) <= $this->skillSet[$type][$i]['chanceToActivate'];
            if ($canBeActivated) {
                $activeSkill = $this->skillSet[$type][$i]['skill'];
                break;
            }
        }
        return $activeSkill;
    }

    /**
     * @return ISkill|null
     */
    public function getActiveDefenceSkill()
    {
        return $this->getActiveSkill(self::DEFENCE_TYPE);
    }

    /**
     * @return array|mixed
     */
    public function getAllOffenceSkills()
    {
        return $this->getAllSkillsByType(self::OFFENCE_TYPE);
    }

    /**
     * @param string $type
     * @return array|mixed
     */
    private function getAllSkillsByType(string $type)
    {
        return $this->skillSet[$type];
    }

    /**
     * @return array|mixed
     */
    public function getAllDefenceSkills()
    {
        return $this->getAllSkillsByType(self::DEFENCE_TYPE);
    }

}
