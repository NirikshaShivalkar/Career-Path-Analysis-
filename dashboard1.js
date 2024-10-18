function validatePersonalInfo() {
    let isValid = true;

    // Personal Information validation
    if (!document.getElementById("full-name").value) {
        document.getElementById("full-name-error").textContent = "Full Name is required.";
        isValid = false;
    } else {
        document.getElementById("full-name-error").textContent = "";
    }

    if (!document.getElementById("dob").value) {
        document.getElementById("dob-error").textContent = "Date of Birth is required.";
        isValid = false;
    } else {
        document.getElementById("dob-error").textContent = "";
    }

    if (!document.getElementById("gender").value) {
        document.getElementById("gender-error").textContent = "Gender is required.";
        isValid = false;
    } else {
        document.getElementById("gender-error").textContent = "";
    }

    if (!document.getElementById("phone").value) {
        document.getElementById("phone-error").textContent = "Phone number is required.";
        isValid = false;
    } else {
        document.getElementById("phone-error").textContent = "";
    }

    if (!document.getElementById("email").value) {
        document.getElementById("email-error").textContent = "Email is required.";
        isValid = false;
    } else {
        document.getElementById("email-error").textContent = "";
    }

    if (!document.getElementById("address").value) {
        document.getElementById("address-error").textContent = "Address is required.";
        isValid = false;
    } else {
        document.getElementById("address-error").textContent = "";
    }

    if (isValid) {
        // Store data in localStorage and move to the next section
        storePersonalInfo();
        showSection('education');
    }
}

function validateEducationalBackground() {
    let isValid = true;

    // Educational Background validation
    if (!document.getElementById("year").value) {
        document.getElementById("year-error").textContent = "Current Year of Study is required.";
        isValid = false;
    } else {
        document.getElementById("year-error").textContent = "";
    }

    if (!document.getElementById("branch").value) {
        document.getElementById("branch-error").textContent = "Branch/Department is required.";
        isValid = false;
    } else {
        document.getElementById("branch-error").textContent = "";
    }

    if (!document.getElementById("gpa").value) {
        document.getElementById("gpa-error").textContent = "GPA/CGPA is required.";
        isValid = false;
    } else {
        document.getElementById("gpa-error").textContent = "";
    }

    if (!document.getElementById("performance-trends").value) {
        document.getElementById("performance-trends-error").textContent = "Academic Performance Trends are required.";
        isValid = false;
    } else {
        document.getElementById("performance-trends-error").textContent = "";
    }

    if (!document.getElementById("coursework").value) {
        document.getElementById("coursework-error").textContent = "Relevant Coursework is required.";
        isValid = false;
    } else {
        document.getElementById("coursework-error").textContent = "";
    }

    if (!document.getElementById("projects").value) {
        document.getElementById("projects-error").textContent = "Projects Undertaken are required.";
        isValid = false;
    } else {
        document.getElementById("projects-error").textContent = "";
    }

    if (!document.getElementById("internships").value) {
        document.getElementById("internships-error").textContent = "Internships and Work Experience are required.";
        isValid = false;
    } else {
        document.getElementById("internships-error").textContent = "";
    }

    if (isValid) {
        // Store data in localStorage and move to the next section
        storeEducationalBackground();
        showSection('career-interests');
    }
}

// Repeat similar functions for other sections...

function validateCareerInterests() {
    let isValid = true;

    // Career Interests validation
    if (!document.getElementById("career-path").value) {
        document.getElementById("career-path-error").textContent = "Preferred Career Path is required.";
        isValid = false;
    } else {
        document.getElementById("career-path-error").textContent = "";
    }

    if (!document.getElementById("industry").value) {
        document.getElementById("industry-error").textContent = "Industry Interests are required.";
        isValid = false;
    } else {
        document.getElementById("industry-error").textContent = "";
    }

    if (!document.getElementById("role").value) {
        document.getElementById("role-error").textContent = "Role Preferences are required.";
        isValid = false;
    } else {
        document.getElementById("role-error").textContent = "";
    }

    if (!document.getElementById("job-location").value) {
        document.getElementById("job-location-error").textContent = "Desired Job Location is required.";
        isValid = false;
    } else {
        document.getElementById("job-location-error").textContent = "";
    }

    if (!document.getElementById("companies").value) {
        document.getElementById("companies-error").textContent = "Companies of Interest are required.";
        isValid = false;
    } else {
        document.getElementById("companies-error").textContent = "";
    }

    if (isValid) {
        // Store data in localStorage and move to the next section
        storeCareerInterests();
        showSection('skills');
    }
}

