<?php
// Start the session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST["companyname"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["passconfirm"]) && !empty($_POST["companytype"]) && !empty($_POST["address"]) && isset($_POST["employeeno"])) {
        // Retrieve form data
        $companyname = $_POST["companyname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passconfirm = $_POST["passconfirm"];
        $companytype = $_POST["companytype"];
        $address = $_POST["address"];
        $employeeno = $_POST["employeeno"];

        // Perform any necessary validation here
        
        // Dummy output for demonstration
        echo "Company Name: $companyname<br>";
        echo "Email: $email<br>";
        echo "Password: $password<br>";
        echo "Confirmed Password: $passconfirm<br>";
        echo "Company Type: $companytype<br>";
        echo "Address: $address<br>";
        echo "Number of Employees: $employeeno<br>";
    } else {
        // Handle empty fields
        echo "Please fill out all the fields.";
    }
}
?>