const body = document.querySelector("body");
const h1 = document.querySelector("h1");
const descriptionParagraph = document.querySelector(".descriptionParagraph");
h1.textContent = "Bienvenue";
descriptionParagraph.textContent = "";
const pageContainer = document.querySelector(".pageContainer");
const baseURL = "http://localhost:8888/Gestion-apprenants/public";
const checkEmailURL = baseURL + "/auth/check_email";
const createPasswordURL = baseURL + "/auth/create_password";
const loginURL = baseURL + "/auth/login";
const coursesURL = baseURL + "/courses";
const userCourseSignatureURL = baseURL + "/courses/sign_course";
let current_user = null;
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
const emailInput = emailForm.querySelector("input[type=email]");
// emailInput.value = "test@test.com";
emailInput.value = "michael.johnson@example.com";
console.log(emailInput);
emailForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const email = emailForm.querySelector("input[type=email]");
  const emailValue = email.value;

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
    current_user = user;
    const passwordSet = data.passwordSet;
    if (!passwordSet) {
      displayCreatePasswordForm(user);
      document.getElementById("emailForm").remove();
    } else {
      document.getElementById("emailForm").remove();
      displayLoginForm(user);
    }
  } catch (error) {
    console.error(error);
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
        return;
      }
      // redirection vers page selon données dans data.user (voir le role et rediriger en conséquence)
      displayCoursesPage(user);
    } catch (error) {
      console.error("Error creating password: ", error);
    }
  });
}

async function displayCoursesPage(user) {
  pageContainer.innerHTML = "";
  const role = user.roleId;
  // console.log(role);
  if (role === 1) {
    h1.textContent = "Tous les cours pour " + user.firstName;
    descriptionParagraph.textContent =
      "Liste des cours pour l'apprenant(e) " +
      user.firstName +
      " " +
      user.lastName;
    // afficher les cours apprenants
    const data = await getUserCourses(user);
    const courses = data.courses;
    // console.log(courses);
    if (courses) {
      const coursesContainer = document.createElement("div");
      coursesContainer.classList.add("coursesContainer");
      pageContainer.appendChild(coursesContainer);
      injectCoursesList(coursesContainer, courses, "learner");
    }
  }
  if (role === 4) {
    h1.textContent = "Les cours à venir";
    descriptionParagraph.textContent =
      "Liste des cours des promotions supervisée par le responsable pédagogique " +
      user.firstName +
      " " +
      user.lastName;
    const data = await getAllCourses();
    const courses = data.courses;
    console.log(data);
    console.log(courses);
    if (courses) {
      const coursesContainer = document.createElement("div");
      coursesContainer.classList.add("coursesContainer");
      pageContainer.appendChild(coursesContainer);
      injectCoursesList(coursesContainer, courses, "pedagogique");
    }
  }
}

async function getAllCourses() {
  try {
    const response = await fetch(coursesURL, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la récupération des cours: ", error);
  }
}

function injectCoursesList(target, courses, type) {
  courses.forEach((course) => {
    if (type === "learner") {
      const card = createCourseCard(course);
      target.appendChild(card);
    }
    if (type === "pedagogique") {
      const card = createPedagoCard(course);
      target.appendChild(card);
    }
  });
}
function createPedagoCard(course) {
  console.log(course);
  const card = document.createElement("div");
  const period = document.createElement("p");
  period.textContent = course.period;
  const date = document.createElement("p");
  date.textContent = course.date;
  const button = document.createElement("button");
  button.textContent =
    course.present_count + "/" + course.places + " signatures receuillies";
  card.appendChild(period);
  card.appendChild(date);
  card.appendChild(button);
  return card;
}
function createCourseCard(course) {
  // console.log(course);
  const card = document.createElement("div");
  const period = document.createElement("p");
  period.textContent = course.course_period;
  const date = document.createElement("p");
  date.textContent = course.course_date;
  const participants = document.createElement("p");
  participants.textContent = course.promotion_places;
  const signatureButton = document.createElement("button");
  signatureButton.textContent =
    course.late === 1
      ? "Retard"
      : course.present === 0
      ? "Valider présence"
      : "Signature receuillie";

  const buttonClasses =
    course.late === 1
      ? "btn-danger"
      : course.present === 0
      ? "btn-primary"
      : "btn-secondary";
  signatureButton.classList.add("btn");
  signatureButton.classList.add(buttonClasses);
  if (course.present === 0 && course.late === 0) {
    signatureButton.addEventListener("click", async () => {
      const response = await validateCoursePresence(course.user_course_id);
      console.log(response);

      if (!response.success) {
        alert("La mise a jour de la signature a échouée");
        return;
      }
      if (current_user !== null) {
        const data = await getUserCourses(current_user);
        const courses = data.courses;
        // console.log(courses);
        const coursesContainer = document.querySelector(".coursesContainer");
        coursesContainer.innerHTML = "";
        injectCoursesList(coursesContainer, courses, "learner");
      }
    });
  }
  card.appendChild(period);
  card.appendChild(date);
  card.appendChild(participants);
  card.appendChild(signatureButton);
  return card;
}

async function validateCoursePresence(userCourseId) {
  try {
    const response = await fetch(userCourseSignatureURL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        userCourseId: userCourseId,
      }),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la signature: ", error);
  }
}

async function getUserCourses(user) {
  try {
    const response = await fetch(coursesURL, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ userId: user.id }),
    });
    const data = await response.json();
    const success = data.success;
    if (!success) {
      alert(data.message);
      return;
    }
    return data;
  } catch (error) {
    console.error("Erreur lors du fetch des cours", error);
  }
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
      console.error("Error creating password: ", error);
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
