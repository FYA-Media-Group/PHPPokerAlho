<?php

namespace TexasHoldemBundle\Gameplay\Cards;

/**
 * A Suit with a name and a symbol
 *
 * @since  {nextRelease}
 *
 * @author Artur Alves <artur.ze.alves@gmail.com>
 */
class Suit
{
    /**
     * The Suit's name
     *
     * @var string
     */
    private $name;

    /**
     * The Suit's symbol
     *
     * @var string
     */
    private $symbol;

    /**
     * The Suit's abbreviation
     *
     * @var string
     */
    private $abbreviation;

    /**
     * Constructor
     *
     * @since  {nextRelease}
     *
     * @param  string $name The Suit's name
     * @param  string $symbol The Suit's symbol
     * @param  string $abbr The Suit's abbreviation
     */
    public function __construct($name = null, $symbol = null, $abbr = null)
    {
        $this->setName($name);
        $this->setSymbol($symbol);
        $this->setAbbreviation($abbr);
    }

    /**
     * Return a string representation of the Suit
     *
     * @since  {nextRelease}
     *
     * @return string The Card represented as a string
     */
    public function __toString()
    {
        return $this->symbol;
    }

    /**
     * Get the Suit's name
     *
     * @since  {nextRelease}
     *
     * @return string The Suit's name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the Suit's name
     *
     * @since  {nextRelease}
     *
     * @param  string $name The Suit's name
     *
     * @return Suit
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the Suit's symbol
     *
     * @since  {nextRelease}
     *
     * @return string The Suit's symbol
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * Set the Suit's symbol
     *
     * @since  {nextRelease}
     *
     * @param  string $symbol The Suit's symbol
     *
     * @return Suit
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * Get the Suit's abbreviation
     *
     * @since  {nextRelease}
     *
     * @return string The Suit's abbreviation
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * Set the Suit's abbreviation
     *
     * @since  {nextRelease}
     *
     * @param  string $abbreviation The Suit's abbreviation
     *
     * @return Suit
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;
        return $this;
    }
}
