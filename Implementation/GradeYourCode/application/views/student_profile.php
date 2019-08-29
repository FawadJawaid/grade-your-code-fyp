<head>
    <title>Grade Your Code | My Profile</title>
            <script>
            $(function() {
                $("li.active").removeClass("active");
                $("#prof").addClass("active");
            });</script>

</head>



<?php

$query=$this->db->query("select * from student where id=".$this->session->userdata('UserID'));
$st = $query->first_row();

 

/*echo"<form action='profile' method='post' enctype='multipart/form-data'>";
echo"    Select image to upload:";
echo"    <input type='file' name='pic' id='fileToUpload'>";
echo "<input type='hidden' name='sub' value='123'>";
echo"    <input type='submit' value='Upload Image' name='submit'>";
echo"</form>";*/
echo"<div style='width:50%; margin: 0 auto; background: #71D6C6; padding-right: 8%; padding-left: 8%; padding-top: 3%; padding-bottom: 3%;text-align:center'>";
echo"<h1 class='page-header'>" .$st->fname." ".$st->lname. "</h1>";
$query=$this->db->query("select pic from stu_pic where student_id=".$this->session->userdata('UserID'));
$pic = $query->first_row();
//var_dump($pic);
if($pic!=NULL)
echo'<img style ="margin:0 auto;display:block;background-position: 50% 50%;
    background-repeat: no-repeat;
    border-radius: 50%;
    border: 2px solid #428bca;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    width: auto;
    height: 200px; "   src=http://localhost/GradeYourCode/uploads/'.$pic->pic.' alt="http://localhost/GradeYourCode/uploads/default.jpg" height="100" width="100">';
else
echo'<img src=http://localhost/GradeYourCode/uploads/default.jpg alt="http://localhost/GradeYourCode/uploads/default.jpg" height="100" width="100">';

echo '<div style="margin:0 auto;margin-left:35%;text-align:left;margin-top:20px">';
 echo form_open_multipart('student/profile');

echo'<input style="margin-bottom:20px" type="file" name="userfile" size="20" />';



echo '<input type="submit" value="Upload" />';
echo $error;
echo'</form>';


echo '</div>';

echo '<div style="margin-top:50px;margin-bottom:50px;text-align:left">';
echo "<h3><b>Section:</b> ".$st->section."</h3>";
echo "<h3><b>Email:</b> ".$st->email."</h3>";
echo "<h3><b>Phone Number:</b></h3>";
echo "<h3><b>Address:</b></h3>";
echo "<h3><b>Phone Number:</b></h3>";
echo "<h3><b>CNIC:</b></h3>";
echo "<h3><b>Father Name:</b></h3>";
echo "<h3><b>Country:</b></h3>";
echo "<h3><b>City:</b></h3></div></div>";

?>