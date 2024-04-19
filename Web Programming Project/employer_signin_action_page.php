<?php
// Start the session
session_start();

// Check if the user is already logged in, if yes then redirect him to home page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM employers WHERE email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if email exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $email, $hashed_password);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect user to [insert home page here]
                            header("location: home.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
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
            <h1>Sign in as employer</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="employer_sign_in">
                <label for="email">Email address</label><br>
                <input type="text" id="email" name="email"><br>
                <span class="help-block"><?php echo $email_err; ?></span>
                <br>
                <br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password">
                <span><a href="#passrecover">Forgot password?</a></span>
                <span class="help-block"><?php echo $password_err; ?></span>
                <br>
            </form>
            <button type="submit" form="employer_sign_in" value="EmpSignIn">Sign In</button><br>
            <p>Don't have an account? <a href="internship_website_employer_signup.html">Sign Up</a></p>
        </div>
    </body>
</html>