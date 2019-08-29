<html>
    <head>

        <title>Grade Your Code | Login</title>
        <script>
            $(function () {
                $("li.active").removeClass("active");
                $("#login").addClass("active");
            });</script>

        <style>
            html,
            body {
                width: 100%;
                height: 100%;
            }
            body {
                margin: 0 auto;
                display: table;
                text-align: center;
                font-family: 'Open Sans', sans-serif;
                background: #71D6C6 !important;
            }

            .former {
                margin: 0 auto;
                display: table;
                text-align: center;
                font-family: 'Open Sans', sans-serif;
                background: #71D6C6;
                max-width: 100em;
            }


            .wrap {
                margin-top:50px;
            }

            .flip-container {
                perspective: 1000;
                border-radius: 50%;
                margin: 0 auto 10px auto;
            }

            .logged-in {
                transform: rotateY(180deg);
            }

            .flip-container, .front, .back, .back-logo {
                width: 130px;
                height: 130px;
            }

            .flipper {
                transition-duration: 0.6s;
                transform-style: preserve-3d;
            }

            .front, 
            .back {
                backface-visibility: hidden;
                position: absolute;
                background-size: cover;
            }

            .front {
                background: url(http://s8.postimg.org/y7z5wso29/Flip_Img.png) 0 0 no-repeat;
            }

            .back {
                transform: rotateY(180deg);
                background: url(http://s8.postimg.org/u04do1mmp/Flip_Img2.png) 0 0 no-repeat;
            }

            h1 {
                <!-- font-size: 22px; -->
                color: #FFF;
            }
            h1 span {
                font-weight: 300;
            }
            input[type=text],
            input[type=password] {
                color:#FFF;
                background: #71D6C6; /* Old browsers */
                background: linear-gradient(45deg,  #71D6C6 0%,#2AC7AE 100%); /* W3C */
                width:250px;
                height:40px;
                margin: 0 auto 10px auto;
                font-size:14px;
                padding-left:15px;
                border:none;
                box-shadow: -3px 3px #2AC7AE ;
                -webkit-appearance:none;
                border-radius:0;
                border-top: 1px solid #48E2CA;
                border-right: 1px solid #48E2CA;
            }
            input::-webkit-input-placeholder { 
                color: #FFF;
            }
            input:focus {
                outline:none;
                border-color: #48E2CA !important;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px #2AC7AE !important;
            }

            a {
                color:#1c70a7;
                //font-weight:600;
                /* font-size:12px; */
                text-decoration:none;
            }
            a:hover {
                color:#3f7ba2;
            }

            .hint
            {
                width:250px;
                dislay:block;
                margin:80px auto 0 auto;
                text-align:left;
            }

            .hint p
            {
                padding: 5px 0 5px 0;
                color:#FFF;
                font-weight:600;
                font-size:20px;
            }

            .hint p span
            {
                font-weight:300;
                font-size:16px;
            }

        </style>

        <script src="prefixfree.min.js"></script>

    </head>
    <body>
        <!-- <div style="width:25%;margin:0 auto"> -->

        <div class="wrap" style="width: 50%; margin: 0 auto;">



            <?php echo validation_errors(); ?>
            <?php echo form_open('user_login/Index'); ?>
            <div class = "flip-container" id = 'flippr'>
                <div class = "flipper">
                    <div class = "front"></div>
                    <!--<div class = "back"></div> -->
                </div>
            </div>
            <div class = "former" style = "width:25%;margin:0 auto">
                <h1 class = "page-header">Login</h1>

                <?php echo form_input(['name' => 'username', 'id' => 'username', 'class' => 'form-control', 'placeholder' => 'Username' , 'value' => set_value('username')]);
                ?>
                <br/>
                <?php echo form_password(['name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password' , 'value' => set_value('password')]); ?>
                <br />

                <div style="margin-left: 1%">
                    <label class="radio-inline">
                        <input type="radio" name="type" value = "teacher" checked>Teacher
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="type" value = "student">Student
                    </label>
                </div>
                <br/>


                <?php echo form_submit(['name' => 'login', 'id' => 'Login', 'class' => 'btn btn-large btn-primary', 'value' => 'Login', 'style' => 'width:50%']); ?>

                <?php echo form_close(); ?>
            </div>
            <!-- </div> -->
        </div> <!-- Wrap -->

        <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
        <script src="index.js"></script>
    </body>
</html>