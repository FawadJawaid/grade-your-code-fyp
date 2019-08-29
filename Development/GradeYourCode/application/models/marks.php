<?php

class Marks extends MY_Model{
    const DB_TABLE = 'marks';
    const DB_TABLE_PK = 'id';
    
    public $quiz_id;
     public $question_id;
      public $student_id;
      public $numbers;
      public $test_case_id;
    
}