require('./bootstrap');


// パスワード閲覧機能
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-toggle='password']").forEach((button) => {
        button.addEventListener("click", () => {
            const input = button.previousElementSibling;
            const icon = button.querySelector("i");

            if (!input || !icon) return;

            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            icon.classList.toggle("bi-eye");
            icon.classList.toggle("bi-eye-slash");
        });
    });
});