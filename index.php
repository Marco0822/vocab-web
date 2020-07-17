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
                if ($errorMessage=='invalidUidPwd'){ //Invalid Email
                        $errorMessage="Your username or password is incorrect!";
                } 
            } else {
                $errorMessage = "";
            }
        ?>


        <div class="errorMessage">
            <h3><?php echo $errorMessage;?></h1>
        </div>

        <form action="includes/login.inc.php" method="post" class="form-div">
            <div class="row">
                <div class="label"><h1>Username/Email:</h1></div>
                <div class="inputs"><input class="input-class" type="text" name="username-email" placeholder="Type your username here "></div>
            </div>
            <div class="row">
                <div class="label"><h1>Password:</h1></div>
                <div class="inputs"><input class="input-class" type="password" name="password" placeholder="Type your password here"></div>
            </div>
            <div class="row">
                <button class="sign-up-btn2">LOG IN</button>
            </div>
           
        </form>
        
    </div>
    
</body>
</html>