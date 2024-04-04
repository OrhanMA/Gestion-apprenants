const body = document.querySelector("body");
const h1 = document.querySelector("h1");
const descriptionParagraph = document.querySelector(".descriptionParagraph");
h1.textContent = "Bienvenue";
descriptionParagraph.textContent = "";
const pageContainer = document.querySelector(".pageContainer");
const checkEmailURL =
  "http://localhost:8888/Gestion-apprenants/public/auth/check_email";
const createPasswordURL =
  "http://localhost:8888/Gestion-apprenants/public/auth/create_password";

const loginURL = "http://localhost:8888/Gestion-apprenants/public/auth/login";
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

emailForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const email = emailForm.querySelector("input[type=email]");
  const emailValue = email.value;
  console.log(emailValue);

  try {
    const response = await fetch(checkEmailURL, {
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
      displayCreatePasswordForm(user);
      document.getElementById("emailForm").remove();
    } else {
      document.getElementById("emailForm").remove();
      displayLoginForm(user);
    }
  } catch (error) {
    console.log(error);
  }
});

function displayLoginForm(user) {
  createForm(
    loginPasswordInput,
    pageContainer,
    "loginPasswordForm",
    "Connexion"
  );
  descriptionParagraph.textContent = "";
  const form = document.querySelector("#loginPasswordForm");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const password = form.querySelector("#password").value;
    try {
      const response = await fetch(loginURL, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          userId: user.id,
          email: user.email,
          password: password,
        }),
      });
      const data = await response.json();
      console.log(data);

      const loginSuccess = data.success;

      if (!loginSuccess) {
        alert(data.message);
      }

      // redirection vers page selon données dans data.user (voir le role et rediriger en conséquence)
    } catch (error) {
      console.log("Error creating password: ", error);
    }
  });
}

function displayCreatePasswordForm(user) {
  createForm(
    createPasswordInput,
    pageContainer,
    "createPasswordForm",
    "Sauvegarder"
  );

  descriptionParagraph.textContent =
    "Pour clôturer votre inscription et créer votre compte, veuillez choisir un mot de passe";
  // attacher un listener au form et fetch post
  const form = document.querySelector("#createPasswordForm");
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const password = form.querySelector("#password").value;
    const passwordConfirm = form.querySelector("#passwordConfirm").value;
    try {
      console.log(password);
      console.log(passwordConfirm);
      console.log(user.id);
      //   emily.brown@example.com
      const response = await fetch(createPasswordURL, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          userId: user.id,
          password: password,
          passwordConfirm: passwordConfirm,
        }),
      });
      const data = await response.json();
      const created = data.created;

      if (!created) {
        alert(data.message);
        window.location.reload();
      }

      // succès donc afficher la page de login
      document.getElementById("createPasswordForm").remove();
      displayLoginForm(user);
    } catch (error) {
      console.log("Error creating password: ", error);
    }
  });
}

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
