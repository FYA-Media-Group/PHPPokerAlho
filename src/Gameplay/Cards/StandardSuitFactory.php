<?php

namespace PHPPokerAlho\Gameplay\Cards;

/**
 * A Factory that creates all standard Poker Suits
 *
 * @since  {nextRelease}
 *
 * @author Artur Alves <artur.ze.alves@gmail.com>
 */
class StandardSuitFactory extends Suit
{
    /**
     * Standard Suit Clubs ♣
     *
     * @var string
     */
    const STD_CLUBS = array("Clubs", "♣");

    /**
     * Standard Suit Diamonds ♦
     *
     * @var string
     */
    const STD_DIAMONDS = array("Diamonds", "♦");

    /**
     * Standard Suit Hearts ♥
     *
     * @var string
     */
    const STD_HEARTS = array("Hearts", "♥");

    /**
     * Standard Suit Spades ♠
     *
     * @var string
     */
    const STD_SPADES = array("Spades", "♠");
    /**
     * Constructor
     *
     * @since  {nextRelease}
     *
     * @param array $cont The Suit's name and symbol
     */
    public function create(array $const)
    {
        $suit = new Suit();
        $suit->setName($const[0]);
        $suit->setSymbol($const[1]);
        return $suit;
    }
}