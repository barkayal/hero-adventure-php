<?php


use HeroAdventure\Mob\MobStats;
use HeroAdventure\Exception\InvalidMobStatsException;
use PHPUnit\Framework\TestCase;

class MobStatsTest extends TestCase
{
    protected MobStats $mobStats;

    protected function setUp(): void
    {
        $this->mobStats = new MobStats([
            'health' => [10, 20],
            'strength' => [30, 40],
            'defence' => [50, 60],
            'speed' => [70, 80],
            'luck' => [90, 100]
        ]);
    }

    public function test__construct()
    {
        $this->assertInstanceOf(
            MobStats::class,
            $this->mobStats
        );
    }

    public function testInitEmptyArray()
    {
        $this->expectException(InvalidMobStatsException::class);
        $mobStats = new MobStats([]);
    }
    public function testInitNotCorrect()
    {
        $this->expectException(InvalidMobStatsException::class);
        $mobStats = new MobStats([
            'health' => [60, 90],
            'strength' => [60, 90],
            'defence' => [40, 60],
            'speed' => [40, 60],
            'luck' => [0]
        ]);
    }
    public function testInitNoDefence()
    {
        $this->expectException(InvalidMobStatsException::class);
        $mobStats = new MobStats([
            'health' => [0, 0],
            'strength' => [60, 90],
            'defence' => [40, 60],
            'speed' => [40, 60],
            'luck' => [10, 20]
        ]);
    }
    public function testInitNoStrength()
    {
        $this->expectException(InvalidMobStatsException::class);
        $mobStats = new MobStats([
            'health' => [10, 20],
            'strength' => [0, 0],
            'defence' => [40, 60],
            'speed' => [40, 60],
            'luck' => [10, 20]
        ]);
    }

    public function test__toString()
    {
        $mobStats = new MobStats([
            'health' => [10, 10],
            'strength' => [20, 20],
            'defence' => [30, 30],
            'speed' => [40, 40],
            'luck' => [50, 50]
        ]);
        $this->assertEquals('10 health, 20 strength, 30 defence, 40 speed, 50 luck', (string) $mobStats);

    }

    public function testGetLuck()
    {
        $this->assertGreaterThanOrEqual(90, $this->mobStats->getLuck());
        $this->assertLessThanOrEqual(100, $this->mobStats->getLuck());
    }

    public function testGetStrength()
    {
        $this->assertGreaterThanOrEqual(30, $this->mobStats->getStrength());
        $this->assertLessThanOrEqual(40, $this->mobStats->getStrength());
    }

    public function testGetSpeed()
    {
        $this->assertGreaterThanOrEqual(70, $this->mobStats->getSpeed());
        $this->assertLessThanOrEqual(80, $this->mobStats->getSpeed());
    }

    public function testGetHealth()
    {
        $this->assertGreaterThanOrEqual(10, $this->mobStats->getHealth());
        $this->assertLessThanOrEqual(20, $this->mobStats->getHealth());
    }

    public function testGetDefence()
    {
        $this->assertGreaterThanOrEqual(50, $this->mobStats->getDefence());
        $this->assertLessThanOrEqual(60, $this->mobStats->getDefence());
    }

    public function testTakeDamage()
    {
        $mobStats = new MobStats([
            'health' => [50, 50],
            'strength' => [30, 40],
            'defence' => [50, 60],
            'speed' => [70, 80],
            'luck' => [90, 100]
        ]);
        $mobStats->takeDamage(10);
        $this->assertEquals(40, $mobStats->getHealth());
    }


    public function testMasiveAmountOfDamage()
    {
        $mobStats = new MobStats([
            'health' => [50, 50],
            'strength' => [30, 40],
            'defence' => [50, 60],
            'speed' => [70, 80],
            'luck' => [90, 100]
        ]);
        $mobStats->takeDamage(70);
        $this->assertEquals(0, $mobStats->getHealth());
    }
}