function validateCareerAspirations() {
    let isValid = true;

    // Career Aspirations validation
    if (!document.getElementById("aspirations").value) {
        document.getElementById("aspirations-error").textContent = "Career Aspirations are required.";
        isValid = false;
    } else {
        document.getElementById("aspirations-error").textContent = "";
    }

    if (!document.getElementById("values").value) {
        document.getElementById("values-error").textContent = "Core Values are required.";
        isValid = false;
    } else {
        document.getElementById("values-error").textContent = "";
    }

    if (isValid) {
        // Store data in localStorage and move to the next section
        storeCareerAspirations();
        showSection('job-market-trends');
    }
}

function validateJobMarketTrends() {
    let isValid = true;

    // Job Market Trends validation
    if (!document.getElementById("industry-trends").value) {
        document.getElementById("industry-trends-error").textContent = "Awareness of Industry Trends is required.";
        isValid = false;
    } else {
        document.getElementById("industry-trends-error").textContent = "";
    }

    if (!document.getElementById("job-opportunities").value) {
        document.getElementById("job-opportunities-error").textContent = "Perceived Job Market Opportunities are required.";
        isValid = false;
    } else {
        document.getElementById("job-opportunities-error").textContent = "";
    }

    if (isValid) {
        // Store data in localStorage and submit the form
        storeJobMarketTrends();
        document.getElementById("form").submit();
    }
}

function showSection(sectionId) {
    document.querySelectorAll(".form-section").forEach(section => {
        section.style.display = section.id === sectionId ? "block" : "none";
    });
}

function storePersonalInfo() {
    localStorage.setItem("full-name", document.getElementById("full-name").value);
    localStorage.setItem("dob", document.getElementById("dob").value);
    localStorage.setItem("gender", document.getElementById("gender").value);
    localStorage.setItem("phone", document.getElementById("phone").value);
    localStorage.setItem("email", document.getElementById("email").value);
    localStorage.setItem("address", document.getElementById("address").value);
}

function storeEducationalBackground() {
    localStorage.setItem("year", document.getElementById("year").value);
    localStorage.setItem("branch", document.getElementById("branch").value);
    localStorage.setItem("gpa", document.getElementById("gpa").value);
    localStorage.setItem("performance-trends", document.getElementById("performance-trends").value);
    localStorage.setItem("coursework", document.getElementById("coursework").value);
    localStorage.setItem("projects", document.getElementById("projects").value);
    localStorage.setItem("internships", document.getElementById("internships").value);
}

function storeCareerInterests() {
    localStorage.setItem("career-path", document.getElementById("career-path").value);
    localStorage.setItem("industry", document.getElementById("industry").value);
    localStorage.setItem("role", document.getElementById("role").value);
    localStorage.setItem("job-location", document.getElementById("job-location").value);
    localStorage.setItem("companies", document.getElementById("companies").value);
}

function storeCareerAspirations() {
    localStorage.setItem("aspirations", document.getElementById("aspirations").value);
    localStorage.setItem("values", document.getElementById("values").value);
}

function storeJobMarketTrends() {
    localStorage.setItem("industry-trends", document.getElementById("industry-trends").value);
    localStorage.setItem("job-opportunities", document.getElementById("job-opportunities").value);
}

// Initialize first section
document.addEventListener("DOMContentLoaded", function () {
    showSection('personal-info');
});
