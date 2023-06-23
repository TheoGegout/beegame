<?php

namespace Bee;

abstract class Bee
{
    public int $lifeSpan = 0;
    public int $hit = 0;
    public string $type = 'Bee';
    public int $life = 0;

    public function __construct(int $life, int $hit)
    {
        $this->lifeSpan = $life;
        $this->hit = $hit;
        $this->life = $life;
    }

    public function decreaseLife(): bool
    {
        return (($this->lifeSpan - $this->hit) < 0) ? $this->lifeSpan = 0 : $this->lifeSpan -= $this->hit;
    }

    public function restartLife(): bool
    {
        return $this->lifeSpan = $this->life;
    }

    public function haveLife(): bool
    {
        return $this->lifeSpan > 0 ? true : false;
    }

    public function type(): string
    {
        return $this->type;
    }
}
