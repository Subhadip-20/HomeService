<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'homeservice';
if(isset($_POST['UID'])&& isset($_POST['number']) &&isset($_POST['services']) && isset($_POST['email'])  && isset($_POST['country']) && isset($_POST['state']) && isset($_POST['c_name']) && isset($_POST['h_num']) && isset($_POST['district']) && isset($_POST['p_code']) && isset($_POST['password'])){
    
        // Create a connection to the database
        $conn = new mysqli($hostname, $username, $password, $database);

        // Check the connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
        }

        // Handle the form submission and capture data
        $p_name = $_POST['UID'];
        $contact_no = $_POST['number'];
        $email_id = $_POST['email'];
        $country = $_POST['country'];
        $add_state = $_POST['state'];
        $city = $_POST['c_name'];
        $dist = $_POST['district'];
        $pin = $_POST['p_code'];
        $h_num = $_POST['h_num'];
        $services = $_POST['services'];
        $p_password = $_POST['password'];

        // Hash the password
        $hashedPassword = password_hash($p_password, PASSWORD_DEFAULT);

        // Insert address data into the 'address' table
        $address_query = "INSERT INTO addresss (country, add_state, city, dist, pin, house_no) VALUES ('$country', '$add_state', '$city', '$dist', '$pin', '$h_num')";
        if ($conn->query($address_query) === TRUE) {
              $add_id = $conn->insert_id; // Get the auto-generated add_id
        } else {
              echo "Error inserting address: " . $conn->error;
        }

        // Assuming $services is the user's selected service
        $services_query = "SELECT s_id FROM services WHERE s_name = '$services'";
        $services_result = $conn->query($services_query);

        if ($services_result->num_rows > 0) {
        $row = $services_result->fetch_assoc();
        $s_id = $row['s_id'];
        } else {
          echo "Service not found in the 'services' table.";
        }   

// Insert data into the 'sprovider' table
$sprovider_query = "INSERT INTO sprovider (p_password, p_name, contact_no, email_id, add_id, s_id) VALUES ('$hashedPassword','$p_name', '$contact_no', '$email_id', '$add_id', '$s_id')";
if ($conn->query($sprovider_query) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error inserting sprovider: " . $conn->error;
}

// Close the database connection
$conn->close();
}
?>
