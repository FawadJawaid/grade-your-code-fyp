<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>/js/bootstrap.js"></script>
<script src="<?php echo base_url() ?>/js/bootstrap-select.min.js"></script>
<script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>
<script>
    function jsfunction()
    {
      //  alert(arguments[0]);
      //  alert(arguments[2]);
       
        var a=arguments[0].replace(">","> \n");
        
       // a=arguments[0].replace("`","\r");
        var ponits=arguments[7];
        var outp=arguments[3];
        var s_id=arguments[4];
        var que_id=arguments[5];
        var quiz_id=arguments[6];
        var t_case=arguments[8];
        var json = {
                            language: arguments[1],
                            code:a ,
                            stdin: arguments[2]
                        }; console.log(json);
        $.post("http://gyc.cloudapp.net:9234/compile", json, function(data, error, xhr) {

              // var percent;
               // alert(data.output);
                         //   document.getElementById("output").innerHTML = data.output + "<br><br>" + data.errors + "<br><br>";
       // result=data.output;  
       // inp=arguments[3]
      //  alert(similar_text(data.output.toString(), arguments[3], percent)); 
       // alert();
      /* if(data.output)
           alert("data");
           
        */
    //  return data.output;
    //alert(outp);
       //if(data.errors)
         //  alert("error");
    //alert(data.output);
    
        var j={output:outp,result:data.output,stu_id:s_id,que_id:que_id,quiz_id:quiz_id,points:ponits,test_case:t_case};
    $.post( "http://localhost/GradeYourCode/index.php/teacher/save_grade",j,function() {
  //alert( "success" );
});
       
        });
   
    

    }
    </script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap-theme.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>/js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap-select.min.css" />
  <!-- Changes Happened Here in Student Header too -->
  <!-- FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
 
 <!-- Icons/FontAwesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/font-awesome.min.css" />

    <!-- Customizable CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css" />
    
    
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/custom.css" />
<script src="<?php echo base_url() ?>/js/bootstrap-select.min.js"></script>
<script src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'></script>


 <div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 5%; padding-left: 5%; padding-top: 5%; padding-bottom: 5%;">

<?php
 for ($i = 0; $i < count($submission); $i++)
       {  
         
           $c= $submission[$i]->code;
        
       $l=   $submission[$i]->language;
       
        
      $c=  str_replace("\n","",$c);
      $c= str_replace("\r","",$c);
      //addcslashes($c,' \" ')
      //  $c= nl2br(str_replace('\\r\\n', "zm", $c));
       //addcslashes($c,'')
     //  echo"123";
   //    $c=  str_replace(">","> \n",$c);
      for($j=0;$j<count($test_case);$j++)
      {  echo "Question Number: ";
          echo $que_num+1;
          echo " Loading! ";
          echo "<br>";
          echo "test case id:";
      echo $test_case[$j]->id;
      echo "   ";
      echo "<br><br>";
          $test_case_id=$test_case[$j]->id;
          $inp=$test_case[$j]->input;
          $inp=str_replace("\n"," ",$inp);
          $inp=str_replace("\r"," ",$inp);
          
          $out=$test_case[$j]->output;
          $out=str_replace("\n","\b^",$out);
          $out=str_replace("\r","\b`",$out);
          $points=$test_case[$j]->points;
         // echo $inp;
          $st_id=$submission[$i]->student_id;
            $qs_id=$submission[$i]->question_id;
            $qz_id=$submission[$i]->quiz_id;
      /*      $inp=  str_replace("\n","",$inp);
      $inp= str_replace("\r","",$inp);
      $out=  str_replace("\n","",$out);
      $out= str_replace("\r","",$out);*/
           set_time_limit(0) ;
       $func= "jsfunction('".$c."',". $l.",'".$inp."','".$out."','".$st_id."','".$qs_id."','".$qz_id."','".$points."','".$test_case_id."'  );";
         
        echo "<script type='text/javascript'>"
            , $func
              , "</script>";
      //  echo"456";
    //  echo $ret;
       
      }
        
      }
       

?>

 </div>

