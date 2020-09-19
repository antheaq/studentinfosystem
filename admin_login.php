<?php

require_once "functions.php";

?>

<!DOCTYPE html>
<html>

<head>
    <title>LA University Student Information System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/custom_admin.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>


</head>

<body>

    <header class="masthead">
        <div class="jumbotron">
            <div class="logo-top-tiny text-center">
                <img class="img-responsive " text-center src="assets/img/la-logo-tiny.png" alt="la-logo-tiny">
            </div>
            <h1>LA University</h1>
            <p>Student Information System</p>
        </div>
        <nav class="navbar navbar-dark navbar-expand-lg justify-content-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="navbar-nav mx-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Cards Admin Forms -->
    <section id="adminForms">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center py-3">Sign in as Admin</h4>
                            <form id="adminLoginForm" action="functions.php" method="POST">

                                <?php
                                if (isset($_SESSION['message'])) : ?>

                                    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> my-2 py-1">
                                        <?php
                                        echo $_SESSION['message'];
                                        unset($_SESSION['message']);
                                        ?>
                                        <button type="button" class="close pl-2" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif ?>

                                <div class="form-group">
                                    <i class="fa fa-envelope icon-admin"></i>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                </div>

                                <div class="form-group">
                                    <i class="fa fa-lock icon-admin"></i>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>

                                <div class="text-right mb-3">
                                    <button type="submit" class="btn btn-success btn-lg" name="adminLoginBtn">Login</button>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="text-left"><a href="student_login.php"> Sign in as Student </a></p>
                                    </div>
                                    <div class="col-lg-6 text-right">
                                        <p> No account yet? <a href="admin_registration.php">Sign up</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer">
        <div class="container" id="about">
            <div class="row">
                <div class="col-lg-12 footer-main text-center py-5">
                    <h5 class="title">ABOUT</h5>
                    <p class="subtext">
                        Lorem ipsum dolor sit amet, consec
                        tetur adipisicing elit, sed do eiusmod tempor incididunt ultimam quantum
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!--JS, Popper.js, and jQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>





</body>

</html>