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