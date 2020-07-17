<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Website 3.0</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500;700&display=swap" rel="stylesheet">
</head>
<body>



    <div class="nav-div">
        <h1>Anti-Forgetter</h1>
        <div class="btn-div">
            <form action="index.php" class="log-in-btn-form">
                <button class="log-in-btn-index">Log In</button>
            </form>
            <form action="signup.php" class="log-in-btn-form">
                <button class="sign-up-btn-index">Sign Up</button>
            </form>
        </div>
    </div>

    <div class="main-div">

        <?php
            if(isset($_GET['error'])) { 
                $errorMessage = $_GET['error'];
                if ($errorMessage=='invalidEmail'){ //Invalid Email
                        $errorMessage="Your email is invalid!";
                } else if ($errorMessage=='usernameTaken'){ //Username Taken
                    $errorMessage="The Username is taken!";
                } else if ($errorMessage=='emailTaken'){ //Email Taken
                    $errorMessage="The email is taken!";
                } else if ($errorMessage=='passwordNotMatch'){ // Passwords don't match
                    $errorMessage="Password don't match!";
                } else if ($errorMessage=='invaliduid'){ //Username Taken
                    $errorMessage="Username can only contain A-Z, a-z, or 0-9!";
                } else if ($errorMessage=='emptyfields'){ //Username Taken
                    $errorMessage="Some fields are empty!";
                } else if ($errorMessage=='invalidpwd'){ //Password requirements: 8 characters, at least 1 uppercase, lowercase and number
                    $errorMessage="Password must contain 8 characters, at least 1 uppercase, lowercase and number!";
                } else if ($errorMessage=='uidSimilar'){ //Password requirements: 8 characters, at least 1 uppercase, lowercase and number
                    $errorMessage="Username and Password too similar (cannot have 4 consecutive characters that are identical)";
                } else if ($errorMessage=='pwdSimilar'){ //Password requirements: 8 characters, at least 1 uppercase, lowercase and number
                    $errorMessage="Email and Password too similar (cannot have 4 consecutive characters that are identical)";
                }
            } else {
                $errorMessage = "";
            }
        ?>

        <div class="errorMessage">
            <h3><?php echo $errorMessage;?></h1>
        </div>
        
        <form action="includes/signup.inc.php" method="post" class="form-div">
            <div class="row">
                <div class="label"><h1>Username:</h1></div>
                
            <?php
                $usernameAgain="";
                if(isset($_GET['uid'])){
                    $usernameAgain=$_GET['uid'];
                }
                echo '<div class="inputs"><input class="input-class" type="text" name="username" placeholder="Type your username here" value="'.$usernameAgain.'"></div>';
            ?>
            </div>
            <div class="row">
                <div class="label"><h1>Email:</h1></div>

            <?php
                $emailAgain="";
                if(isset($_GET['mail'])){
                    $emailAgain=$_GET['mail'];
                }
                echo '<div class="inputs"><input class="input-class" type="text" name="email" placeholder="Type your email here" value="'.$emailAgain.'"></div>';
            ?>
                
            </div>
            <div class="row">
                <div class="label"><h1>Password:</h1></div>
                <div class="inputs"><input class="input-class" type="password" name="password" placeholder="Type your password here"></div>
            </div>
            <div class="row">
                <div class="label"><h1>Confirm Password:</h1></div>
                <div class="inputs"><input class="input-class" type="password" name="confirm_password" placeholder="Confirm your password"></div>
            </div>
            <div class="row">
                <button type="submit" class="sign-up-btn2">SIGN UP</button>
            </div>
        </form>
        
    </div>
    
</body>
</html>