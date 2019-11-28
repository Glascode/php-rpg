<?php

abstract class Model implements Observable
{
    /**
     * @var array the list of observers of this Observable
     */
    protected $observers = [];

    /**
     * {@inheritDoc}
     */
    public function attachObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * {@inheritDoc}
     */
    public function notifyObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}