<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "localhost";
    $username = "root"; // Update as necessary
    $password = ""; // Update as necessary
    $dbname = "student_db1"; // Update as necessary

    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and capture form data
    $name1 = $conn->real_escape_string($_POST['name1']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $email = $conn->real_escape_string($_POST['email']);
    $branch = $conn->real_escape_string($_POST['branch']);
    $grad_year = $conn->real_escape_string($_POST['grad_year']);
    $cgpa = $conn->real_escape_string($_POST['cgpa']);
    $tech_skills = $conn->real_escape_string($_POST['tech_skills']);
    $soft_skills = $conn->real_escape_string($_POST['soft_skills']);
    $certifications = $conn->real_escape_string($_POST['certifications']);
    $projects = $conn->real_escape_string($_POST['projects']);
    // $languages = $conn->real_escape_string($_POST['languages']);
    $loan = isset($_POST['loan']) ? $conn->real_escape_string($_POST['loan']) : 'No';
    $loan_amount = isset($_POST['loan_amount']) ? $conn->real_escape_string($_POST['loan_amount']) : '';
    $income = $conn->real_escape_string($_POST['income']);
    $hobbies = $conn->real_escape_string($_POST['hobbies']);
    $work_environment = $conn->real_escape_string($_POST['work-environment']);
    $relocation = $conn->real_escape_string($_POST['relocation']);
    $work_hours = $conn->real_escape_string($_POST['work-hours']);

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

    // Check if user_id exists in the skills table (assuming you have this table)
    $sql_check_skills = "SELECT * FROM skills WHERE user_id = $user_id";
    $result_skills = $conn->query($sql_check_skills);

    if ($result_skills->num_rows > 0) {
        // Update existing skills info
        $sql_skills = "UPDATE skills SET tech_skills='$tech_skills', soft_skills='$soft_skills', certifications='$certifications', projects='$projects' WHERE user_id=$user_id";
    } else {
        // Insert new skills info
        $sql_skills = "INSERT INTO skills (user_id, tech_skills, soft_skills, certifications, projects) VALUES ('$user_id', '$tech_skills', '$soft_skills', '$certifications', '$projects')";
    }
    $conn->query($sql_skills);

    // Check if user_id exists in family_info table (assuming you have this table)
    $sql_check_family = "SELECT * FROM family_info WHERE user_id = $user_id";
    $result_family = $conn->query($sql_check_family);

    if ($result_family->num_rows > 0) {
        // Update existing family info
        $sql_family = "UPDATE family_info SET income='$income', loan='$loan', loan_amount='$loan_amount' WHERE user_id=$user_id";
    } else {
        // Insert new family info
        $sql_family = "INSERT INTO family_info (user_id, income, loan, loan_amount) VALUES ('$user_id', '$income', '$loan', '$loan_amount')";
    }
    $conn->query($sql_family);

    // // Check if user_id exists in preferences table (assuming you have this table)
    // $sql_check_preferences = "SELECT * FROM preferences WHERE user_id = $user_id";
    // $result_preferences = $conn->query($sql_check_preferences);

    // if ($result_preferences->num_rows > 0) {
    //     // Update existing preferences info
    //     $sql_preferences = "UPDATE preferences SET hobbies='$hobbies', work_environment='$work_environment', relocation='$relocation', work_hours='$work_hours' WHERE user_id=$user_id";
    // } else {
    //     // Insert new preferences info
    //     $sql_preferences = "INSERT INTO preferences (user_id, hobbies, work_environment, relocation, work_hours) VALUES ('$user_id', '$hobbies', '$work_environment', '$relocation', '$work_hours')";
    // }
    // $conn->query($sql_preferences);

    // After all inserts, redirect or display a success message
    echo "Records created/updated successfully.";
    
    // Close connection
    $conn->close();
}
?>
