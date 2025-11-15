document.addEventListener("DOMContentLoaded", function () {
    const formOpenBtn = document.querySelector("#form-open"),
        form = document.querySelector(".form"),
        formContainer = document.querySelector(".form_container"),
        formCloseBtn = document.querySelector(".form-close"),
        signupBtn = document.querySelector("#signup"),
        loginBtn = document.querySelector("#login"),
        pwShowHide = document.querySelectorAll(".hide"),
        signupForm = document.querySelector(".signup_form"),
        loginForm = document.querySelector(".login_form");

    formOpenBtn.addEventListener("click", () => {
        form.classList.add("show");
    });

    formCloseBtn.addEventListener("click", () => {
        form.classList.remove("show");
    });

    pwShowHide.forEach((icon) => {
        icon.addEventListener("click", () => {
            let getPwInput = icon.parentElement.querySelector("input");
            console.log(getPwInput);
            if (getPwInput.type === "password") {
                getPwInput.type = "text";
                icon.classList.replace("uil-eye-slash", "uil-eye");
            } else {
                getPwInput.type = "password";
                icon.classList.replace("uil-eye", "uil-eye-slash");
            }
        });
    });

    signupBtn.addEventListener("click", (e) => {
        e.preventDefault();
        loginForm.style.display = "none";
        loginForm.classList.remove("show");
        setTimeout(() => {
            signupForm.style.display = "block";
            setTimeout(() => {
                signupForm.classList.add("show");
            }, 0); 
        }, 0);
    });

    loginBtn.addEventListener("click", (e) => {
        e.preventDefault();
        signupForm.style.display = "none";
        signupForm.classList.remove("show");
        setTimeout(() => {
            loginForm.style.display = "block";
            setTimeout(() => {
                loginForm.classList.add("show");
            }, 0); 
        }, 0);
    });
    
    loginForm.style.display = "block";
    loginForm.classList.add("show");
});

