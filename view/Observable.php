<?php

interface Observable
{
    /**
     * Adds an observer to this Observable.
     *
     * @param Observer $observer the observer to be added
     */
    function attachObserver(Observer $observer);

    /**
     * Notifies update for the observers of this Observable.
     */
    function notifyObservers();
}