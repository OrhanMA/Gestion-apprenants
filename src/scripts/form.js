const body = document.querySelector("body");
const h1 = document.querySelector("h1");
const descriptionParagraph = document.querySelector(".descriptionParagraph");
h1.textContent = "Bienvenue";
descriptionParagraph.textContent = "";
const pageContainer = document.querySelector(".pageContainer");
const checkAuthURL =
  "http://localhost:8888/Gestion-apprenants/public/auth/check_email";
const welcomeForm1Data = [
  {
    type: "email",
    name: "email",
    labelText: "Email",
    placeholder: "mon-email@mail.com",
    classes: "form-label",
    id: "email",
  },
];
const createPasswordInput = [
  {
    type: "password",
    name: "password",
    labelText: "Mot de passe",
    placeholder: "",
    classes: "form-label",
    id: "password",
  },
  {
    type: "password",
    name: "passwordConfirm",
    labelText: "Confirmez votre mot de passe",
    placeholder: "",
    classes: "form-label",
    id: "passwordConfirm",
  },
];
const loginPasswordInput = [
  {
    type: "password",
    name: "password",
    labelText: "Mot de passe",
    placeholder: "",
    classes: "form-label",
    id: "password",
  },
];

createForm(welcomeForm1Data, pageContainer, "emailForm", "Connexion");
const emailForm = document.getElementById("emailForm");
const submitButton = emailForm.querySelector("input[type=submit]");
emailForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const email = emailForm.querySelector("input[type=email]");
  const emailValue = email.value;
  console.log(emailValue);

  try {
    const response = await fetch(checkAuthURL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        email: emailValue,
      }),
    });
    const data = await response.json();
    const userExists = data.valid;
    if (!userExists) {
      alert(data.message);
      return;
    }
    const user = data.user;
    if (user.password === null) {
      createForm(
        createPasswordInput,
        pageContainer,
        "createPasswordForm",
        "Sauvegarder"
      );
      document.getElementById("emailForm").remove();
      descriptionParagraph.textContent =
        "Pour clôturer votre inscription et créer votre compte, veuillez choisir un mot de passe";
      // attacher un listener au form et fetch post
    } else {
      createForm(
        loginPasswordInput,
        pageContainer,
        "loginPasswordForm",
        "Sauvegarder"
      );
      document.getElementById("emailForm").remove();
      descriptionParagraph.textContent = "";
      // attacher un listener au form et fetch post
    }
  } catch (error) {
    console.log(error);
  }
});
const inputsData = [
  {
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

function createForm(inputsData, target, id, submitButtonText) {
  const form = document.createElement("form");
  form.method = "POST";
  form.classList.add("mb-3");
  form.id = id;

  inputsData.forEach((inputData) => {
    const label = document.createElement("label");
    label.for = inputData.name;
    label.textContent = inputData.labelText + "*";
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
  buttonSubmit.value = submitButtonText;
  buttonSubmit.classList.add("btn", "btn-primary");
  form.appendChild(buttonSubmit);

  target.appendChild(form);
}
