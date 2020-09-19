<?php

require_once "functions.php";
if (isset($_SESSION['email'], $_SESSION['password'])) {

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
            <nav class="navbar navbar-expand-lg navbar-dark navbar-dash">
                <span class="navbar-text mr-3">
                    <h5>Welcome,
                        <?php

                        echo "<a href='admin_dashboard.php'>" . $_SESSION['email'] . "</a>!";
                        ?>
                    </h5>
                </span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                        </li>
                        <li class="nav-item">
                        </li>
                        <li class="nav-item">
                        </li>
                    </ul>
                    <form class="form-inline">
                        <input class="form-control mr-sm-5" type="text" id="filterSearch" placeholder="Filter Search" aria-label="Search Student">
                        <!-- <button class="btn btn-success my-2 my-sm-0 mr-5 disabled" type="submit">Search</button> -->
                    </form>
                    <span class="navbar-text mr-3">
                        <a href="admin_dashboard.php?admin_logout='1'">
                            <h5>Log out</h5></span></a>
                    </span>
                </div>
            </nav>
        </header>

        <section id="studentRecords">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 my-5">
                        <div class="card">
                            <div class="card-body justify-content-center text-center">
                                <h4 class="card-title text-center py-3">Student Records </h4>

                                <?php
                                    if (isset($_SESSION['message'])) { //for errors from outside sessions
                                        ?>

                                            <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> mt-2 mb-3 py-1">
                                                <?php
                                                echo $_SESSION['message'];
                                                unset($_SESSION['message']);
                                                ?>
                                                <button type="button" class="close pl-2" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                <?php
                                    }             
                                ?>
                               
                                <?php
                                $mysqli = new mysqli('localhost', 'root', '', 'studentinfosys') or die($mysqli_error($mysqli));
                                $result = $mysqli->query("SELECT * FROM student") or die($mysqli->error);

                                if (empty(mysqli_num_rows($result))) {
                                    $_SESSION['message'] = "No records found";
                                    $_SESSION['msg_type'] = "danger";


                                    if (isset($_SESSION['message'])) {
                                    ?>

                                        <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> mt-2 mb-3 py-1">
                                            <?php
                                            echo $_SESSION['message'];
                                            unset($_SESSION['message']);
                                            ?>
                                            <button type="button" class="close pl-2" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                <?php 
                                    }
                                }
                                ?>

                                <table class="table table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th>Student No.</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Age</th>
                                            <th>Email Address</th>
                                            <th>Course</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>

                                    <?php

                                    if (!empty(mysqli_num_rows($result))) {

                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tbody id="studentTable">
                                                <tr>
                                                    <td><?php echo $row['student_id']; ?></td>
                                                    <td><?php echo $row['fname']; ?></td>
                                                    <td><?php echo $row['lname']; ?></td>
                                                    <td><?php echo $row['age']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['course']; ?></td>
                                                    <td>
                                                        <a href="admin_student_profile_edit.php?edit=<?php echo $row['student_id']; ?>" class="btn btn-info">Edit</a>
                                                        <a href="functions.php?delete=<?php echo $row['student_id']; ?>" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                    <?php
                                        }
                                   
                                    }
                                    else {
                                        $_SESSION['message'] = "An error has occured";
                                        $_SESSION['msg_type'] = "danger";
                                    }
                                    ?>
                                </table>

                                <?php

                                function pre_r($array)
                                {
                                    echo '<pre>';
                                    print_r($array);
                                    echo '</pre>';
                                }
                                ?>

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
        <script src="assets/js/filter.js"></script>
    </body>

    </html>


<?php
}
?>