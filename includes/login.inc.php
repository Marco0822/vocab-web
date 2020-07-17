<?php

$conn = new mysqli("localhost", "root", "", "vocabapp");
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

$usernameOrEmail = $_POST['username-email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username=?"; // SQL with parameters
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $usernameOrEmail);
$stmt->execute();
$result = $stmt->get_result(); // get the mysqli result
$row = $result->fetch_assoc(); // fetch data   

if (mysqli_num_rows($result) == 0) { //If the user is probably using their email
    $sql = "SELECT * FROM users WHERE email=?"; // SQL with parameters
    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $row = $result->fetch_assoc(); // fetch data   

    if (mysqli_num_rows($result) == 0) { //If username AND password isn't in the database
        header("location:../index.php?error=notexist"); 
        exit();
    } else { // If user using email and does exist
        if (password_verify($password, $row['password'])) { //Password matches
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("location:../home.php"); 
            exit();
        } else { //Password doesn't match
            echo "password doesn't match";
        }
    }
    
} else { //If user using username and does exist
    if (password_verify($password, $row['password'])) { //Password matches
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        header("location:../home.php"); 
        exit();
    } else { //Password doesn't match
        header("location:../index.php?error=invalidUidPwd"); 
        exit();
    }
}