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

// ユーザ登録モーダル
window.registerModal = function() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    document.getElementById('confirm-name').innerText = name;
    document.getElementById('confirm-email').innerText = email;
    document.getElementById('confirm-password').innerText = password;
}