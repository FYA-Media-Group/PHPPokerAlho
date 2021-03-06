<?php

namespace Tests;

use TexasHoldemBundle\Gameplay\Cards\Deck;
use TexasHoldemBundle\Gameplay\Cards\StandardDeck;
use TexasHoldemBundle\Gameplay\Cards\StandardSuitFactory;
use TexasHoldemBundle\Gameplay\Game\Dealer;
use TexasHoldemBundle\Gameplay\Game\Table;
use TexasHoldemBundle\Gameplay\Game\TableFactory;
use TexasHoldemBundle\Gameplay\Game\Player;
use TexasHoldemBundle\Gameplay\Game\TableEvent;

/**
 * @since  {nextRelease}
 *
 * @author Artur Alves <artur.ze.alves@gmail.com>
 */
class DealerTest extends BaseTestCase
{
    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::__construct
     *
     * @since  nextRelease
     */
    public function testConstruct()
    {
        $suitFactory = new StandardSuitFactory();
        $deck = new StandardDeck($suitFactory);
        $table = new Table("Table1", 10);
        $dealer = new Dealer($deck, $table);
        $this->assertEquals($deck, $this->getPropertyValue($dealer, 'deck'));

        return $dealer;
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::getDeck
     *
     * @depends testConstruct
     *
     * @since  nextRelease
     *
     * @param  Dealer $dealer The Dealer
     */
    public function testGetDeck(Dealer $dealer)
    {
        $this->assertEquals(
            $this->getPropertyValue($dealer, 'deck'),
            $dealer->getDeck()
        );
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::setDeck
     *
     * @depends testConstruct
     *
     * @since  nextRelease
     *
     * @param  Dealer $dealer The Dealer
     */
    public function testSetDeck(Dealer $dealer)
    {
        $deck = new Deck();
        $dealer->setDeck($deck);
        $this->assertEquals(
            $deck,
            $this->getPropertyValue($dealer, 'deck')
        );
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::getTable
     *
     * @depends testConstruct
     *
     * @since  nextRelease
     *
     * @param  Dealer $dealer The Dealer
     */
    public function testGetTable(Dealer $dealer)
    {
        $this->assertEquals(
            $this->getPropertyValue($dealer, 'table'),
            $dealer->getTable()
        );
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::setTable
     *
     * @depends testConstruct
     *
     * @since  nextRelease
     *
     * @param  Dealer $dealer The Dealer
     */
    public function testSetTable(Dealer $dealer)
    {
        $table = new Table("Table2");
        $dealer->setTable($table);
        $this->assertEquals(
            $table,
            $this->getPropertyValue($dealer, 'table')
        );
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::deal
     *
     * @since  nextRelease
     */
    public function testDeal()
    {
        $dealer = $this->getDealer();
        $table = $dealer->getTable();

        $player1 = new Player("Player1");
        $player2 = new Player("Player2");
        $table->addPlayer($player1)->addPlayer($player2);

        $this->assertEmpty($player1->getHand());
        $this->assertEmpty($player2->getHand());
        $this->assertTrue($dealer->deal());

        $this->assertNotEmpty($player1->getHand());
        $this->assertNotEmpty($player2->getHand());
        // $this->assertEquals(
        //     $table,
        //     $this->getPropertyValue($dealer, 'table')
        // );
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::update
     *
     * @depends testConstruct
     *
     * @since  nextRelease
     *
     * @param  Dealer $dealer The Dealer
     */
    public function testUpdate(Dealer $dealer)
    {
        $table = new Table("Table1", 10);
        $event = new TableEvent(1, "some message");
        $this->assertTrue($dealer->update($table, $event));
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::dealFlop
     *
     * @since  nextRelease
     */
    public function testDealFlop()
    {
        $dealer = $this->getDealer();
        $table = $dealer->getTable();

        $muckSize = $table->getMuck()->getSize();
        $communityCardsSize = $table->getCommunityCards()->getSize();

        $this->assertTrue($dealer->dealFlop());

        $this->assertEquals($muckSize + 1, $table->getMuck()->getSize());
        $this->assertEquals(
            $communityCardsSize + 3,
            $table->getCommunityCards()->getSize()
        );
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::dealTurn
     *
     * @since  nextRelease
     */
    public function testDealTurn()
    {
        $dealer = $this->getDealer();
        $table = $dealer->getTable();

        $muckSize = $table->getMuck()->getSize();
        $communityCardsSize = $table->getCommunityCards()->getSize();

        $this->assertTrue($dealer->dealTurn());

        $this->assertEquals($muckSize + 1, $table->getMuck()->getSize());
        $this->assertEquals(
            $communityCardsSize + 1,
            $table->getCommunityCards()->getSize()
        );
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::dealRiver
     *
     * @since  nextRelease
     */
    public function testDealRiver()
    {
        $dealer = $this->getDealer();
        $table = $dealer->getTable();

        $muckSize = $table->getMuck()->getSize();
        $communityCardsSize = $table->getCommunityCards()->getSize();

        $this->assertTrue($dealer->dealRiver());

        $this->assertEquals($muckSize + 1, $table->getMuck()->getSize());
        $this->assertEquals(
            $communityCardsSize + 1,
            $table->getCommunityCards()->getSize()
        );
    }

    /**
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::moveButton
     * @covers \TexasHoldemBundle\Gameplay\Game\Dealer::getNextPlayerSeat
     *
     * @since  nextRelease
     */
    public function testMoveButton()
    {
        $dealer = $this->getDealer();
        $table = $dealer->getTable();
        $this->assertFalse($dealer->moveButton());

        // $dealer->setDeck(new StandardDeck());
        $table = new Table("Table1", 6);
        $dealer->setTable($table);
        $this->assertFalse($dealer->moveButton());

        $player1 = new Player("p1");
        $player2 = new Player("p2");
        $player3 = new Player("p3");
        $player4 = new Player("p4");
        $table
            ->addPlayer($player1)
            ->addPlayer($player2)
            ->addPlayer($player3)
            ->addPlayer($player4);

        $this->assertTrue($player1->hasButton());
        $this->assertEquals($player2->getSeat(), $dealer->moveButton());
        $this->assertFalse($player1->hasButton());
        $this->assertTrue($player2->hasButton());
    }

    /**
     * Creates a Dealer
     *
     * @since  {nextRelease}
     *
     * @return Dealer
     */
    private function getDealer()
    {
        $tableFactory = new TableFactory();
        $table = $tableFactory->makeTableWithDealer("Table1", 6);
        return $table->getDealer();
    }
}
