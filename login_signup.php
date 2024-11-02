<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['first_name'])) {
        // Signup processing
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $studentId = $_POST['student_id'];
        $phoneNumber = $_POST['phone_number'];
        $email = $_POST['email'];
        $campus = $_POST['campus'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (first_name, last_name, student_id, phone_number, email, campus, password) 
                VALUES ('$firstName', '$lastName', '$studentId', '$phoneNumber', '$email', '$campus', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Signup successful! Please log in.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['login_email'])) {
        // Login processing
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                header("Location: index.html");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "No account found with that email.";
        }
    }
}

$conn->close();
