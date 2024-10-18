<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'student_db1';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect personal info
    $name1 = $_POST['name1'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    // Check if user_id exists in personal_info table
    $sql_check_personal = "SELECT * FROM personal_info WHERE user_id = $user_id";
    $result_personal = $conn->query($sql_check_personal);

    if ($result_personal->num_rows > 0) {
        // Update existing personal info
        $sql_personal = "UPDATE personal_info SET name1='$name1', dob='$dob', gender='$gender', mobile='$mobile', email='$email' WHERE user_id=$user_id";
    } else {
        // Insert new personal info
        $sql_personal = "INSERT INTO personal_info (user_id, name1, dob, gender, mobile, email) VALUES ('$user_id', '$name1', '$dob', '$gender', '$mobile', '$email')";
    }
    $conn->query($sql_personal);

    // Collect educational info
    $branch = $_POST['branch'];
    $grad_year = $_POST['grad_year'];
    $cgpa = $_POST['cgpa'];

    // Check if user_id exists in educational_info table
    $sql_check_educational = "SELECT * FROM educational_info WHERE user_id = $user_id";
    $result_educational = $conn->query($sql_check_educational);

    if ($result_educational->num_rows > 0) {
        // Update existing educational info
        $sql_educational = "UPDATE educational_info SET branch='$branch', grad_year='$grad_year', cgpa='$cgpa' WHERE user_id=$user_id";
    } else {
        // Insert new educational info
        $sql_educational = "INSERT INTO educational_info (user_id, branch, grad_year, cgpa) VALUES ('$user_id', '$branch', '$grad_year', '$cgpa')";
    }
    $conn->query($sql_educational);

    // // Update user's first login status
    // $sql_update = "UPDATE users SET is_first_login = 0 WHERE id = $user_id";
    // $conn->query($sql_update);

    // Redirect to career form
    header("Location: career_form.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Personal & Educational Info</title>
    <link rel="stylesheet" href="personal_info.css">
</head>
<body>
    <div class="dashboard">
        <div class="box-container">
            <!-- Combined Form for Personal and Educational Info -->
            <div class="box personal-education">
                <h2>Personal & Educational Information</h2>
                <form method="POST" action="">
                    <!-- Personal Info -->
                    <h3>Personal Information</h3>
                    <label for="name1">Name:</label>
                    <input type="text" id="name1" name="name1" placeholder="Enter your name" required>

                    <label for="dob">Date of Birth:</label>
                    <input type="date" id="dob" name="dob" required>

                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="" disabled selected>Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    <label for="mobile">Mobile:</label>
                    <input type="tel" id="mobile" name="mobile" placeholder="Enter your mobile number" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>

                    <!-- Educational Info -->
                    <h3>Educational Information</h3>
                    <label for="branch">Branch:</label>
                    <input type="text" id="branch" name="branch" placeholder="Enter your branch" required>

                    <label for="grad_year">Graduation Year:</label>
                    <input type="number" id="grad_year" name="grad_year" placeholder="Enter graduation year" required>

                    <label for="cgpa">CGPA:</label>
                    <input type="text" id="cgpa" name="cgpa" placeholder="Enter your CGPA" required>

                    <button type="submit">Next</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
