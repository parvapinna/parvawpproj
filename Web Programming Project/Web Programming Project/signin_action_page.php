<?php
// Start the session
session_start();

// Check if the user is already logged in, if yes then redirect him to home page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both email and password are provided
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        // Dummy email and password for demonstration
        $dummy_email = "user@example.com";
        $dummy_password = "password";

        // Check if provided email and password match the dummy data
        if ($_POST["email"] === $dummy_email && $_POST["password"] === $dummy_password) {
            // Authentication successful, start a new session
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $dummy_email;

            // Redirect user to home page
            header("location: home.php");
            exit;
        } else {
            // Invalid credentials
            $error_message = "Invalid email or password.";
        }
    } else {
        // Email or password is not provided
        $error_message = "Please provide both email and password.";
    }
}
?>

<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Inter" rel="stylesheet">
        <style>
            .body {
                font-family: 'Inter';
            }

            .topnav {
                background-color: rgba(255, 95, 0, 0.7);
                overflow: hidden;
            }
            
            .logo-image {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                overflow: hidden;
                margin-top: -6px;
            }

            .topnav a {
                float: left;
                color: #ffffff;
                text-align: center;
                padding: 24px 16px 10px;
                text-decoration: none;
                font-weight: bold;
                font-size: 14px;
            }

            .topnav-right {
                float: right;
                padding-right: 10px;
            }

            .topnav-right a {
                padding: 24px 4px 10px;
            }

            .form-box {
                border-style: solid;
                border-width: 3px;
                border-color: #D9D9D9;
                border-radius: 3px;
                margin: 75px 100px;
            }

            .form-box h1 {
                font-size: 24;
                font-weight: bold;
                text-align: center;
            }

            .form-box form {
                font-size: 12;
                font-weight: bold;
                padding-left: 70px;
                padding-right: 70px;
            }

            .form-box input {
                border-style: solid;
                border-width: 2px;
                border-color: #D9D9D9;
                border-radius: 3px;
                width: 100%;
            }

            .form-box form a {
                color: black;
                float: right;
                text-decoration: none;
            }

            .form-box button {
                background-color: #FF5F00;
                border: none;
                color: white;
                margin-top: 32px;
                margin-left: calc(50% - 60px);
                height: 24px;
                width: 120px;
                border-radius: 3px;
                text-align: center;
                text-decoration: none;
                font-weight: bold;
                font-size: 12px;
            }

            .form-box p {
                padding-top: 10px;
                padding-left: 70px;
                font-size: 14;
                font-weight: bold;
            }

            .form-box a {
                color: #FF5F00;
                text-decoration: none;
            }
        </style>
    </head>

    <body>
    <div class="topnav">
            <a class="topnav" href="/">
                <div class="logo-image">
                      <img src="image" class="img-fluid">
                </div>
            </a>
            <a class="active" href="#home">Home</a>
            <a href="#companies">Companies</a>
            <a href="#findjobs">Find Jobs</a>
            <div class="topnav-right">
                <a href="internship_website_signin.html">Sign In</a>
                <a href=""> | </a>
                <a href="internship_website_employer_signin.html">Employers</a>
              </div>
        </div>
        
        <div class="form-box">
            <h1>Sign in</h1>
            <?php
            // Display error message if exists
            if (isset($error_message)) {
                echo '<p style="color: red;">' . $error_message . '</p>';
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="sign_in">
                <label for="email">Email address</label><br>
                <input type="text" id="email" name="email"><br>
                <br>
                <br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password">
                <span><a href="#passrecover">Forgot password?</a></span>
                <br>
                <button type="submit" form="sign_in" value="SignIn">Sign In</button><br>
            </form>
            <p>Don't have an account? <a href="internship_website_signup.html">Sign Up</a></p>
        </div>
    </body>
</html>