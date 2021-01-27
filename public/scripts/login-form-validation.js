
let login = document.querySelector("input[name='login']");
let password = document.querySelector("input[name='password']");
let loginButton = document.querySelector(".login__button");
let form = document.querySelector("form");

let verifiedFields = [{
        selector: login,
        regex: /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]{4,200}$/
    }, {
        selector: password,
        regex: /^[a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]{8,50}$/
    }
];

for (const field of verifiedFields) {
    field.selector.addEventListener("change", e => {
        field.selector.dataset.validation = field.regex.test(field.selector.value);
    })
}

form.addEventListener("change", e => {
    loginButton.disabled = false;
    for (const field of verifiedFields) {
        if (!field.selector.dataset.validation)
            loginButton.disabled = true;
    }
})
