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

const navbarContainer = createElementClasses("div", ["container-fluid"]);
navbar.appendChild(navbarContainer);

const navbarBrand = createElementClasses("a", ["navbar-brand"]);
navbarBrand.textContent = "SIMPLON";
navbarBrand.href = "#";
navbarContainer.appendChild(navbarBrand);

const navbarToggler = createElementClasses("button", ["navbar-toggler"]);
navbarToggler.type = "button";
navbarToggler.setAttribute("data-bs-toggle", "collapse");
navbarToggler.setAttribute("data-bs-target", "#navbarNav");
navbarToggler.setAttribute("aria-controls", "navbarNav");
navbarToggler.setAttribute("aria-expanded", "false");
navbarToggler.setAttribute("aria-label", "Toggle navigation");
navbarContainer.appendChild(navbarToggler);

const navbarTogglerIcon = createElementClasses("span", ["navbar-toggler-icon"]);
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

//Formulaire 1

function genererCours(cours, parentSelector) {
  const parentElement = document.querySelector(parentSelector);

  cours.forEach(cours => {
    const divElement = document.createElement("div");
    divElement.classList.add("validePresence");
    divElement.innerHTML = `
      <div>
          <h1>${cours.code}</h1>
          <p class="paraph">${cours.nombreParticipants} participants</p>
      </div>
      <div>
          <p class="para">${cours.date}</p>
          <button type="button" class="btn btn-primary">Valide présence</button>
      </div>
    `;
    parentElement.appendChild(divElement);
  });
}


//Formulaire 2

const signatures = [
  { code: "DWWM3", nombreParticipants: 15, date: "01-01-2024" },
  { code: "DWWM4", nombreParticipants: 12, date: "02-01-2024" },
  { code: "DWWM5", nombreParticipants: 18, date: "03-01-2024" },
];

const formParent = document.querySelector(".signature-container");

function genererSignatures(signatures, parentSelector) {
  signatures.forEach((signature) => {
    const divElement = document.createElement("div");
    divElement.classList.add("signature");
    divElement.innerHTML = `
        <div class="recueillie">
            <h1>${signature.code}</h1>
            <p class="paraph">${signature.nombreParticipants} participants</p>
        </div>
        <div>
            <p class="para">${signature.date}</p>
            <button type="button" class="btn btn-secondary">Signature recueillie</button>
        </div>
    `;
    document.querySelector(parentSelector).appendChild(divElement);
  });
}

genererSignatures(signatures, ".signature-container");


//Formulaire 3

const coursEnCours = [
  { code: 'DWWM3', nombreParticipants: 15, date: '01-01-2024' },
  { code: 'DWWM4', nombreParticipants: 12, date: '02-01-2024' },
  { code: 'DWWM5', nombreParticipants: 18, date: '03-01-2024' },
];

const formcours = document.querySelector('.cours-en-cours-container');

coursEnCours.forEach(cours => {
  const divElement = document.createElement('div');
  divElement.classList.add(cours.code);
  divElement.innerHTML = `
      <div class="cours">
          <h2>${cours.code}</h2>
          <p>${cours.nombreParticipants} participants</p>
      </div>
      <div>
          <p class="para">${cours.date}</p>
          <button type="button" class="btn btn-warning">Signatures en Cours</button>
      </div>
  `;
  formcours.appendChild(divElement);
});

//Formulaire 4

const coursSignaturesRecueillies = [
  { code: 'DWWM2', nombreParticipants: 15, date: '01-01-2024' },
  { code: 'DWWM4', nombreParticipants: 12, date: '02-01-2024' },
  { code: 'DWWM6', nombreParticipants: 18, date: '03-01-2024' },
];

const formRecueillies = document.querySelector('.cours-signatures-recueillies-container');

coursSignaturesRecueillies.forEach(cours => {
  const divElement = document.createElement('div');
  divElement.classList.add(cours.code);
  divElement.innerHTML = `
      <div>
          <h2>${cours.code}</h2>
          <p class="paraph">${cours.nombreParticipants} participants</p>
      </div>
      <div>
          <p class="para">${cours.date}</p>
          <button type="button" class="btn btn-success">Signatures recueillies</button>
      </div>
  `;
  formRecueillies.appendChild(divElement);
});


//Formulaire 5

const coursSignaturesManquantes = [
  { code: 'CDA', nombreParticipants: 12, date: '01-01-2024' },
  { code: 'DWWM1', nombreParticipants: 10, date: '02-01-2024' },
  { code: 'DWWM7', nombreParticipants: 16, date: '03-01-2024' },
];

const formManquantes = document.querySelector('.cours-signatures-manquantes-container');

coursSignaturesManquantes.forEach(cours => {
  const divElement = document.createElement('div');
  divElement.classList.add(cours.code);
  divElement.innerHTML = `
      <div>
          <h2>${cours.code}</h2>
          <p class="paraph">${cours.nombreParticipants} participants</p>
      </div>
      <div>
          <p class="para">${cours.date}</p>
          <button type="button" class="btn btn-danger">Signatures manquantes</button>
      </div>
  `;
  formManquantes.appendChild(divElement);
});

