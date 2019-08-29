<?php

class Quiz_question extends MY_Model{
    const DB_TABLE = 'quiz_question';
    const DB_TABLE_PK = 'id';
   
    public $quiz_id;
    public $question_id;
    
    
}
