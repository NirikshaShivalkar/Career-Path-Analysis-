<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

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

// Use prepared statements to prevent SQL injection
// Fetch personal information
$stmt = $conn->prepare("SELECT * FROM personal_info WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_personal = $stmt->get_result();

// Debug the number of rows returned
$row_count = $result_personal->num_rows;
echo "Rows returned: " . $row_count;

$personal_info = $result_personal->fetch_assoc();



// Fetch educational information
$stmt = $conn->prepare("SELECT * FROM educational_info WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_education = $stmt->get_result();
$education_info = $result_education->fetch_assoc();

// Fetch skills information
$stmt = $conn->prepare("SELECT * FROM skills WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_skills = $stmt->get_result();
$skills_info = $result_skills->fetch_assoc();

// Fetch family information
$stmt = $conn->prepare("SELECT * FROM family_info WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_family = $stmt->get_result();
$family_info = $result_family->fetch_assoc();

$stmt = $conn->prepare("SELECT * FROM career_assessment_response WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_career = $stmt->get_result();
$career_info = $result_career->fetch_assoc();

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Data Overview</title>
    <link rel="stylesheet" href="dashboard2.css">
</head>

<body>
    <div class="sidebar">
        <h2>User Dashboard</h2>
        <ul>
            <li><a href="#career_path">Career Path</a></li>
            <li><a href="#personal-info-overview">Personal Information</a></li>
            <li><a href="#education-overview">Educational Background</a></li>
            <li><a href="#skills-overview">Skills and Competencies</a></li>
            <li><a href="#family-background-overview">Family Background</a></li>
            <li><a href="#personal-preferences-overview">Personal Preferences</a></li>
            
            
        </ul>
        <button class="logout-button" onclick="window.location.href='login.html'">Logout</button>
    </div>

    <div class="content">
        <h1>User Data Overview</h1>
        <section id="career_path" class="data-section">
            <h2>Predicted Career Path</h2>
            <p><strong>Congratualations! Your Predicted Career Path </strong> <span id="career_path"><?php echo htmlspecialchars($career_info['prediction'] ?? 'N/A'); ?></span></p>
            <button type="button" class="edit-button">Take a Test again</button>
        </section>



        <!-- Personal Information Overview -->
<section id="personal-info-overview" class="data-section">
    <h2>Personal Information</h2>
    <p><strong>Full Name:</strong> <span id="full-name-view"><?php echo htmlspecialchars($personal_info['name1'] ?? 'N/A'); ?></span></p>
    <p><strong>Date of Birth:</strong> <span id="dob-view"><?php echo htmlspecialchars($personal_info['dob'] ?? 'N/A'); ?></span></p>
    <p><strong>Gender:</strong> <span id="gender-view"><?php echo htmlspecialchars($personal_info['gender'] ?? 'N/A'); ?></span></p>
    <p><strong>Contact Information (Phone):</strong> <span id="phone-view"><?php echo htmlspecialchars($personal_info['mobile'] ?? 'N/A'); ?></span></p>
    <p><strong>Contact Information (Email):</strong> <span id="email-view"><?php echo htmlspecialchars($personal_info['email'] ?? 'N/A'); ?></span></p>
    <button type="button" class="edit-button">Edit</button>
</section>

<!-- Educational Background Overview -->
<section id="education-overview" class="data-section">
    <h2>Educational Background</h2>
    <p><strong>Branch/Department:</strong> <span id="branch-view"><?php echo htmlspecialchars($education_info['branch'] ?? 'N/A'); ?></span></p>
    <p><strong>Graduation Year:</strong> <span id="grad-year-view"><?php echo htmlspecialchars($education_info['grad_year'] ?? 'N/A'); ?></span></p>
    <p><strong>GPA/CGPA:</strong> <span id="gpa-view"><?php echo htmlspecialchars($education_info['cgpa'] ?? 'N/A'); ?></span></p>
    <button type="button" class="edit-button">Edit</button>
</section>

<!-- Skills and Competencies Overview -->
<section id="skills-overview" class="data-section">
    <h2>Skills and Competencies</h2>
    <p><strong>Technical Skills:</strong> <span id="technical-skills-view"><?php echo htmlspecialchars($skills_info['tech_skills'] ?? 'N/A'); ?></span></p>
    <p><strong>Soft Skills:</strong> <span id="soft-skills-view"><?php echo htmlspecialchars($skills_info['soft_skills'] ?? 'N/A'); ?></span></p>
    <p><strong>Certifications and Additional Qualifications:</strong> <span id="certifications-view"><?php echo htmlspecialchars($skills_info['certifications'] ?? 'N/A'); ?></span></p>
    <p><strong>Projects:</strong> <span id="projects-view"><?php echo htmlspecialchars($skills_info['projects'] ?? 'N/A'); ?></span></p>
    <p><strong>Language Proficiency:</strong> <span id="language-proficiency-view"><?php echo htmlspecialchars($skills_info['language_proficiency'] ?? 'N/A'); ?></span></p>
    <button type="button" class="edit-button">Edit</button>
</section>

<!-- Family Background Overview -->
<section id="family-background-overview" class="data-section">
    <h2>Family Background</h2>
    <p><strong>Have you taken a Loan?</strong> <span id="loan-view"><?php echo htmlspecialchars($family_info['loan'] ?? 'N/A'); ?></span></p>
    <p><strong>If yes, what is the loan amount?</strong> <span id="loan-amount-view"><?php echo htmlspecialchars($family_info['loan_amount'] ?? 'N/A'); ?></span></p>
    <p><strong>Family Income:</strong> <span id="family-income-view"><?php echo htmlspecialchars($family_info['income'] ?? 'N/A'); ?></span></p>
    <button type="button" class="edit-button">Edit</button>
</section>


        <!-- Personal Preferences Overview
        <section id="personal-preferences-overview" class="data-section">
            <h2>Personal Preferences</h2>
            <p><strong>Work Environment Preferences:</strong> <span id="work-environment-view"><?php echo htmlspecialchars($preferences_info['work_environment']); ?></span></p>
            <p><strong>Work-Life Balance Expectations:</strong> <span id="work-life-balance-view"><?php echo htmlspecialchars($preferences_info['work_life_balance']); ?></span></p>
            <p><strong>Salary Expectations:</strong> <span id="salary-expectations-view"><?php echo htmlspecialchars($preferences_info['salary_expectations']); ?></span></p>
            <p><strong>Career Growth Expectations:</strong> <span id="career-growth-view"><?php echo htmlspecialchars($preferences_info['career_growth']); ?></span></p>
            <button type="button" class="edit-button">Edit</button>
        </section> -->
    </div>

    <script src="dashboard2.js"></script>
</body>

</html>
