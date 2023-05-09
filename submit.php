<?php
//connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpform";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//get form data from ajax request
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$location = $_POST['location'];
$age = $_POST['age'];
$university = $_POST['university'];

//prepare statement
$stmt = mysqli_prepare($conn, "INSERT INTO form_data (name, phone, email, location, age, university) VALUES (?, ?, ?, ?, ?, ?)");

mysqli_stmt_bind_param($stmt, "ssssis", $name, $phone, $email, $location, $age, $university);

//execute statement
if (mysqli_stmt_execute($stmt)) {
    // form data has been submitted successfully
    $message = 'Thank you for filling the form ' . $name . '.';
} else {
    $message = 'Error: ' . $stmt->error;
}

//close statement
mysqli_stmt_close($stmt);

mysqli_close($conn);

// output success page
?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Submission</title>
</head>

<body>
    <h1>Form Submission</h1>
    <p><?php echo $message; ?></p>
</body>

</html>