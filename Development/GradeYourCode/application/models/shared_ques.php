<?php

class Shared_ques extends MY_Model{
    const DB_TABLE = 'shared_question';
    const DB_TABLE_PK = 'id';
   
    public $ques_id;
    public $teacher_id;
    public $orig_teacher;
    
}
