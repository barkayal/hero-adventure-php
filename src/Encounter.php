<?php


namespace HeroAdventure;


use HeroAdventure\Exception\InvalidEncounterParametersException;
use HeroAdventure\Mob\Mob;

class Encounter
{

    /**
     * @var Mob
     */
    private Mob $attacker;

    /**
     * @var Mob
     */
    private Mob $defender;

    /**
     * @var int
     */
    private int $roundLimit = 20;

    /**
     * @var array of strings holding the results of the encounter
     */
    private array $combatLog = [];

    /**
     * Encounter set up the initial encounter the attacker and the defender
     * @param Mob $attacker
     * @param Mob $defender
     * @param int $roundLimit
     * @throws InvalidEncounterParametersException
     */
    public function __construct(Mob $attacker, Mob $defender, int $roundLimit = 20)
    {
        $this->attacker = $attacker;
        $this->defender = $defender;
        if ($roundLimit <= 0) {
            throw new InvalidEncounterParametersException();
        }
        $this->roundLimit = $roundLimit;
        return $this;
    }

    /**
     * Starts the encounter
     * @return array the encounter message log as an array
     */
    public function startEncounter(): array
    {
        $currentRound = 1;
        do {
            $this->_log("Round {$currentRound}");
            $combatEnded = $this->battle($this->attacker, $this->defender);
            if ($combatEnded) {
                $this->_log("The {$this->defender} died and the {$this->attacker} is victorious");
                break;
            }
            $combatEnded = $this->battle($this->defender, $this->attacker);
            if ($combatEnded) {
                $this->_log("The {$this->attacker} died and the {$this->defender} is victorious");
                break;
            }
            $currentRound++;
        } while ($currentRound <= $this->roundLimit);
        $this->_log($currentRound > $this->roundLimit ? "The battle reached the final round ({$this->roundLimit}) and ended in a draw" : "Combat ended on round {$currentRound}");
        return $this->getLog(true);
    }

    /**
     * adds a text msg to the internal log
     * @param string $msg
     */
    private function _log(string $msg)
    {
        array_push($this->combatLog, $msg);
    }

    /**
     * Process one fight
     * @param Mob $attacker
     * @param Mob $defender
     * @return bool one of the combatants has died.
     */
    private function battle(Mob $attacker, Mob $defender)
    {
        $combatEnded = false;
        if ($defender->ladyLuckSmiles()) {
            $this->_log("The {$defender} got lucky and managed to dodge the attack of the {$attacker}");
        } else {
            $dmg = $attacker->getStats()->getStrength() - $defender->getStats()->getDefence();

            $offenceSkill = $attacker->getSkills()->getActiveOffenceSkill();
            $offenceExtraDescription = '';
            if ($offenceSkill) {
                $dmg = $offenceSkill->isDamageModifierAdditive() ?
                    ($dmg + $offenceSkill->getDamageModifier()) : ($dmg * $offenceSkill->getDamageModifier());
                $offenceExtraDescription = " using the skill {$offenceSkill->getName()}";
            }

            $defenceSkill = $defender->getSkills()->getActiveDefenceSkill();
            $defenceExtraDescription = '';
            if ($defenceSkill) {
                $dmg = $defenceSkill->isDamageModifierAdditive() ?
                    ($dmg + $defenceSkill->getDamageModifier()) : ($dmg * $defenceSkill->getDamageModifier());
                $defenceExtraDescription = " using the skill {$defenceSkill->getName()}";
            }

            $dmg = floor(max(0, $dmg));
            $defender->getStats()->takeDamage($dmg);
            $this->_log("The {$attacker}{$offenceExtraDescription} attacked and the {$defender} defended{$defenceExtraDescription}");
            $this->_log($dmg > 0 ? "The {$defender} took {$dmg} damage" : "The {$defender} defences managed to absorb all the damage");
            if (!$defender->isAlive()) {
                $combatEnded = true;
            }
        }
        return $combatEnded;
    }

    /**
     * @param bool $cleanLogAfter
     * @return array
     */
    private function getLog(bool $cleanLogAfter = false)
    {
        $log = $this->combatLog;
        if ($cleanLogAfter) {
            $this->_log = [];
        }
        return $log;
    }
}
