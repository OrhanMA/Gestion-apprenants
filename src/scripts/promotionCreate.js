const container = document.createElement("div");
container.classList.add("container", "mt-5");

const h2 = document.createElement("h2");
h2.classList.add("mb-3");
h2.textContent = "Création d'une promotion";
container.appendChild(h2);

const form = document.createElement("form");

const formGroups = [
    { id: "nomPromotion", label: "Nom de la promotion", type: "text", placeholder: "Entrez le nom de la promotion" },
    { id: "dateDebut", label: "Date de début", type: "date" },
    { id: "dateFin", label: "Date de fin", type: "date" },
    { id: "placesDisponibles", label: "Place(s) disponible(s)", type: "number", placeholder: "Nombre de places disponibles" },
];

formGroups.forEach(group => {
    const div = document.createElement("div");
    div.classList.add("form-group", "mb-3");

    const label = document.createElement("label");
    label.htmlFor = group.id;
    label.textContent = group.label;
    div.appendChild(label);

    const input = document.createElement("input");
    input.type = group.type;
    input.classList.add("form-control");
    input.id = group.id;
    if (group.placeholder) {
        input.placeholder = group.placeholder;
    }
    div.appendChild(input);

    form.appendChild(div);
});

const button = document.createElement("button");
button.type = "submit";
button.classList.add("btn", "btn-primary");
button.textContent = "Sauvegarder";
form.appendChild(button);

container.appendChild(form);
document.body.appendChild(container);