<?php

class Question_tc extends MY_Model{
    const DB_TABLE = 'question_tc';
    const DB_TABLE_PK = 'id';
   
    public $ques_id;
    public $input;
    public $output;
    public $points;
    
}
