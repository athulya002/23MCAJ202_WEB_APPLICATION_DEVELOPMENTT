function validateForm(event) {
    event.preventDefault(); 
    
    // get input
    let firstName = document.getElementById("firstName").value.trim();
    let lastName = document.getElementById("lastName").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let terms = document.getElementById("terms").checked;
    let errors = [];

    //chck the validation
    if (firstName === "") errors.push("First name is required");
    if (lastName === "") errors.push("Last name is required");
    if (email === "" || !email.includes("@")) errors.push("Valid email is required");
    if (phone === "" || phone.length < 10) errors.push("Valid phone number is required");
    if (password.length < 6) errors.push("Password must be at least 6 characters");
    if (password !== confirmPassword) errors.push("Passwords do not match");
    if (!terms) errors.push("You must agree to the terms and conditions");
    
    //display 
    if (errors.length > 0) {
        alert(errors.join("\n"));
    } else {
        alert("Form submitted successfully!");
        document.getElementById("registrationForm").submit();
    }
}
