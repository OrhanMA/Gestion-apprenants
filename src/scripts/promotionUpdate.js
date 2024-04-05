export function promotionUpdate(target) {
  const container = document.createElement("div");
  container.classList.add("container", "mt-5");

  const h2 = document.createElement("h2");
  h2.textContent = "Édition de la promotion DWWM3";
  container.appendChild(h2);

  const p = document.createElement("p");
  p.textContent = "Les changements appliqués sont définitifs";
  container.appendChild(p);

  const form = document.createElement("form");

  const formGroups = [
    {
      id: "nomPromotion",
      label: "Nom de la promotion",
      type: "text",
      value: "DWWM3",
    },
    {
      id: "dateDebut",
      label: "Date de début",
      type: "date",
      value: "2024-01-01",
    },
    { id: "dateFin", label: "Date de fin", type: "date", value: "2024-12-01" },
    {
      id: "placesDisponibles",
      label: "Place(s) disponible(s)",
      type: "number",
      value: "15",
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

  const buttonSave = document.createElement("button");
  buttonSave.type = "submit";
  buttonSave.classList.add("btn", "btn-primary");
  buttonSave.textContent = "Sauvegarder";
  div.appendChild(buttonSave);

  form.appendChild(div);
  container.appendChild(form);
  target.appendChild(container);
}
