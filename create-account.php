<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Create Account</title>
    <style>
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body>
<?php

//learn from w3schools.com
//Unset all the server side variables

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


//import database
include("connection.php");





if($_POST){

    $result= $database->query("select * from webuser");

    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $address=$_SESSION['personal']['address'];
    $dob=$_SESSION['personal']['dob'];
    $email=$_POST['newemail'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    
    if ($newpassword==$cpassword){
        $result= $database->query("select * from webuser where email='$email';");
        if($result->num_rows==1){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{
            
            $database->query("insert into patient(pemail,pname,ppassword,paddress,pdob,ptel) values('$email','$name','$newpassword','$address','$dob','$tele');");
            $database->query("insert into webuser values('$email','p')");

            //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nic','$dob','$tele');");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: patient/index.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Confirmation Error! Reconfirm Password</label>';
    }



    
}else{
    //header('location: signup.php');
    $error='<label for="promter" class="form-label"></label>';
}

?>


    <center>
    <div class="container">
        <table border="0" style="width: 69%;">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">Now Create User Account.</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="newemail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                </td>
                
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="tele" class="form-label">Mobile Number: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                <!-- <input type="tel" name="tele" class="input-text" placeholder="ex:+639123456789" pattern="\+63\d{910}" value="+63" required> -->
                <input type="tel" name="tele" class="input-text" placeholder="ex: 09123456789" value="+63" pattern="+63\d{10}" required>

                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="newpassword" class="form-label">Create New Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                <input type="password" name="newpassword" id="newpassword" class="input-text" placeholder="New Password" required>
                <div class = "hint_text">Password must contain at least one uppercase letter, one digit and one special character.</div>
                <span id="password-strength"></span>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="cpassword" class="form-label">Confirm Password: </label>
                    
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                <label for="newpassword"></label>
                <input type="password" name="cpassword" id="cpassword" class="input-text" placeholder="Confirm Password" required>
                <!-- <div class = "hint_text">Password must contain aleast 1 number 1 special character and 1 Uppercase Letter</div> -->
                <span id="password-match"></span>
                </td>
            </tr>
     
            <tr>
                
                <td colspan="2">
                    <?php echo $error ?>

                </td>
            </tr>
            
            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>

                    </form>
            </tr>
        </table>

    </div>
</center>
<script>
    // Get the password input fields
    var newPassword = document.getElementById("newpassword");
    var confirmPassword = document.getElementById("cpassword");

    // Every time the user types in the password fields, check the password strength and match, and display a message
    newPassword.addEventListener("input", checkPasswords);
    confirmPassword.addEventListener("input", checkPasswords);

    function checkPasswords() {
        var passwordStrength = checkPasswordStrength(newPassword.value);
        var messageStrength = "";

        switch(passwordStrength) {
            case "strong":
                messageStrength = "Password is strong";
                break;
            case "medium":
                messageStrength = "Password is medium";
                break;
            case "weak":
                messageStrength = "Password is too weak";
                break;
            default:
                messageStrength = "";
                break;
        }

        // Update the message in the password-strength span
        var passwordStrengthSpan = document.getElementById("password-strength");
        passwordStrengthSpan.innerHTML = messageStrength;

        // Check if the passwords match and display a message
        var messageMatch = "";
        if (newPassword.value !== confirmPassword.value) {
            messageMatch = "Passwords do not match";
        }

        // Update the message in the password-match span
        var passwordMatchSpan = document.getElementById("password-match");
        passwordMatchSpan.innerHTML = messageMatch;
    }

    // Function to check the strength of the password
    function checkPasswordStrength(password) {
        if (password.length >= 8 && /\d/.test(password) && /[a-z]/.test(password) && /[A-Z]/.test(password) && /\W/.test(password)) {
            return "strong";
        } else if (password.length >= 6 && /\d/.test(password) && /[a-z]/.test(password)) {
            return "medium";
        } else {
            return "weak";
        }
    }
</script>

</body>
</html>