// Клиентская логика: базовая валидация форм на лету
document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".form");
    if (!form) return;

    form.addEventListener("submit", (e) => {
        const password = form.querySelector('input[name="password"]');
        if (password && password.value.length > 0 && password.value.length < 6) {
            e.preventDefault();
            alert("Пароль должен содержать не менее 6 символов.");
        }
    });
});
