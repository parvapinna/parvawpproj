<?php
// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST["firstname"]) && !empty($_POST["middlename"]) && !empty($_POST["surname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["passconfirm"]) && !empty($_POST["dob"])) {
        // Retrieve form data
        $firstname = $_POST["firstname"];
        $middlename = $_POST["middlename"];
        $surname = $_POST["surname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passconfirm = $_POST["passconfirm"];
        $dob = $_POST["dob"];

        // Perform any necessary validation here
        
        // Dummy output for demonstration
        echo "First Name: $firstname<br>";
        echo "Middle Name: $middlename<br>";
        echo "Surname: $surname<br>";
        echo "Email: $email<br>";
        echo "Password: $password<br>";
        echo "Confirmed Password: $passconfirm<br>";
        echo "Date of Birth: $dob<br>";
    } else {
        // Handle empty fields
        echo "Please fill out all the fields.";
    }
}
?>