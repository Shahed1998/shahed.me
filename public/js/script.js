"use strict";
// ------------------------------------------------- Redirection
function redirector(loc) {
    window.open(loc);
}

const homeRedirector = (loc) => {
    window.location.href = `${loc}`;
};

// ------------------------------------------------- Navbar
function navLinks() {
    const navLinks = document.querySelector(".nav-links");
    navLinks.classList.toggle("nav-links-display");
}

// ------------------------------------------------- Modal
function closeModal() {
    const modalBg = document.querySelector(".modals-bg");
    modalBg.classList.remove("bg-active");
}

function modalMessage(msg) {
    document.querySelector(".modals-message").innerHTML = "<p>" + msg + "</p>";
    document.querySelector(".modals-bg").classList.add("bg-active");
}

// ------------------------------------------------- Email
function sendEmail() {
    let clientName = $("#cname").val();
    let email = $("#email").val();
    let subject = $("#subject").val();
    let comment = $("#comment").val();

    if (
        clientName.length == 0 ||
        email.length == 0 ||
        subject.length == 0 ||
        comment.length == 0
    ) {
        modalMessage("Fill up all the input fields");
    } else if (
        clientName == "undefined" ||
        clientName == "null" ||
        email == "undefined" ||
        email == "null" ||
        subject == "undefined" ||
        subject == "null" ||
        comment == "undefined" ||
        comment == "null"
    ) {
        modalMessage("Invalid message");
    } else {
        const patternEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (patternEmail.test(email)) {
            const userInfo = {
                clientName,
                email,
                subject,
                comment,
            };

            console.log(userInfo);
            //  ------------------------------------------ Send Email
            $.ajax({
                type: "POST",
                url: "/",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(userInfo),
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                beforeSend: () => {
                    $("#loader-container").toggleClass("hide");
                },
                complete: () => {
                    $("#loader-container").toggleClass("hide");
                },
                statusCode: {
                    200: (result) => {
                        $("#cname").val("");
                        $("#email").val("");
                        $("#subject").val("");
                        $("#comment").val("");
                        modalMessage(`Message sent`);
                    },
                    500: (result) => {
                        modalMessage(`Failed to send message`);
                    },
                },
            });
        } else {
            modalMessage("Invalid Email");
        }
    }
}

// ------------------------------------------------- Login validation
const login = function () {
    const email = $(".loginEmail").val();
    const password = $(".loginPassword").val();
    const patternEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (email.length == 0 || password.length == 0) {
        modalMessage("Fill up all the input fields");
        return false;
    }

    if (!patternEmail.test(email)) {
        modalMessage("Invalid email");
        return false;
    }
};

// ------------------------------------------------- Edit validation
const editValidator = function () {
    // Name validation
    const uname = $(".uname").val();
    if (uname.length == 0) {
        modalMessage("User name must not be empty");
        return false;
    } else if (uname.length < 3) {
        modalMessage("Invalid username");
        return false;
    }

    // Email validation
    const patternEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    const email = $(".dashEmail").val();

    if (email.length == 0) {
        modalMessage("Email must not be empty");
        return false;
    } else if (!patternEmail.test(email)) {
        modalMessage("Invalid email");
        return false;
    }

    // Password validation
    const password = $(".dashPassword").val();

    if (password.length == 0) {
        modalMessage("Password must not be empty");
        return false;
    }

    // Confirm password validation
    const newPassword = $(".dashNewPassword").val();
    const confirmPassword = $(".dashConfirmPassword").val();
    var passRegex = /^(?=.*[\d])(?=.*[!@#$%^&*])[\w!@#$%^&*]{6,16}$/;
    if (newPassword.length > 0 && !passRegex.test(newPassword)) {
        modalMessage(
            "Password length must be between 6-16 characters long and must contain at least 1 number and special character"
        );
        return false;
    } else if (confirmPassword != newPassword) {
        modalMessage("Invalid confirm password");
        return false;
    }

    // Description validation
    const description = $(".user_description").val();
    if (description.length < 1) {
        modalMessage("User must have a brief description");
        return false;
    }

    // Image validation
    const img = $("#image");
    if (img[0].files.length > 0) {
        const pattern = /(.jpg|.png|.jpeg)/;
        if (!pattern.test(img[0].files[0]["name"])) {
            modalMessage("Invalid file type");
            return false;
        }

        if (img[0].files[0]["size"] > 20000) {
            modalMessage("File size too big, minimum 20kb");
            return false;
        }
    }

    return true;
};
