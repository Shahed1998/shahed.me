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
                        modalMessage(`Message sent`);
                        $("#cname").value = "";
                        $("#email").value = "";
                        $("#subject").value = "";
                        $("#comment").value = "";
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
