<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'student_db1';

// Database connection
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];

            // Check if the user has filled the career assessment form
            if ($user['career_assessment_filled'] == 0) {
                // Redirect to career assessment form
                header("Location:dashboard1.html");
                exit();
            } else {
                // Redirect to the dashboard if form is already filled
                header("Location: user_dashboard.php");
                exit();
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "No user found with this email.";
    }
}

$conn->close();
?>
