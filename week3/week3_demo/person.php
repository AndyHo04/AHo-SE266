<?php

abstract class Person
{
    protected $first;
    protected $last;

    public function __construct($firstArg, $lastArg){
        $this->first = $firstArg;
        $this->last = $lastArg;
    }

    public function setFirst($firstArg){
        $this->first = $firstArg;
    }

    public function getFirst(){
        return $this->first;
    }

    public function setLast($lastArg){
        $this->last = $lastArg;
    }

    public function getLast(){
        return $this->last;
    }

    public function getFullName(){
        return $this->first . ' ' . $this->last;
    }

    abstract function getPersonInfo();
}







