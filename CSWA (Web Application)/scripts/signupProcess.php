<!-- Author: Victor Davidescu | SID: 1705734 -->
<?php

    /*
        This function is used to insert the new user in the database.
        Outputs: True or False
    */
    function InsertUserInDB($database, $fname, $lname, $email, $hash) {   

        $sqlQuery = "INSERT into accounts (first_name, last_name, email, password, role_id) 
            VALUES ('$fname', '$lname', '$email', '$hash', 3)";
        $result = mysqli_query($database, $sqlQuery);
        if($result) { return true; } else { return false; }    
    }


    /*
        This function is used to check if the email provided
        already exists in the database.
        Outputs: True or False
    */
    function CheckIfEmailAlreadyExists($database, $email) {

        $sqlQuery = "SELECT id FROM accounts WHERE email = '$email'";
        $result = mysqli_query($database, $sqlQuery);
        $count = mysqli_num_rows($result);
        if($count == 0) { return true; } else { return false; }
    }


    /*
        This function is used to test the password strength.
        The verifying method used in this function was inspider from Codex World solution (Codex World, 2022).
        Outputs: True or False

        Reference:
        Codex World, 2022. How to Validate Password Strength in PHP. [online] 
            Available at:<https://www.codexworld.com/how-to/validate-password-strength-in-php/> [Accessed 21 February 2022].
    */
    function PasswordStrengthValidator($pass) {
        $upperCaseMatch = preg_match('@[A-Z]@', $pass);
        $lowerCaseMatch = preg_match('@[a-z]@', $pass);
        $numberMatch = preg_match('@[0-9]@', $pass);
        if(!$upperCaseMatch || !$lowerCaseMatch || !$numberMatch || strlen($pass) < 8) { return false; } else { return true; }  
    }


    /*
        This function ecnrypts the password usig mixing secret input (pepper) then
        it hashes.
        Returns the hashed password
    */
    function HashPassword($pass) {
        $pepper = get_cfg_var("pepper");
        $passPeppered = hash_hmac("sha256", $pass, $pepper);
        $passHashed = password_hash($passPeppered, PASSWORD_DEFAULT);
        return $passHashed;
    }


    /*
        This is the main function for the singup process.
    */
    function SignupMainProcess($database, $fname, $lname, $email, $pass, $cpass) {

        //Check if users already exists
        if(CheckIfEmailAlreadyExists($database, $email)) {

            //Check if passwords match
            if($pass == $cpass) {
                $cpass = NULL;

                 //Check if passwords has the minimum strength
                if(PasswordStrengthValidator($pass)) {
                    $hash = HashPassword($pass);
                    $pass = NULL;

                    //Insert the new user in the database
                    if(InsertUserInDB($database, $fname, $lname, $email, $hash)) {
                        $error = NULL;

                    } else { $error = "Failed to insert record in database."; }
                } else { 
                    $error = "Password failed the strength test!<br>It requires to have at least:<br>
                    - 8 characters<br>- One upper case character<br>- One lower case character<br>- One number"; }
            } else { $error = "The passwords don't match."; }
        } else { $error = "Email already in use."; }
        return $error;
    }
?>