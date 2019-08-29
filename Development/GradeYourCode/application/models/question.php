<?php

class Question extends MY_Model{
    const DB_TABLE = 'question';
    const DB_TABLE_PK = 'id';
    /**
     * To store the teacher id of the owner.
     * @var INT 
     */
    public $teacher_id;
    /**
     * To store course id.
     * @var int 
     */
  
    /**
     * 
     * @var String 
     */
    public $title;
    /**
     * To store  description of question.
     * @var String 
     */
    public $description;
  
     public $test_case;
     public $type;
     public $skeleton_code;
     public $skeleton_lang;
    
}
