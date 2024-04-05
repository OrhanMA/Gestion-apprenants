import {
  welcomeForm1Data,
  createPasswordInput,
  loginPasswordInput,
} from "./fixture.js";
import { promotionCreate } from "./promotionCreate.js";
import { promotionList } from "./promotionList.js";
import { promotionUpdate } from "./promotionUpdate.js";
import { navbarPromotionDetail } from "./navbarPromotionDetail.js";
import { promotionDetailInfos } from "./promotionDetailInfos.js";

const body = document.querySelector("body");
const pageContainer = document.querySelector(".pageContainer");
const baseURL = "http://localhost:8888/Gestion-apprenants/public";
const checkEmailURL = baseURL + "/auth/check_email";
const createPasswordURL = baseURL + "/auth/create_password";
const loginURL = baseURL + "/auth/login";
const coursesURL = baseURL + "/courses";
const userCourseSignatureURL = baseURL + "/courses/sign_course";
let current_user = null;
let authenticated = false;

// promotionDetailInfos();
// promotionCreate(pageContainer);
// promotionList(pageContainer);
// promotionUpdate(pageContainer);

let headerConnectedContent = `
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SIMPLON</a>
        <a>
            <span class="navbar-text connectionButton">Connexion</span>
        </a>
    </div>
</nav>
`;

const headerConnected = document.getElementById("headerConnected");

headerConnected.innerHTML = headerConnectedContent;

const connectionButton = document.querySelector(".connectionButton");
connectionButton.style.cursor = "pointer";

connectionButton.addEventListener("click", async () => {
  console.log("button clicked");
  if (authenticated) {
    const response = await logout();
    console.log(response);
    if (response.success) {
      window.location.reload();
    }
  } else {
    pageContainer.innerHTML = "";
    createForm(
      welcomeForm1Data,
      pageContainer,
      "emailForm",
      "Connexion",
      "Bienvenue",
      "Entrez votre adresse email pour vous connecter"
    );
  }
});

async function logout() {
  try {
    const response = await fetch(baseURL + "/logout", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la déconnexion ", error);
  }
}

// navbarPromotionDetail();

createForm(
  welcomeForm1Data,
  pageContainer,
  "emailForm",
  "Connexion",
  "Bienvenue",
  "Entrez votre adresse email pour vous connecter"
);
const emailForm = document.getElementById("emailForm");
const emailInput = emailForm.querySelector("input[type=email]");
// emailInput.value = "test@test.com";
emailInput.value = "michael.johnson@example.com";

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
  const descriptionParagraph = document.querySelector(".descriptionParagraph");
  if (descriptionParagraph) {
    descriptionParagraph.textContent = "";
  }
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

      authenticated = true;
      current_user = user;
      const connectionButton = document.querySelector(".connectionButton");
      connectionButton.textContent = "Déconnexion";
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
    const h1 = document.querySelector("h1");
    if (h1) {
      h1.textContent = "Tous les cours pour " + user.firstName;
    }
    const descriptionParagraph = document.querySelector("descriptionParagraph");
    if (descriptionParagraph) {
      descriptionParagraph.textContent =
        "Liste des cours pour l'apprenant(e) " +
        user.firstName +
        " " +
        user.lastName;
    }
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
    navbarPromotionDetail();
    const promotionNavbar = document.querySelector(".promotionNavbar");
    const navbarButtons = promotionNavbar.querySelectorAll("button");
    console.log(navbarButtons);
    const pageContainer = document.querySelector(".pageContainer");
    navbarButtons.forEach((button) => {
      button.addEventListener("click", async () => {
        const page = button.textContent;
        console.log(page);
        if (page === "Promotions") {
          // display page liste promotions
          pageContainer.innerHTML = "";
          const promotions = await getAllPromotions();
          console.log(promotions);
          promotionList(pageContainer, promotions);
        }
      });
    });
    const h1 = document.querySelector("h1");
    if (h1) {
      h1.textContent = "Les cours à venir";
    }
    const descriptionParagraph = document.querySelector("descriptionParagraph");
    if (descriptionParagraph) {
      descriptionParagraph.textContent =
        "Liste des cours des promotions supervisée par le responsable pédagogique " +
        user.firstName +
        " " +
        user.lastName;
    }
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

export async function getAllPromotions() {
  try {
    const response = await fetch(baseURL + "/promotions", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la récupération des promotions", error);
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

function createForm(
  inputsData,
  target,
  id,
  submitButtonText,
  h1Text,
  descriptionText
) {
  const h1 = document.createElement("h1");
  const descriptionParagraph = document.createElement("p");
  descriptionParagraph.textContent = descriptionText;
  h1.textContent = h1Text;
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

  target.appendChild(h1);
  target.appendChild(descriptionParagraph);
  target.appendChild(form);
}
