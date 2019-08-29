<?php

class Quiz extends MY_Model{
    const DB_TABLE = 'quiz';
    const DB_TABLE_PK = 'id';
   
    public $name;
    public $course_code;
    public $description;
    public $teacher_id;
    
}
