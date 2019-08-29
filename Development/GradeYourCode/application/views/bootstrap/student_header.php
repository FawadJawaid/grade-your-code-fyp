<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap-theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/font-awesome.min.css" />
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url() ?>/js/bootstrap.js"> </script>

<!-- Changes Happened Here in Teacher Header too -->
<!-- FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
 
 <!-- Icons/FontAwesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/font-awesome.min.css" />

    <!-- Customizable CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css" />
    
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/custom.css" />

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
      <div class="navbar-brand" href="#">GradeYourCode</div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li id="home"><a href="<?php echo site_url(). "/student/"?>" >Home</a></li>
          <li id="myquiz"><a href="<?php echo site_url(). "/student/MyQuizzes"?>">Domains</a></li>
             <li id="sub"><a href="<?php echo site_url(). "/student/view_submissions"?>" >My Submissions</a></li>
              <li id="prof"><a href="<?php echo site_url(). "/student/result"?>">Results</a></li>
          <li id="prof"><a href="<?php echo site_url(). "/student/profile"?>">My Profile</a></li>
      </ul>
        <form class="navbar-form navbar-left" role="search" method="post" action=http://localhost/GradeYourCode/index.php/student/search_quiz>
        <div class="form-group">
          <input type="text" name="quiz_name" class="form-control" placeholder="Search A Quiz">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
          <li id="logout"><a href="<?php echo base_url('index.php/user_login/logout')?>">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>