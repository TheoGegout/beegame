<?php


namespace Bee;

use Bee\ScoutBee;
use Bee\QueenBee;
use Bee\WorkerBee;

class Hive
{
    protected array $hiveArray = [];

    public function __construct(array $queens, array $workers, array $scouts)
    {
        for ($i = 0; $i < $queens['qty']; $i++) {
            $this->hiveArray[0] = new QueenBee($queens['life'], $queens['hit']);
        }
        for ($i = $queens['qty']; $i < $workers['qty'] + $queens['qty']; $i++) {
            $this->hiveArray[$i] = new WorkerBee($workers['life'], $workers['hit']);
        }
        for ($i = $queens['qty'] + $workers['qty']; $i < $scouts['qty'] + $workers['qty'] + $queens['qty']; $i++) {
            $this->hiveArray[$i] = new ScoutBee($scouts['life'], $scouts['hit']);
        }
    }

    public function reset(): bool
    {
        foreach ($this->hiveArray as &$bee) {
            if (!$bee->restartLife()) {
                return false;
            }
        }
        return true;
    }

    public function hasGameFinished(): bool
    {
        $queen = 0;
        $otherBee = 0;
        for ($i = 0, $length = count($this->hiveArray); $i < $length; $i++) {
            if ($this->hiveArray[$i]->type() === 'Queen' && $this->hiveArray[$i]->haveLife()) {
                if ($queen === 0) {
                    $queen = 1;
                }
            } elseif ($this->hiveArray[$i]->type() !== 'Queen' && $this->hiveArray[$i]->haveLife()) {
                if ($otherBee === 0) {
                    $otherBee = 1;
                }
            }
            if ($queen === 1 && $otherBee === 1) {
                return false;
            }
        }
        return true;
    }

    public function getHive(): array
    {
        return $this->hiveArray;
    }

    public function howManyBees(): int
    {
        return count($this->hiveArray);
    }

    public function beesAlive(): array
    {
        $array = [];
        foreach ($this->hiveArray as $key => $bee) {
            if ($bee->haveLife()) {
                $array[$key] = $key;
            }
        }
        return $array;
    }

    public function hitRandBee(): bool
    {
        if (!empty($this->beesAlive())) {
            $index = array_rand($this->beesAlive(), 1);
            return $this->hiveArray[$index]->decreaseLife();
        }
        return false;
    }
}
