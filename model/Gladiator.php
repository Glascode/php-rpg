<?php

abstract class Gladiator {

    protected $name;
    protected $health;
    protected $attack;

    public function __construct($name) {
        $this->name = $name;
        $this->health = 100;
    }

    public function attack(Gladiator &$gladiator) {
        $gladiator->setHealth($gladiator->getHealth() - $this->attack);
    }

    public function isDead() {
        return $this->health <= 0;
    }

    /* Getters and Setters */

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getAttack() {
        return $this->attack;
    }

    public function setAttack($attack) {
        $this->attack = $attack;
    }

    public function getHealth() {
        return $this->health;
    }

    public function setHealth($health) {
        $this->health = $health;
    }

    public function __toString() {
        return "$this->name ($this->attack, H$this->health)";
    }
}
