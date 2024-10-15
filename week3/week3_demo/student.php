<?php

include 'person.php';

class Student extends Person{

    public $studentID;

    public function __construct($firstArg, $lastArg, $studentID){
        parent::__construct($firstArg, $lastArg);
        $this->studentID = $studentID;
    }

    public function getPersonInfo(){
        return $this->first . ' ' . $this->last . ' (' . $this->studentID . ')';  
    }
}