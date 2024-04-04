function createForm(inputsData, action, target, id) {
  const form = document.createElement("form");
  form.action = action;
  form.method = "POST";
  form.classList.add("mb-3");

  inputsData.forEach((inputData) => {
    const input = document.createElement("input");
    input.type = inputData.type;
    input.name = inputData.name;
    input.classList.add(inputData.classe);
    input.id = inputData.id;
    input.placeholder = inputData.placeholder;
    form.appendChild(input);
  });

  const buttonSubmit = document.createElement("input");
  buttonSubmit.type = "submit";
  buttonSubmit.value = "Submit";
  buttonSubmit.classList.add("btn", "btn-primary");
  form.appendChild(buttonSubmit);

  target.appendChild(form);
}

const body = document.querySelector("body");
const inputsData = [
  {
    type: "text",
    name: "userName",
    placeholder: "Name",
    classe: "form-label",
    id: "userName",
  },
  {
    type: "email",
    name: "userEmail",
    placeholder: "Email",
    classe: "form-label",
    id: "userName",
  },
];

createForm(
  inputsData,
  "http://localhost:8888/projets/Gestion-apprenants/public/users",
  body
);
