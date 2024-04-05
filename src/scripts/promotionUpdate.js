import { baseURL } from "./form.js";
import { getAllPromotions } from "./fetchs.js";
import { promotionList } from "./promotionList.js";

export async function promotionUpdate(target, promotionId) {
  const container = document.createElement("div");
  container.classList.add("container", "mt-5");

  const h2 = document.createElement("h2");
  h2.textContent = "Édition de la promotion DWWM3";
  container.appendChild(h2);

  const p = document.createElement("p");
  p.textContent = "Les changements appliqués sont définitifs";
  container.appendChild(p);

  const form = document.createElement("form");

  const response = await getPromotion(promotionId);
  const promotion = response.promotion;
  const formGroups = [
    {
      id: "name",
      label: "Nom de la promotion",
      type: "text",
      placeholder: "Entrez le nom de la promotion",
      value: promotion.name,
    },
    {
      id: "startDate",
      label: "Date de début",
      type: "date",
      value: promotion.startDate,
    },

    {
      id: "endDate",
      label: "Date de fin",
      type: "date",
      value: promotion.endDate,
    },
    {
      id: "places",
      label: "Place(s) disponible(s)",
      type: "number",
      placeholder: "Nombre de places disponibles",
      value: promotion.places,
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
    input.value = group.value;
    div.appendChild(input);

    form.appendChild(div);
  });

  const div = document.createElement("div");
  div.classList.add("form-group", "mb-3");

  const buttonDelete = document.createElement("button");
  buttonDelete.type = "button";
  buttonDelete.classList.add("btn", "btn-danger");
  buttonDelete.textContent = "Supprimer";
  div.appendChild(buttonDelete);

  buttonDelete.addEventListener("click", async () => {
    const response = await deletePromotion(promotion.id);
    if (response.success) {
      alert("La promotion a bien été supprimée");
    } else {
      alert("Une erreur est survenue lors de la suppression de la promotion");
    }
    const pageContainer = document.querySelector(".pageContainer");
    pageContainer.innerHTML = "";
    const promotions = await getAllPromotions();
    promotionList(pageContainer, promotions);
  });

  const buttonSave = document.createElement("button");
  buttonSave.type = "submit";
  buttonSave.classList.add("btn", "btn-primary");
  buttonSave.textContent = "Sauvegarder";
  div.appendChild(buttonSave);

  form.appendChild(div);
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
    const response = await updatePromotion(data, promotion.id);

    if (!response.updated) {
      alert("Erreur lors de la mise à jour de la promotion. Veuillez réesayer");
    }

    const pageContainer = document.querySelector(".pageContainer");
    pageContainer.innerHTML = "";
    const promotions = await getAllPromotions();
    promotionList(pageContainer, promotions);
  });
}

async function updatePromotion(formData, promotionId) {
  try {
    const response = await fetch(
      baseURL + `/promotions/update/${promotionId}`,
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      }
    );
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la création d'une promotion", error);
  }
}

async function deletePromotion(promotionId) {
  try {
    const response = await fetch(baseURL + `/promotions/delete/${promotionId}`);
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la suppression de la promotion");
  }
}

export async function getPromotion(promotionId) {
  try {
    const response = await fetch(baseURL + `/promotions/${promotionId}`, {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Erreur lors de la mise à jour de la promotion", error);
  }
}
