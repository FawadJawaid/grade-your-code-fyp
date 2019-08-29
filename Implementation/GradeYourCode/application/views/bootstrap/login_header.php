<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/bootstrap-theme.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/css/custom.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/js/bootstrap.js"></script>

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
            <div class="navbar-brand">GradeYourCode</div>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li id="whatis"><a href="<?php echo site_url() . "/homepage/whatisGYC" ?>">What is "Grade Your Code"?</a></li>
            <li id="about"><a href="<?php echo site_url() . "/homepage/aboutus" ?>">About Us</a></li>

            <?php
            if ($this->session->userdata('type')) {
                echo '<li id="dashboard"><a href="';
                echo site_url() . '/' . $this->session->userdata('type');
                echo '">Go to Dasboard</a></li>';
            } else {
                echo '<li id="login"><a href="';
                echo site_url() . '/homepage/login">Login</a></li>';
            }
            ?>

        </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>