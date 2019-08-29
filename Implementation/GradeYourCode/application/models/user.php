<?php

class User extends MY_Model{
    const DB_TABLE = 'user';
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
    
    public function getID(){
         return $this->{$this::DB_TABLE_PK};
    }
    
    public function entry_update(){
	$this->load->library('encrypt');
	 // $this->load->database();
	  $data = array(
	           
   			   
	            'EMAIL'=>$this->input->post('email'),
	           
	          );
			   $data1 = array(
	            
	            'FNAME'=>$this->input->post('firstname'),

	          );
			   $data2 = array(
	            
	            'LNAME'=>$this->input->post('lastname'),

	          );
	  $data3 = array(
	            
	            'PASSWD'=>$this->encrypt->sha1($this->input->post('pass'), ':j1P.UpoWs)lG$(W)",4'),

	          );
			  
	  
	  $this->db->where('ID',$this->session->userdata('UserID'));
     if($this->input->post('email'))
	 $this->db->update('user',$data);
   
      $this->db->where('ID',$this->session->userdata('UserID'));
     if($this->input->post('firstname'))
	 $this->db->update('user',$data1);
	       
	  $this->db->where('ID',$this->session->userdata('UserID'));
     if($this->input->post('lastname'))
	 $this->db->update('user',$data2);
	    
	  $this->db->where('ID',$this->session->userdata('UserID'));
	 if($this->input->post('pass'))
	  $this->db->update('pswd',$data3);
	  
	//  echo 'changed';
        return true;	  
    }
}

