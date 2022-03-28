<!-- Author: Victor Davidescu | SID: 1705734 -->
<?php

    /*
        This function checks if the credentials received are valid.
        It retreives the hashed password from the specific email and
        verifies if it matches with the peppered password.
        Outputs: True or False
    */
    function CheckCredentials($database, $email, $pass) {

        // Add some pepper one the password and empy the password variable
        $pepper = get_cfg_var("pepper");
        $passPeppered = hash_hmac("sha256", $pass, $pepper);
        $pass = NULL;
        
        // Retreive the hashed password from the specific account
        $sqlQuery = "SELECT password FROM accounts WHERE email = '$email'";
        $result = mysqli_query($database, $sqlQuery);

        // Check if the result has one row (if the account with the email was found)
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_row($result);
            $passHashed = $row[0];

            // Check if the peppered password matches the hashed password from database
            if(password_verify($passPeppered, $passHashed)) { return true; } else { return false; }   

        } else { return false; }
    }


    /*
        This function is used to check if the email and password provided 
        already exists in the database
        Outputs: True or False
    */
    function FetchRoleID($database, $email) {
        $sqlQuery = "SELECT role_id FROM accounts WHERE email = '$email'";
        $result = mysqli_query($database, $sqlQuery);
        $row = mysqli_fetch_row($result);
        return $row[0];
    }
?>