<?php

class Student extends MY_Model{
    const DB_TABLE = 'student';
    const DB_TABLE_PK = 'id';
    
    /**
     * To store user's email address.
     * @var string 
     */
    public $email;
    /**
     * To store user's first name.
     * @var string 
     */
    public $fname;
    /**
     * To store user's last name.
     * @var string 
     */
    public $lname;
    public $section;
    public $password;
}