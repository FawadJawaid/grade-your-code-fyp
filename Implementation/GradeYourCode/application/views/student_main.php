<!DOCTYPE html>
<html lang="en">
<head>
     <title>GradeYourCode | Student</title>
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
                
                $query = $this->db->query("select * from student where id=" .$this->session->userdata('UserID'));
                    $st = $query->first_row();
                    ?>
                    <div class="col-sm-12">
                    <h2>Welcome <?php echo " ".$st->fname." ".$st->lname; ?></h2>
					
                    <h1>Current Quizzes</h1>
                <br /> <?php
                $query = $this->db->query("select qp.* from quiz_post qp, quiz_student qs where qs.student_id='" . $this->session->userdata('UserID') . "' and qp.quiz_id=qs.quiz_id");
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
                        echo "<a href='" . base_url('index.php/student/ViewQuizDescription/' . $ow[$i]->id) . "' >" . $ow[$i]->name . "</a> Quiz of " . $ow[$i]->course_code . " is Live with deadline " . $qu[$i]->end_time . $qu[$i]->end_ap;
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
                
                <h1 class="text-center">Quiz Announcements </h1>
                
               
                 <?php
                  echo "<br>";
                echo "<br>";
                 $query = $this->db->query("select a.* from quiz_ano a,stu_course sc where sc.student_id=".$this->session->userdata('UserID')." and a.course_id=sc.course_id order by id desc limit 10");
             if ($query != NULL) {
            $this->load->model('quiz_ano');
            $an = array();

            foreach ($query->result('quiz_ano') as $row) {
                $an[] = $row;
            }
        }
            
            //var_dump($an);
           for($i=0;$i<count($an);$i++)
           {
               
               echo "<b>".$an[$i]->course_id." : ".$an[$i]->anounce." (".$an[$i]->date.")</b>";
               echo "<br>";
               
           }
           
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
            	<h3 class="text-center">Teacher Announcements</h3>
                <div class="line">
                    
                    
                </div>
                <?php
                 $query = $this->db->query("select a.* from announcement a,stu_course sc where sc.student_id=".$this->session->userdata('UserID')." and a.course_id=sc.course_id order by id desc limit 10");
             if ($query != NULL) {
            $this->load->model('announcement');
            $an = array();

            foreach ($query->result('announcement') as $row) {
                $an[] = $row;
            }
        }
            
            //var_dump($an);
           for($i=0;$i<count($an);$i++)
           {
               
               echo "<b>".$an[$i]->course_id." : ".$an[$i]->announce." (".$an[$i]->date.")</b>";
               echo "<br>";
               
           }
           
                ?>
                <p class="lead text-center margin-bottom-45"></p>
                
              
                
               
                
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
    
    <!-- footer -->
    
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
