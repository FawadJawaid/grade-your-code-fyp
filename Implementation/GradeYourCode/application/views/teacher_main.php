<!DOCTYPE html>
<html lang="en">
<head>
    <title>GradeYourCode | Teacher</title>
    <meta charset="utf-8">
    <meta name="description" content="GradeYourCode">
    
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap.css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/bootstrap.min.css" />
    <!-- Icons/FontAwesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/font-awesome.min.css" />
    <!-- totop -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/ui.totop.css" />
    <!-- owl carusol -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/owl.carousel.css" />
    <!-- zetta menu -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/zetta-menu.min.css" />
    <!-- layerSlider -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/layerslider.css" />
    <!-- Animation -->
    <link rel="stylesheet"type="text/css" href="<?php echo base_url() ?>css/animate.css" />
    <!-- cubeportfolio -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/cubeportfolio.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/main.css" />
    
    <!-- Customizable CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css" />
    
    <!-- FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>img/favicon.ico">
    
    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        a{color: #0FF3F3;}
        </style>
</head>
		
<body id="onepage">
    
    <!-- heaqder -->
    <header class="home section-parallax parallaxBg" style=" background-image:url('http://localhost/GradeYourCode/img/home_01.jpg');">
    	<div class="layer"></div>
    	<div class="container parallax-content">
        	<div class="row">
            	<?php
                $test_count=0;
                $query = $this->db->query("select * from user where id=" .$this->session->userdata('UserID'));
                    $st = $query->first_row();
                    ?>
                    <div class="col-sm-12">
                    <h2>Welcome <?php echo " ".$st->fname." ".$st->lname; ?></h2>
					
                    <h1>Current Quizzes</h1>
                <br /> <?php
                $query = $this->db->query("select * from quiz_post where teacher_id=".$this->session->userdata('UserID'));
                if ($query != NULL) {

                    $this->load->model('quiz_post');
                    $qu = array();
                    foreach ($query->result('quiz_post') as $row) {
                        $qu[] = $row;
                    }
                }
                    if($qu!=null){
                for ($i = 0; $i < count($qu); $i++) {
                    // echo $qu[$i]->quiz_id ;
                    $query = $this->db->query("select * from quiz where id=" . $qu[$i]->quiz_id);
                    $ow[$i] = $query->first_row();

                    // echo $qu[$i]->end_time."   ";
                    // echo date("Y-m-d g:i", strtotime("now"));
                    // echo '<br>';
                    if ($qu[$i]->end_time > date("Y-m-d g:i:s", strtotime("now"))) {// && $qu[$i]->end_ap==date("a", strtotime("now")))
                        echo "<a href='" . base_url('index.php/teacher/ViewQuizDescription/' . $ow[$i]->id) . "' >" . $ow[$i]->name . "</a> Quiz of " . $ow[$i]->course_code . " is Live with deadline " . $qu[$i]->end_time . $qu[$i]->end_ap;
                        echo'<br><br>';
                    }
                    }
                    
                    }
                    else
                    {echo "No Current Quizzes";}
                ?>

                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </header>
    <!-- end header -->
    
    
    <!-- about us -->
 	<section class="content-2 section-grey">
    	<div class="container">
            <div class="row">
                
                <h1 class="text-center">Past Quiz Results </h1>
                
                
                <?php
                   $query = $this->db->query("select id,name from quiz where teacher_id=".$this->session->userdata('UserID'));
                        $t_id = array();
                         if ($query != NULL) {
            $this->load->model('quiz');
          

            foreach ($query->result('quiz') as $row) {
                $t_id[] = $row;
            }
        }    
                
                for($i=0;$i<count($t_id);$i++){
                $query = $this->db->query("select distinct student_id from student_code where quiz_id=".$t_id[$i]->id);
                        $stu_id = array();
                         if ($query != NULL) {
            $this->load->model('student_code');
          

            foreach ($query->result('student_code') as $row) {
                $stu_id[] = $row;
            }
        }                
                        
        
        for($z=0;$z<count($stu_id);$z++){
        $query = $this->db->query("select question_id from student_code where student_id=".$stu_id[$z]->student_id." and quiz_id=".$t_id[$i]->id);
            
             $q_id = array();
                         if ($query != NULL) {
            $this->load->model('student_code');
          

            foreach ($query->result('student_code') as $row) {
                $q_id[] = $row;
            }
        }              
            
          
        for($k=0;$k<count($q_id);$k++){
      //      echo "question:id ".$q_id[$k]->question_id."<br>";
                         $query = $this->db->query("select count(id) as c from question_tc where ques_id=".$q_id[$k]->question_id);
                           $count = $query->first_row();
                      //     var_dump($count->c);
                       //    echo "  ".intval($count->c)."  ";
                          $test_count=$test_count+ intval($count->c);
                           
                         
        }   
            
        }
          $query = $this->db->query("select count(id) as cm from marks where quiz_id=".$t_id[$i]->id);
                           $count_marks = $query->first_row();
                           
                          // echo "test cases submission: ".$test_count;
                          // echo "<br>checked: ".$count_marks->cm;
                         //  echo"<br>";
                            $query = $this->db->query("select end_time from quiz_post where  quiz_id=".$t_id[$i]->id);
                           $qp = $query->first_row();
                        if ($qp->end_time < date("Y-m-d g:i:s", strtotime("now"))) {
                       
                           if($test_count == $count_marks->cm)
                           { 
         //                       echo $t_id->name."  <td><a class='btn btn-large btn-danger'   href='" . base_url('index.php/teacher/download_pdf/' . $t_id[$i]->id) . "'>Download Result</a></td>";
       echo "<b> " . $t_id[$i]->name."</b> <td><a class='btn btn-large btn-primary'   href='" . base_url('index.php/teacher/download_pdf/' . $t_id[$i]->id) . "'>Download Result</a></td>";                 
                               
                               }
                       
                        
                        }


                echo '</tr>';}
                ?>
                
                
            </div><!-- end row -->
		</div><!-- end container -->        
    </section>
    <!-- end about us -->
    
    <!-- about us image parallax -->
    <section class="content section-parallax parallaxBg-2" style="background-image: url('http://localhost/GradeYourCode/img/bn4.jpg'); height: 400px;"></section>
    <!-- end about us image parallax -->
    
    <!-- our vision -->
    <section class="content-2 section-grey">
    	<div class="container">
        	<div class="row">
            	<h3 class="text-center">Domains</h3>
                <div class="line"></div>
                
                <p class="lead text-center margin-bottom-45">AAA</p>
                
              
                
               
                
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- end our vision -->
    
    <!-- Our Facts -->
   
    <!-- services -->
    
    <!-- end portfolio -->
    
    <!-- client -->
   
    
    <!-- contact -->
   
    <!-- end contact -->
    
  
    <!-- jQuery -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fitvids.js"></script>
    <script src="js/owl.carousel.js"></script>
    <!--<script src="js/jquery.ui.totop.min.js"></script>-->
    <script src="js/jquery.countTo.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/jquery.cubeportfolio.min.js"></script>
    <script src="js/lightbox-gallery.js"></script>
    <script src="js/main.js"></script>
    
    <script>
		//Animation Wow.js
		new WOW().init();
		
		//sticky menu
		$(".navbar").sticky({topSpacing:0});
	
    </script>
    
    <script>
		$(document).ready(function(){
			$('#nav a').on('click', function() {
				var scrollAnchor = $(this).attr('data-scroll'),
					scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top - 69;
				$('body,html').animate({
					scrollTop: scrollPoint
				}, 500);
				return false;
			})
			$(window).scroll(function() {
				var windscroll = $(window).scrollTop();
				if (windscroll >= 100) {
					$('section[data-anchor]').each(function(i) {
						if ($(this).position().top <= windscroll + 71) {
							$('#nav li.zm-active').removeClass('zm-active');
							$('#nav li.nav').eq(i).addClass('zm-active');
						}
					});
				} else {
					$('#nav li.zm-active').removeClass('zm-active');
				}
			}).scroll();
		});
	</script>
    
</body>
</html>
