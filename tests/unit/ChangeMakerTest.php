<?php
namespace My;

// \Codeception\Util\Debug::debug("message");

class ChangeMakerTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->slug = new Coin();
        $this->nickel = new Coin(Coin::PROP_NICKEL);
        $this->dime = new Coin(Coin::PROP_DIME);
        $this->quarter = new Coin(Coin::PROP_QUARTER);
    }

    protected function _after()
    {
    }

    // tests
    public function testNoCoinsAtAll()
    {
        $res = ChangeMaker::makeChange(25, new CoinCollection(), new CoinCollection());
        $this->assertEquals(array(), $res);
    }
    public function testNoCoinsInCoinBox()
    {
        $res = ChangeMaker::makeChange(10, new CoinCollection(array($this->quarter)), new CoinCollection());
        $this->assertEquals(array(), $res);
    }
    public function testInsertQuarterReturnDimeAndNickel()
    {
        $res = ChangeMaker::makeChange(10, new CoinCollection(array($this->quarter)), new CoinCollection(array($this->nickel, $this->dime)));
        $this->assertEquals(array($this->quarter), $res['received']->all());
        $this->assertEquals(array($this->dime, $this->nickel), $res['change']->all());
    }
    public function testInsertTwoDimesReturnDime()
    {
        $res = ChangeMaker::makeChange(10, new CoinCollection(array($this->dime, $this->dime)), new CoinCollection(array($this->nickel, $this->dime)));
        $this->assertEquals(array($this->dime, $this->dime, $this->nickel), $res['received']->all());
        $this->assertEquals(array($this->dime), $res['change']->all());
    }
}
