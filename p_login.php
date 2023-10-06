<html>
<body>
<?php
if(isset($_POST['UID']) && isset($_POST['password']))
{
// for sign-in section
// Database connection details
$hostname = 'localhost';  // e.g., 'localhost'
$username = 'root';  // Your database username
$password = '';  // Your database password
$database = 'homeservice';  // Your database name


// Check if the form for login is submitted

   
    $conn = mysqli_connect($hostname, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user_email =$_POST['UID'];
$user_password =$_POST['password'];

// Prepare the SQL query to fetch data based on the provided email
$sql = "SELECT c_password FROM sprovider WHERE email_id = '$user_email' LIMIT 1";
$validUser = false;
// Execute the query
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if a matching row is found
if (mysqli_num_rows($result) === 1) {
    // Fetch the hashed password from the result
    $row = mysqli_fetch_assoc($result);
    $hashed_password = $row['c_password'];
   
    // Verify the provided password against the hashed password
    if (password_verify( $user_password , $hashed_password)) {
        
        echo "Login successful!"; // Password is correct
        // You can redirect or set session variables here
    } else {
        echo "Login failed. Check your credentials."; // Password is incorrect
    }
} else {
    echo "Email not found. Please register."; // Email not found in the database
}


mysqli_close($conn);

}

?>
   
</body>
</html>