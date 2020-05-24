<?php


use HeroAdventure\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    protected App $app;

    protected function setUp(): void
    {
        $this->app = new App();
    }
    public function test__construct()
    {
        $this->assertInstanceOf(App::class, $this->app);
    }
    /**
     * @outputBuffering disabled
     */
    public function testStart()
    {
        ob_start();
        $endResult = $this->app->start();
        ob_end_clean();
        $this->assertTrue($endResult);
    }
}
