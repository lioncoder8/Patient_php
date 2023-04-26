<?php
$newpassword = $_POST['newpassword'];
$confirmpassword = $_POST['confirmpassword'];




if ($newpassword == $confirmpassword) {
  // save the password to MySQL database
} else {
  // display an error message
}


// connect to MySQL database
$servername = "localhost";
$username = "u968651013_test";
$password = "#8iPa;ZTAioS";
$dbname = "u968651013_test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// escape special characters to prevent SQL injection
$newpassword = mysqli_real_escape_string($conn, $newpassword);

// save the password to MySQL database
$sql = "INSERT INTO patient (ppassword) VALUES ('$newpassword')";

if (mysqli_query($conn, $sql)) {
    echo "Password saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close the connection
mysqli_close($conn);


?>