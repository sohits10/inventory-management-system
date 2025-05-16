
document.getElementById('footerLoginBtn').addEventListener('click', function() {
    var loginForm = document.getElementById('loginFormContainer');
    
    // Toggle form visibility
    if (loginForm.style.display === "none" || loginForm.style.display === "") {
        loginForm.style.display = "block";
    } else {
        loginForm.style.display = "none";
    }
});
