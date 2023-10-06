<html>
<body>
 <?php
    if(isset($_POST['UID'])&& isset($_POST['number']) && isset($_POST['email'])  && isset($_POST['country']) && isset($_POST['state']) && isset($_POST['c_name']) && isset($_POST['h_num']) && isset($_POST['district']) && isset($_POST['p_code']) && isset($_POST['password'])){
        // Database connection details
        $hostname = 'localhost';  // e.g., 'localhost'
        $username = 'root';  // Your database username
        $password = '';  // Your database password
        $database = 'homeservice';  // Your database name


            echo("working");
            echo("<br>");
            // Create a database connection
            $conn = mysqli_connect($hostname, $username, $password, $database);

       // Check the connection
       if (!$conn) {
             die("Connection failed: " . mysqli_connect_error());
         }
    echo("working");
    echo("<br>");
    // Check if the registration form is submitted
    $name = $_POST['UID'];
    $contact =$_POST['number'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $country =$_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['c_name'];
    $dist = $_POST['district'];
    $pin = $_POST['p_code'];
    $houseNo =$_POST['h_num'];

    // Begin a transaction to ensure data consistency
    mysqli_autocommit($conn, false);
    $success = true;

    // Insert the address data into the "address" table
    $addressQuery = "INSERT INTO addresss (country, add_state, city, dist, pin, house_no) VALUES ('$country', '$state', '$city', '$dist', '$pin', '$houseNo')";
    if (!mysqli_query($conn, $addressQuery)) {
        $success = false;
    }

    // Get the auto-generated address ID
    $addressId = mysqli_insert_id($conn);

    // Insert the customer data into the "customer" table with the address ID as a foreign key
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $customerQuery = "INSERT INTO customer (c_password, c_name, contact_no, email_id, add_id) VALUES ('$hashedPassword', '$name', '$contact', '$email', '$addressId')";
    if (!mysqli_query($conn, $customerQuery)) {
        $success = false;
    }

    // Commit or rollback the transaction based on success
    if ($success) {
        mysqli_commit($conn);
        echo "Registration successful!";
    } else {
        mysqli_rollback($conn);
        echo "Registration failed. Please try again.";
    }

    // Close the database connection
    mysqli_close($conn);

    }

 ?>   
</body>
</html>
<?php

?>
