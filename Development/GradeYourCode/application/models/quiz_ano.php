<?php

class Quiz_ano extends MY_Model{
    const DB_TABLE = 'quiz_ano';
    const DB_TABLE_PK = 'id';
    
    public $quiz_id;
     public $anounce;
     public $course_id;
      public $date;
    
}