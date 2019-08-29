<?php

class Announcement extends MY_Model{
    const DB_TABLE = 'announcement';
    const DB_TABLE_PK = 'id';
    
    public $course_id;
     public $teacher_id;
      public $announce;
      public $date;
    
}