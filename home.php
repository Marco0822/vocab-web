<?php

    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1><?php if (isset($_SESSION['username'])) {
    echo $_SESSION['username']."<br>"; 
    echo $_SESSION['email'];
} else {
    echo "session has not been set";
}

?></h1>
    
</body>
</html>