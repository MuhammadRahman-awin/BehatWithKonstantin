<?php

class Cost
{
    /**
     * @var float
     */
    private $float;

    public function __construct($float)
    {
        $this->float = $float;
    }

    public function toFloat()
    {
        return floatval($this->float);
    }

    public function __toString()
    {
        return (string)$this->float;
    }
}
