<!-- Author: Victor Davidescu | SID: 1705734 -->
<!DOCTYPE html>
<html lang="en">

    <?php   
        include("scripts/database.php");
        include("scripts/signupProcess.php");
        include("scripts/pathToPages.php");
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            //mysqli_real_escape_string function used to avoid SQL injection mitigation
            $fname = mysqli_real_escape_string($database,$_POST['fname']);
            $lname = mysqli_real_escape_string($database,$_POST['lname']);
            $email = mysqli_real_escape_string($database,$_POST['email']);
            $pass = mysqli_real_escape_string($database,$_POST['pass']);
            $cpass = mysqli_real_escape_string($database,$_POST['cpass']);
            $result = SignupMainProcess($database, $fname, $lname, $email, $pass, $cpass);
            $pass = NULL; $cpass = NULL; // Cryptographic Failures Mitigation - Remove useless sensitive data
            
            if($result == NULL) {
                $_SESSION['email'] = $email;
                $_SESSION['role_id'] = 3; 
                header("location:".HOME_PAGE);
            } else { $error = $result; }
        }
    ?>

    <head>
        <title>Sign-up - Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
    </head>

    <body>    
        <div class="wrapper">
   
            <!-- Header / Navigation bar -->
            <header class="p-3 text-white" style="background-color:#071d49;">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                            <img style="width:80px; height:80px;" src="img/aru_logo.png" alt="ARU Logo">
                        </a>
                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0"></ul>
                        <div class="text-end">
                            <button type="button" onclick="location.href='<?php echo LOGIN_PAGE;?>'; return false;" class="btn btn-outline-light me-2">Login</button>
                            <button type="button" onclick="location.href='<?php echo SIGNUP_PAGE;?>'; return false;" class="btn btn-warning">Sign-up</button>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Content / Sign In/Log In page -->
            <main class="form-signin">
                <form method = "post">
                    <h1 class="h3 mb-3 fw-bold">Please sign-up</h1>

                    <?php if(isset($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error;?>
                        </div>
                    <?php endif; ?>

                    <h3 class="h6"> Enter your first name</h3>
                    <div class="form-floating">
                        <input type="text" name = "fname" class="form-control" id="floatingFname" placeholder="" required="required">
                        <label for="floatingFname">First Name</label>
                    </div>
                    <br>
                    <h3 class="h6"> Enter your last name</h3>
                    <div class="form-floating">
                        <input type="text" name = "lname" class="form-control" id="floatingLname" placeholder="" required="required">
                        <label for="floatingLname">Last Name</label>
                    </div>
                    <br>
                    <h3 class="h6"> Enter an email</h3>
                    <div class="form-floating">
                        <input type="email" name = "email" class="form-control" id="floatingInput" placeholder="" required="required">
                        <label for="floatingInput">Email address</label>
                    </div>    
                    <br>
                    <h3 class="h6"> Enter a password</h3>
                    <div class="form-floating">
                        <input type="password" name="pass" class="form-control" id="floatingPassword" placeholder="" required="required">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="cpass" class="form-control" id="floatingCpassword" placeholder="" required="required">
                        <label for="floatingCpassword">Confirm Password</label>
                    </div><br>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign-up</button><br>
                </form>        
            </main>

            <!-- Footer displaying author -->
            <footer class="bg-light text-center text-lg-start">
                <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                    Web Application Security - SID: 1705734
                </div>
            </footer>

        </div>
        <script src="js/bootstrap.js"></script>
    </body>
</html>
