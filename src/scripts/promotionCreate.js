import { getAllPromotions } from "./fetchs.js";
import { baseURL } from "./form.js";
import { promotionList } from "./promotionList.js";

export function promotionCreate(target) {
  const container = document.createElement("div");
  container.classList.add("container", "mt-5");

  const h2 = document.createElement("h2");
  h2.classList.add("mb-3");
  h2.textContent = "Création d'une promotion";
  container.appendChild(h2);

  const form = document.createElement("form");

  const formGroups = [
    {
      id: "name",
      label: "Nom de la promotion",
      type: "text",
      placeholder: "Entrez le nom de la promotion",
    },
    { id: "startDate", label: "Date de début", type: "date" },
    { id: "endDate", label: "Date de fin", type: "date" },
    {
      id: "places",
      label: "Place(s) disponible(s)",
      type: "number",
      placeholder: "Nombre de places disponibles",
    },
  ];

  formGroups.forEach((group) => {
    const div = document.createElement("div");
    div.classList.add("form-group", "mb-3");

    const label = document.createElement("label");
    label.htmlFor = group.id;
    label.textContent = group.label;
    div.appendChild(label);

    const input = document.createElement("input");
    input.type = group.type;
    input.name = group.id;
    input.required = true;
    input.classList.add("form-control");
    input.id = group.id;
    if (group.placeholder) {
      input.placeholder = group.placeholder;
    }
    div.appendChild(input);

    form.appendChild(div);
  });

  const button = document.createElement("input");
  button.type = "submit";
  button.value = "Créer la promotion";
  button.classList.add("btn", "btn-primary");
  button.textContent = "Sauvegarder";
  form.appendChild(button);

  container.appendChild(form);
  target.appendChild(container);

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const data = {
      startDate: document.querySelector("#startDate").value,
      endDate: document.querySelector("#endDate").value,
      name: document.querySelector("#name").value,
      places: document.querySelector("#places").value,
    };
    const response = await insertPromotion(data);

    if (!response.created) {
      alert("Erreur lors de la création de la promotion. Veuillez réesayer");
    }

    const pageContainer = document.querySelector(".pageContainer");
    pageContainer.innerHTML = "";
    const promotions = await getAllPromotions();
    promotionList(pageContainer, promotions);
  });
}

async function insertPromotion(formData) {
  try {
    const response = await fetch(baseURL + "/promotions", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la création d'une promotion", error);
  }
}
