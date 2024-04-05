const container = document.createElement("div");
container.classList.add("container", "mt-3");

const header = document.createElement("div");
header.classList.add("d-flex", "justify-content-between", "align-items-center");

const h2 = document.createElement("h2");
h2.textContent = "Toutes les promotions";
header.appendChild(h2);

const link = document.createElement("a");
link.href = "";
link.classList.add("btn", "btn-success", "font-weight-bold");
link.textContent = "Ajouter promotion";
header.appendChild(link);

container.appendChild(header);

const p = document.createElement("p");
p.textContent = "tableau des promotions de Simplon";
container.appendChild(p);

const table = document.createElement("table");
table.classList.add("table");

const promotions = [
    { name: "DWWM 3", start: "01-01-2024", end: "01-12-2024", places: 15 },
    { name: "DWWM 2", start: "01-01-2024", end: "01-12-2024", places: 15 },
    { name: "CDA", start: "01-01-2024", end: "01-12-2024", places: 12 },
    { name: "CDA list", start: "01-01-2024", end: "01-12-2024", places: 12 },
];

promotions.forEach(promotion => {
    const tr = document.createElement("tr");
    tr.classList.add("squareBullets");

    const tdName = document.createElement("td");
    tdName.textContent = promotion.name;
    tr.appendChild(tdName);

    const tdStart = document.createElement("td");
    tdStart.textContent = promotion.start;
    tr.appendChild(tdStart);

    const tdEnd = document.createElement("td");
    tdEnd.textContent = promotion.end;
    tr.appendChild(tdEnd);

    const tdPlaces = document.createElement("td");
    tdPlaces.textContent = promotion.places;
    tr.appendChild(tdPlaces);

    const tdActions = document.createElement("td");

    const actions = ["Voir", "Éditer", "Supprimer"];
    actions.forEach(action => {
        const a = document.createElement("a");
        a.classList.add("btn", "btn-sm");
        a.textContent = action;
        tdActions.appendChild(a);
    });

    tr.appendChild(tdActions);

    table.appendChild(tr);
});

container.appendChild(table);
document.body.appendChild(container);