<?php


$username = "root";
$password = "admin";
$hostname = "localhost"; 
$db = "gyc";

//connection to the database
$dbhandle = mysqli_connect($hostname, $username, $password, $db) 
  or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";

/*$selected = mysql_select_db("gyc",$dbhandle) 
  or die("Could not select examples");
echo "Connected to GYC<br>";*/ 

$data = "SELECT code FROM student_code WHERE quiz_id=11 AND question_id = 141";

if ($result=mysqli_query($dbhandle,$data))
  {
  // Fetch one and one row
  $i = 1;
  while ($row=mysqli_fetch_row($result))
    {
    //printf ("%s (%s)\n",$row[0],$row[1]);
	$myfile = fopen("test/newfile".$i.".cpp", "w") or die("Unable to open file!");
    fwrite($myfile, $row[0]);
	fclose($myfile);
	$i++;
	//echo $row[0];
    }
	
	
	
  // Free result set
  mysqli_free_result($result);
}

mysqli_close($dbhandle);

include("moss.php");
$userid = 394638726; // Enter your MOSS userid
$moss = new MOSS($userid);
$moss->setLanguage('cc');
$moss->addByWildcard('test/*.cpp');
//$moss->addBaseFile('pi3.cpp');
$moss->setCommentString("This is a test");
print_r($moss->send()); 
?>