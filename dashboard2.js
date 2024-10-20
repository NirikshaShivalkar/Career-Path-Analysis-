document.addEventListener("DOMContentLoaded", function () {
    // Populate the data overview with the values from the form inputs
    document.getElementById("full-name-view").textContent = localStorage.getItem("full-name") || "N/A";
    document.getElementById("dob-view").textContent = localStorage.getItem("dob") || "N/A";
    document.getElementById("gender-view").textContent = localStorage.getItem("gender") || "N/A";
    document.getElementById("phone-view").textContent = localStorage.getItem("phone") || "N/A";
    document.getElementById("email-view").textContent = localStorage.getItem("email") || "N/A";
    document.getElementById("address-view").textContent = localStorage.getItem("address") || "N/A";
    document.getElementById("year-view").textContent = localStorage.getItem("year") || "N/A";
    document.getElementById("branch-view").textContent = localStorage.getItem("branch") || "N/A";
    document.getElementById("gpa-view").textContent = localStorage.getItem("gpa") || "N/A";
    document.getElementById("performance-trends-view").textContent = localStorage.getItem("performance-trends") || "N/A";
    document.getElementById("coursework-view").textContent = localStorage.getItem("coursework") || "N/A";
    document.getElementById("projects-view").textContent = localStorage.getItem("projects") || "N/A";
    document.getElementById("internships-view").textContent = localStorage.getItem("internships") || "N/A";
    document.getElementById("career-path-view").textContent = localStorage.getItem("career-path") || "N/A";
    document.getElementById("industry-view").textContent = localStorage.getItem("industry") || "N/A";
    document.getElementById("role-view").textContent = localStorage.getItem("role") || "N/A";
    document.getElementById("job-location-view").textContent = localStorage.getItem("job-location") || "N/A";
    document.getElementById("companies-view").textContent = localStorage.getItem("companies") || "N/A";
    document.getElementById("technical-skills-view").textContent = localStorage.getItem("technical-skills") || "N/A";
    document.getElementById("soft-skills-view").textContent = localStorage.getItem("soft-skills") || "N/A";
    document.getElementById("certifications-view").textContent = localStorage.getItem("certifications") || "N/A";
    document.getElementById("hobbies-view").textContent = localStorage.getItem("hobbies") || "N/A";
    document.getElementById("family-income-view").textContent = localStorage.getItem("family-income") || "N/A";
    document.getElementById("parents-occupations-view").textContent = localStorage.getItem("parents-occupations") || "N/A";
    document.getElementById("siblings-view").textContent = localStorage.getItem("siblings") || "N/A";
    document.getElementById("family-education-view").textContent = localStorage.getItem("family-education") || "N/A";
    document.getElementById("support-education-view").textContent = localStorage.getItem("support-education") || "N/A";
    document.getElementById("work-environment-view").textContent = localStorage.getItem("work-environment") || "N/A";
    document.getElementById("work-life-balance-view").textContent = localStorage.getItem("work-life-balance") || "N/A";
    document.getElementById("salary-expectations-view").textContent = localStorage.getItem("salary-expectations") || "N/A";
    document.getElementById("career-growth-view").textContent = localStorage.getItem("career-growth") || "N/A";
    document.getElementById("internal-motivation-view").textContent = localStorage.getItem("internal-motivation") || "N/A";
    document.getElementById("external-motivation-view").textContent = localStorage.getItem("external-motivation") || "N/A";
    document.getElementById("role-models-view").textContent = localStorage.getItem("role-models") || "N/A";
    document.getElementById("networking-strategies-view").textContent = localStorage.getItem("networking-strategies") || "N/A";
    document.getElementById("professional-connections-view").textContent = localStorage.getItem("professional-connections") || "N/A";
    document.getElementById("mentorship-view").textContent = localStorage.getItem("mentorship") || "N/A";
    document.getElementById("alumni-network-view").textContent = localStorage.getItem("alumni-network") || "N/A";
    document.getElementById("aspirations-view").textContent = localStorage.getItem("aspirations") || "N/A";
    document.getElementById("values-view").textContent = localStorage.getItem("values") || "N/A";
    document.getElementById("industry-trends-view").textContent = localStorage.getItem("industry-trends") || "N/A";
    document.getElementById("job-opportunities-view").textContent = localStorage.getItem("job-opportunities") || "N/A";
});
