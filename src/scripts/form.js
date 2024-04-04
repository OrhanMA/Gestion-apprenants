const body = document.querySelector("body");
const pageContainer = document.querySelector('.pageContainer');

const welcomeForm1Data = [{
    type: "email",
    name: "email",
    placeholder: "mon-email@mail.com",
    classes: "form-label",
    id: 'email'
}]

createForm(welcomeForm1Data, "http://localhost:8888/Gestion-apprenants/public/auth/check_email", pageContainer);

const inputsData = [{
        type: "text",
        name: "userName",
        placeholder: "Name",
        classes: "form-label",
        id: "userName",
    },
    {
        type: "email",
        name: "userEmail",
        placeholder: "Email",
        classes: "form-label",
        id: "userName",
    },
];

function createForm(inputsData, action, target, id) {
    const form = document.createElement("form");
    form.action = action;
    form.method = "POST";
    form.classList.add("mb-3");

    inputsData.forEach((inputData) => {
        const label = document.createElement('label');
        label.for = inputData.name;
        label.textContent = inputData.name + "*";
        const input = document.createElement("input");
        input.type = inputData.type;
        input.name = inputData.name;
        input.classList.add(inputData.classes);
        input.id = inputData.id;
        input.placeholder = inputData.placeholder;
        form.appendChild(label);
        form.appendChild(input);
    });

    const buttonSubmit = document.createElement("input");
    buttonSubmit.type = "submit";
    buttonSubmit.value = "Submit";
    buttonSubmit.classList.add("btn", "btn-primary");
    form.appendChild(buttonSubmit);

    target.appendChild(form);
}

console.log("je fonctionne depuis le fichier form js");