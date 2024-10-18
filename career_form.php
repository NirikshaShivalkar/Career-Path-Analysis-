<?php
session_start();

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'student_db1';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure user is logged in and has a valid user_id
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die('User ID not found in session. Please log in again.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $interests_excitement = $conn->real_escape_string($_POST['interests_excitement']);
    $working_style = $conn->real_escape_string($_POST['working_style']);
    $enjoy_risk = $conn->real_escape_string($_POST['enjoy_risk']);
    $skills_description = $conn->real_escape_string($_POST['skills_description']);
    $managing_people = $conn->real_escape_string($_POST['managing_people']);
    $five_years_vision = $conn->real_escape_string($_POST['five_years_vision']);
    $excites_most = $conn->real_escape_string($_POST['excites_most']);
    $financial_stability = $conn->real_escape_string($_POST['financial_stability']);
    $education_loan = $conn->real_escape_string($_POST['education_loan']);
    $loan_amount = $conn->real_escape_string($_POST['loan_amount']);

    // Prepare data for prediction
    $career_assessment_data = [
        'interests_excitement' => $interests_excitement,
        'working_style' => $working_style,
        'enjoy_risk' => $enjoy_risk,
        'skills_description' => $skills_description,
        'managing_people' => $managing_people,
        'five_years_vision' => $five_years_vision,
        'excites_most' => $excites_most,
        'financial_stability' => $financial_stability,
        'education_loan' => $education_loan,
        'loan_amount' => $loan_amount
    ];

    // Convert data to JSON format
    $data_json = json_encode($career_assessment_data);

    // Save JSON data to a temporary file
    $temp_file = 'temp_input.json';
    file_put_contents($temp_file, $data_json);

    // Execute the Python script and get the prediction output
    $command = escapeshellcmd("python career_prediction1.py $temp_file");
    $prediction_output = shell_exec($command);

    // Store prediction in the database (update if record exists)
    $sql_check = "SELECT * FROM career_assessment_response WHERE user_id = '$user_id'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Update existing record
        $sql = "UPDATE career_assessment_response 
                SET interests_excitement='$interests_excitement', 
                    working_style='$working_style', 
                    enjoy_risk='$enjoy_risk', 
                    skills_description='$skills_description', 
                    managing_people='$managing_people', 
                    five_years_vision='$five_years_vision', 
                    excites_most='$excites_most', 
                    financial_stability='$financial_stability', 
                    education_loan='$education_loan', 
                    loan_amount='$loan_amount',
                    prediction='$prediction_output'
                WHERE user_id='$user_id'";
    } else {
        // Insert new record
        $sql = "INSERT INTO career_assessment_response (
                    user_id, interests_excitement, working_style, enjoy_risk, 
                    skills_description, managing_people, five_years_vision, 
                    excites_most, financial_stability, education_loan, loan_amount, prediction
                ) VALUES (
                    '$user_id', '$interests_excitement', '$working_style', '$enjoy_risk', 
                    '$skills_description', '$managing_people', '$five_years_vision', 
                    '$excites_most', '$financial_stability', '$education_loan', '$loan_amount', 
                    '$prediction_output'
                )";
    }

    if ($conn->query($sql) === TRUE) {
        // Redirect to the dashboard after form submission and prediction
        header("Location: dashboard2.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
