<?php
    $db = new mysqli("localhost","u968651013_test","#8iPa;ZTAioS","u968651013_test");
    if ($db->connect_error) die("Connection failed: " . $db->connect_error);

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $query = "SELECT * FROM patient WHERE pemail = '$email'";
        $result = mysqli_query($db, $query);
        
        if(mysqli_num_rows($result) == 1){
            // Generate a unique random token and update it in the database
            $token = md5(rand());
            $query = "UPDATE patient SET token='$token' WHERE pemail='$email'";
            mysqli_query($db, $query);
            
            // Send password reset email with a link containing the token
            $to = $email;
            $subject = 'Password Reset';
            $message = "Click on this link to reset your password: https://wecreatesmile.com/createpassword.php?token=$token";
            $headers = 'From: admin@wecreatesmile.com' . "\r\n" .
                'Reply-To: admin@wecreatesmile.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            
            // Display success message
            echo "<p>An email has been sent to your email address with instructions on how to reset your password.</p>";
        }else{
            echo "<p>Sorry, no user exists on our system with that email address.</p>";
        }
    }
?>

<form method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit" name="submit">Reset Password</button>
</form>
