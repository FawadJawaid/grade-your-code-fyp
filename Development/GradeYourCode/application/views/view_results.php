
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


<nav class="navbar navbar-default " role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand" >GradeYourCode</div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="thome"><a href="<?php echo site_url() . "/teacher" ?>" >Home</a></li>
                <li id="nques"><a href="<?php echo site_url() . "/teacher/CreateQuestion" ?>">New Question</a></li>
                <li id="nquiz"><a href="<?php echo site_url() . "/teacher/set_domain" ?>">New Quiz</a></li>    
                <li id="myques"><a href="<?php echo site_url() . "/teacher/ViewQuestion" ?>">My Questions</a></li>
                <li id="activequiz"><a href="<?php echo site_url() . "/teacher/active_quizes" ?>">My Quizzes</a></li>
                <li id="queslib"><a href="<?php echo site_url() . "/teacher/GetSquestions" ?>">Questions Library</a></li>
<li id="queslib"><a href="<?php echo site_url() . "/teacher/announcement" ?>">Announcement</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li id="logout"><a href="<?php echo site_url() . "/user_login/logout" ?>">Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div style="width:50%; margin: 0 auto; background: #71D6C6; padding-right: 5%; padding-left: 5%; padding-top: 5%; padding-bottom: 5%;">

<?php

echo"<h1>Question Marks</h1>";
for($i=0;$i<count($result);$i++)
{
    $query = $this->db->query("select sum(points)as points from question_tc where ques_id=" . $result[$i]->question_id." group by ques_id");
    $tot = $query->first_row();
    echo "Student id: ".$result[$i]->student_id." Question_id : ".$result[$i]->question_id." Marks Got: ".$result[$i]->numbers." Out of ".$tot->points ;
    echo "<br>";
    
    
}

echo"<h1>Quiz Marks</h1>";

for($i=0;$i<count($quiz_result);$i++)
{
    
     echo "Student id: ".$quiz_result[$i]->student_id." Marks Got: ".$quiz_result[$i]->numbers." out of ".$quiz_tot;
    
    echo "<br>";
    
}
?>

  
</div>
     
<footer class="dark content">
        <div class="container text-center">
            <div class="row">
            	<div class="margin-top-20 margin-bottom-20">    
                    <a href="#" class="social-icon-jump-x4 circle">
                        <div>
                            <i class="fa fa-facebook facebook-icon-jump"></i>
                            <i class="fa fa-facebook social-icon-jump-dark"></i>
                        </div>
                    </a>
                    <a href="#" class="social-icon-jump-x4 circle">
                        <div>
                            <i class="fa fa-twitter twitter-icon-jump"></i>
                            <i class="fa fa-twitter social-icon-jump-dark"></i>
                        </div>
                    </a>
                    <a href="#" class="social-icon-jump-x4 circle">
                        <div>
                            <i class="fa fa-dribbble dribbble-icon-jump"></i>
                            <i class="fa fa-dribbble social-icon-jump-dark"></i>
                        </div>
                    </a>
                    <a href="#" class="social-icon-jump-x4 circle">
                        <div>
                            <i class="fa fa-linkedin linkedin-icon-jump"></i>
                            <i class="fa fa-linkedin social-icon-jump-dark"></i>
                        </div>
                    </a>
                    <a href="#" class="social-icon-jump-x4 circle">
                        <div>
                            <i class="fa fa-youtube youtube-icon-jump"></i>
                            <i class="fa fa-youtube social-icon-jump-dark"></i>
                        </div>
                    </a>
                </div>
                <p>2015 &copy; All Rights Reserved.</p>
            </div><!-- end row -->
        </div><!-- end container -->
    </footer>
    

<!--

<div class="panel panel-default" style="margin: 10px !important;border: 0;background-color:#71D6C6;box-shadow: none">
    <hr style="width: 95%;border-width: 2px; border-color: #05C07D;">
    <div class="panel-footer" style="padding: 15px 25px !important;background-color: #71D6C6;border: 0"><div style="float:left">&nbsp;&nbsp;&copy ZSZF 2014</div>
        <div style="text-align: right">
            <a href="<?php echo site_url() . "/homepage/whatisGYC" ?>" class="inline">What is "Grade Your Code"?</a>
            &nbsp;&nbsp;|&nbsp;&nbsp; 
        <a href="<?php echo site_url() . "/homepage/aboutus" ?>">About Us</a>
        &nbsp;&nbsp;
    </div>
    </div>
</div>