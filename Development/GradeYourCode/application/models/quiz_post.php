<?php

class Quiz_post extends MY_Model{
    const DB_TABLE = 'quiz_post';
    const DB_TABLE_PK = 'id';
   
    public $quiz_id;
    public $start_time;
    public $end_time;
    public $end_ap;
    public $teacher_id; 
    
    
}
