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


const navbar = createElementClasses("nav", [
  "navbar navbar-expand-lg navbar-light bg-light",
]);


const navbarContainer = createElementClasses("div", [
  "container-fluid",
]);
navbar.appendChild(navbarContainer);

const navbarBrand = createElementClasses("a", ["navbar-brand"]);
navbarBrand.textContent = "SIMPLON";
navbarBrand.href = "#";
navbarContainer.appendChild(navbarBrand);

const navbarToggler = createElementClasses("button", [
  "navbar-toggler",
]);
navbarToggler.type = "button";
navbarToggler.setAttribute("data-bs-toggle", "collapse");
navbarToggler.setAttribute("data-bs-target", "#navbarNav");
navbarToggler.setAttribute("aria-controls", "navbarNav");
navbarToggler.setAttribute("aria-expanded", "false");
navbarToggler.setAttribute("aria-label", "Toggle navigation");
navbarContainer.appendChild(navbarToggler);

const navbarTogglerIcon = createElementClasses("span", [
  "navbar-toggler-icon",
]);
navbarToggler.appendChild(navbarTogglerIcon);

const navbarCollapse = createElementClasses("div", [
  "collapse",
  "navbar-collapse",
]);
navbarCollapse.id = "navbarNav";
navbarContainer.appendChild(navbarCollapse);

const navbarNav = createElementClasses("ul", ["navbar-nav"]);
navbarCollapse.appendChild(navbarNav);

const navItem = createElementClasses("li", ["nav-item"]);
navbarNav.appendChild(navItem);

const navLink = createElementClasses("a", ["nav-link"]);
navLink.textContent = "Accueil";
navLink.href = "#";
navItem.appendChild(navLink);

const navItem2 = createElementClasses("li", ["nav-item"]);
navbarNav.appendChild(navItem2);

const navLink2 = createElementClasses("a", ["nav-link"]);
navLink2.textContent = "Promotions";
navLink2.href = "#";
navItem2.appendChild(navLink2);

const navbarText = createElementClasses("span", ["navbar-text"]);
navbarText.textContent = "Déconnexion";
navbarContainer.appendChild(navbarText);

const conteneur = document.querySelector("header");
conteneur.appendChild(navbar);



