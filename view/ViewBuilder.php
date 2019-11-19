<?php

require_once './view/Observer.php';

abstract class ViewBuilder implements Observer
{
    protected $map;
}