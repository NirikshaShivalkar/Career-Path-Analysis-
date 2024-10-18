document.addEventListener("DOMContentLoaded", function () {
    const steps = document.querySelectorAll(".step");
    let currentStep = 0;

    // Show the first step
    steps[currentStep].classList.add("active");

    // Next button functionality
    document.querySelectorAll(".next-button1").forEach(button => {
        button.addEventListener("click", function () {
            if (validateStep(currentStep)) {
                steps[currentStep].classList.remove("active");
                currentStep++;
                steps[currentStep].classList.add("active");
                updateNavigationButtons();
            }
        });
    });

    // Previous button functionality
    document.querySelectorAll(".previous-button").forEach(button => {
        button.addEventListener("click", function () {
            steps[currentStep].classList.remove("active");
            currentStep--;
            steps[currentStep].classList.add("active");
            updateNavigationButtons();
        });
    });

    function validateStep(stepIndex) {
        const select = steps[stepIndex].querySelector("select");
        return select && select.value !== "";
    }

    function updateNavigationButtons() {
        // Disable previous button on the first step
        document.querySelectorAll(".previous-button").forEach((button, index) => {
            button.disabled = (currentStep === 0);
        });

        // Disable next button on the last step
        document.querySelectorAll(".next-button").forEach((button, index) => {
            button.disabled = (currentStep === steps.length - 1);
        });
    }

    updateNavigationButtons();
});