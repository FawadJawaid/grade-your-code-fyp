<?php

class Student_code extends MY_Model{
    const DB_TABLE = 'student_code';
    const DB_TABLE_PK = 'id';
    
    public $student_id;
    public $question_id;
    public $quiz_id;
    public $code;
    public $language;
    
}