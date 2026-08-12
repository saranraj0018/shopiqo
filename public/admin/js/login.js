$(function () {

    const loginTab = document.getElementById("loginTab");
    const signupTab = document.getElementById("signupTab");
    const tabIndicator = document.getElementById("tabIndicator");

    const loginForm = document.getElementById("personalloginForm");
    const signupForm = document.getElementById("personalsignupForm");

    const formTitle = document.getElementById("formTitle");
    const formSubtitle = document.getElementById("formSubtitle");

    const bottomSignupBtn = document.getElementById("bottomSignupBtn");
    const bottomLoginBtn = document.getElementById("bottomLoginBtn");

    function showLogin() {
        tabIndicator.style.transform = "translateX(0%)";

        loginTab.classList.remove("text-white/85");
        loginTab.classList.add("text-black");

        signupTab.classList.remove("text-black");
        signupTab.classList.add("text-white/85");

        signupForm.classList.remove("active-form");
        signupForm.classList.add("hidden-form");

        setTimeout(() => {
            signupForm.style.display = "none";
            loginForm.style.display = "block";

            setTimeout(() => {
                loginForm.classList.remove("hidden-form");
                loginForm.classList.add("active-form");
            }, 20);
        }, 150);

        formTitle.textContent = "Welcome Back!";
        formSubtitle.textContent = "Sign in to your personal buyer account";
    }

    function showSignup() {
        tabIndicator.style.transform = "translateX(100%)";

        signupTab.classList.remove("text-white/85");
        signupTab.classList.add("text-black");

        loginTab.classList.remove("text-black");
        loginTab.classList.add("text-white/85");

        loginForm.classList.remove("active-form");
        loginForm.classList.add("hidden-form");

        setTimeout(() => {
            loginForm.style.display = "none";
            signupForm.style.display = "block";

            setTimeout(() => {
                signupForm.classList.remove("hidden-form");
                signupForm.classList.add("active-form");
            }, 20);
        }, 150);

        formTitle.textContent = "Create Your Account";
        formSubtitle.textContent = "Sign up for your personal buyer account";
    }

    loginTab.addEventListener("click", showLogin);
    signupTab.addEventListener("click", showSignup);
    bottomSignupBtn.addEventListener("click", showSignup);
    bottomLoginBtn.addEventListener("click", showLogin);

    loginForm.style.display = "block";
    signupForm.style.display = "none";

    $(document).on("submit", "#personalloginForm", function (e) {
        e.preventDefault();
        let $saveBtn = $("#login_personal_form");
        let fields = [
            {
                id: "#email",
                condition: (val) => val === "",
                message: "Email is required",
            },
            {
                id: "#password",
                condition: (val) => val === "",
                message: "Password is required",
            },
        ];
        let isValid = true;
        for (const field of fields) {
            const result = validateField(field);
            if (!result) isValid = false;
        }
        if (!isValid) return;
        $saveBtn
            .prop("disabled", true)
            .removeClass("opacity-50 cursor-not-allowed")
            .text("Saving....");
        let formData = new FormData(this);
        sendRequest(
            "/user/authenticate",
            formData,
            "POST",
            function (res) {
                if (res.success) {
                    showToast(res.message, "success", 2000);
                    setTimeout(() => {
                        window.location.href = res.redirect;
                    }, 500);
                } else {
                    showToast(res.message, "error", 2000);
                }
                $saveBtn
                    .prop("disabled", false)
                    .removeClass("opacity-50 cursor-not-allowed")
                    .text("Save");
            },
            function (err) {
                if (err.errors) {
                    let msg = "";
                    $.each(err.errors, function (k, v) {
                        msg += v[0] + "<br>";
                    });
                    showToast(msg, "error", 2000);
                } else {
                    showToast(err.message || "Unexpected error", "error", 2000);
                }
                $saveBtn
                    .prop("disabled", false)
                    .removeClass("opacity-50 cursor-not-allowed")
                    .text("Save");
            },
        );
    });

    $(document).on("submit", "#personalsignupForm", function (e) {
        e.preventDefault();
        let $saveBtn = $("#save_personal_login");
        let fields = [
            {
                id: "#full_name",
                condition: (val) => val === "",
                message: "Full Name is required",
            },
            {
                id: "#email",
                condition: (val) => val === "",
                message: "Email is required",
            },
            {
                id: "#phone_number",
                condition: (val) => val === "" || val <= 0,
                message: "Phone Number is required",
            },
            {
                id: "#password",
                condition: (val) => val === "",
                message: "Password is required",
            },
        ];
        let isValid = true;
        for (const field of fields) {
            const result = validateField(field);
            if (!result) isValid = false;
        }
        if (!isValid) return;
        $saveBtn
            .prop("disabled", true)
            .removeClass("opacity-50 cursor-not-allowed")
            .text("Saving....");
        let formData = new FormData(this);
        sendRequest(
            "/user/register/update",
            formData,
            "POST",
            function (res) {
                if (res.success) {
                    showToast(res.message, "success", 2000);
                    setTimeout(() => {
                        window.location.href = res.redirect; // ← redirect here
                    }, 500);
                } else {
                    showToast(res.message, "error", 2000);
                }
                $saveBtn
                    .prop("disabled", false)
                    .removeClass("opacity-50 cursor-not-allowed")
                    .text("Save");
            },
            function (err) {
                if (err.errors) {
                    let msg = "";
                    $.each(err.errors, function (k, v) {
                        msg += v[0] + "<br>";
                    });
                    showToast(msg, "error", 2000);
                } else {
                    showToast(err.message || "Unexpected error", "error", 2000);
                }
                $saveBtn
                    .prop("disabled", false)
                    .removeClass("opacity-50 cursor-not-allowed")
                    .text("Save");
            },
        );
    });
});
