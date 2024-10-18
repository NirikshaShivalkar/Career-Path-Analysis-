<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'student_db1';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$sql_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);
$user_data = $result_user->fetch_assoc();

// Fetch educational info
$sql_educational = "SELECT * FROM educational_info WHERE user_id = $user_id";
$result_educational = $conn->query($sql_educational);
$educational_data = $result_educational->fetch_assoc();

// Fetch personal info
$sql_personal = "SELECT * FROM personal_info WHERE user_id = $user_id";
$result_personal = $conn->query($sql_personal);
$personal_data = $result_personal->fetch_assoc();

// Fetch career assessment responses, including the prediction
$sql_career = "SELECT * FROM career_assessment_response WHERE user_id = $user_id";
$result_career = $conn->query($sql_career);
$career_data = $result_career->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="user_dashboard.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($user_data['name']); ?>!</h2>
        
        <h3>Career Path Prediction</h3>
        <p><?php echo htmlspecialchars($career_data['prediction']); ?></p>  <!-- Displaying the prediction -->
    
        <h3>Personal Information</h3>
        
        <p><strong>Name:</strong> <?php echo htmlspecialchars($personal_data['name1']); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($personal_data['dob']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($personal_data['gender']); ?></p>
        <p><strong>Mobile:</strong> <?php echo htmlspecialchars($personal_data['mobile']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($personal_data['email']); ?></p>

        <h3>Educational Information</h3>
        <p><strong>Branch:</strong> <?php echo htmlspecialchars($educational_data['branch']); ?></p>
        <p><strong>Graduation Year:</strong> <?php echo htmlspecialchars($educational_data['grad_year']); ?></p>
        <p><strong>CGPA:</strong> <?php echo htmlspecialchars($educational_data['cgpa']); ?></p>

        <!-- <h3>Career Assessment Responses</h3>
        <p><strong>Interest in Excitement:</strong> <?php echo htmlspecialchars($career_data['interests_excitement']); ?></p>
        <p><strong>Working Style:</strong> <?php echo htmlspecialchars($career_data['working_style']); ?></p>
        <p><strong>Enjoy Risk:</strong> <?php echo htmlspecialchars($career_data['enjoy_risk']); ?></p>
        <p><strong>Skills Description:</strong> <?php echo htmlspecialchars($career_data['skills_description']); ?></p>
        <p><strong>Managing People:</strong> <?php echo htmlspecialchars($career_data['managing_people']); ?></p>
        <p><strong>Five Years Vision:</strong> <?php echo htmlspecialchars($career_data['five_years_vision']); ?></p>
        <p><strong>Excites Most:</strong> <?php echo htmlspecialchars($career_data['excites_most']); ?></p>
        <p><strong>Financial Stability:</strong> <?php echo htmlspecialchars($career_data['financial_stability']); ?></p>
        <p><strong>Education Loan:</strong> <?php echo htmlspecialchars($career_data['education_loan']); ?></p>
        <p><strong>Loan Amount:</strong> <?php echo htmlspecialchars($career_data['loan_amount']); ?></p> -->

        </div>
</body>
</html>
