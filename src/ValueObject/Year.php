<?php

namespace App\ValueObject;

class Year
{
    /**
     * @var int|null
     */
    private $value;

    /**
     * @return int|null
     */
    public function getValue():? int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}