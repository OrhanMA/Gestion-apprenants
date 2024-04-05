import { promotionCreate } from "./promotionCreate.js";
import { promotionDetailInfos } from "./promotionDetailInfos.js";
import { promotionUpdate } from "./promotionUpdate.js";

export function promotionList(target, promotions) {
  const container = document.createElement("div");
  container.classList.add("container", "mt-3");

  const header = document.createElement("div");
  header.classList.add(
    "d-flex",
    "justify-content-between",
    "align-items-center"
  );

  const h2 = document.createElement("h2");
  h2.textContent = "Toutes les promotions";
  header.appendChild(h2);

  const link = document.createElement("button");
  link.classList.add("btn", "btn-success", "font-weight-bold");
  link.textContent = "Ajouter promotion";

  link.addEventListener("click", () => {
    const pageContainer = document.querySelector(".pageContainer");
    pageContainer.innerHTML = "";
    promotionCreate(pageContainer);
  });
  header.appendChild(link);

  container.appendChild(header);

  const p = document.createElement("p");
  p.textContent = "tableau des promotions de Simplon";
  container.appendChild(p);

  const table = document.createElement("table");
  table.classList.add("table");

  //   const promotions = [
  //     { name: "DWWM 3", startDate: "01-01-2024", endDate: "01-12-2024", places: 15 },
  //     { name: "DWWM 2", startDate: "01-01-2024", endDate: "01-12-2024", places: 15 },
  //     { name: "CDA", startDate: "01-01-2024", endDate: "01-12-2024", places: 12 },
  //     { name: "CDA list", startDate: "01-01-2024", endDate: "01-12-2024", places: 12 },
  //   ];

  promotions.forEach((promotion) => {
    const tr = document.createElement("tr");
    tr.classList.add("squareBullets");

    const tdName = document.createElement("td");
    tdName.textContent = promotion.name;
    tr.appendChild(tdName);

    const tdStart = document.createElement("td");
    tdStart.textContent = "début: " + promotion.startDate;
    tr.appendChild(tdStart);

    const tdEnd = document.createElement("td");
    tdEnd.textContent = "fin: " + promotion.endDate;
    tr.appendChild(tdEnd);

    const tdPlaces = document.createElement("td");
    tdPlaces.textContent = "places: " + promotion.places;
    tr.appendChild(tdPlaces);

    const tdActions = document.createElement("td");

    const promotionId = promotion.id;
    const showButton = document.createElement("button");
    showButton.textContent = "Voir";
    const updateButton = document.createElement("button");
    updateButton.textContent = "Éditer";
    tdActions.appendChild(showButton);
    tdActions.appendChild(updateButton);
    const pageContainer = document.querySelector(".pageContainer");
    updateButton.addEventListener("click", () => {
      pageContainer.innerHTML = "";
      promotionUpdate(pageContainer, promotionId);
    });
    showButton.addEventListener("click", () => {
      pageContainer.innerHTML = "";
      promotionDetailInfos(pageContainer, promotionId);
    });

    tr.appendChild(tdActions);

    table.appendChild(tr);
  });

  container.appendChild(table);
  target.appendChild(container);
}
