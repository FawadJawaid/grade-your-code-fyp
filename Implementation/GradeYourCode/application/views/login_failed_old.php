<html>
    <head>
        <title>Grade Your Code | Login</title>
        <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#login").addClass("active");
            });</script>
    </head>
    <body>
        <div style="width:25%;margin:0 auto">
            <?php echo validation_errors(); ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Login Failed:</span>
                Login Failed: Please Retry !
            </div>
            <?php echo form_open('user_login/Index'); ?>
            <h1 class="page-header">Login</h1>
            <?php echo form_input(['name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Username']); ?>

            <br/>
            <?php echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']); ?>
            <br />
            <div style="margin-left: 25%">
                <label class="radio-inline">
                    <input type="radio" name="type" value = "teacher" checked>Teacher
                </label>
                <label class="radio-inline">
                    <input type="radio" name="type" value = "student">Student
                </label>
            </div>
            <br/>
            <?php echo form_submit(['name' => 'login', 'id' => 'Login', 'class' => 'btn btn-lg btn-primary btn-block', 'value' => 'Login']); ?>

            <?php echo form_close(); ?>
        </div>

    </body>
</html>