<?php

$conn = new mysqli("localhost", "root", "", "vocabapp");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];



$sql = "SELECT * FROM users WHERE username=? OR email=?"; // SQL with parameters
$stmt = $conn->prepare($sql); 
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$row = $result->fetch_assoc(); // fetch data   

if (mysqli_num_rows($result) !== 0) { //If username is taken
    header("location:../signup.php?error=usernameTaken&mail=".$email);
    exit();
    
} else {
    $sql = "SELECT * FROM users WHERE username=? OR email=?"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc(); // fetch data

    if (mysqli_num_rows($result) !== 0) { //If email is taken
        header("location:../signup.php?error=emailTaken&uid=".$username);
        exit();
    } else if ( empty($username) || empty($email) || empty($password) ){ //Empty Fields
        header("location:../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
        exit();
    } else if ($confirmPassword !== $password){ //Password not match
        header("location:../signup.php?error=passwordNotMatch&uid=".$username."&mail=".$email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ //invalid Email
        header("location:../signup.php?error=invalidEmail&uid=".$username);
        exit();
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { //Username contains funky characters
        header("Location: ../signup.php?error=invaliduid&mail=".$email);
        exit();
    } else if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password)){ //Password requirements: 8 characters, at least 1 uppercase, lowercase and number
        header("Location: ../signup.php?error=invalidpwd&uid=".$username."&mail=".$email);
        exit();
    } else { //Check if username is too similar to password (they have 4 consecutive identical characters)
        $repeatCount = 0;
        $stringLength = strlen($password) - 3;
        while ($repeatCount < ($stringLength)) { //If username has 8 characters, it needs to loop 8-3 = 5 times
            $fourCharsGroup = substr($password, $repeatCount, 4);
            
            if (strpos($username, $fourCharsGroup) !== false){      //Username is similar to password
                header("Location: ../signup.php?error=uidSimilar&uid=".$username."&mail=".$email);
                exit();
            } else if (strpos($email, $fourCharsGroup) !== false) { //Password is similar to password
                header("Location: ../signup.php?error=emailSimilar&uid=".$username."&mail=".$email);
                exit();
            } else {
                $repeatCount = $repeatCount + 1;
            }
        }

    }
}


$hashpassword = password_hash($password, PASSWORD_BCRYPT);

    /* Prepared statement, stage 1: prepare */
    
if (!($stmt = $conn->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)"))) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}


if (!$stmt->bind_param("sss", $username, $email, $hashpassword)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
$password = "";
$hashPassword = "";

$stmt->close();


header("location:../index.php");
exit();