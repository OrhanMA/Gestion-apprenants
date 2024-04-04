<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- <div class="pageContainer"> -->
        <!-- Ici injection du contenu (des "pages") avec Javascript -->
    <!-- </div> -->
    
    <div class="container mt-3">
        <h2>Toutes les promotions</h2>
        <p>tableau des promotions de Simplon</p>
        <div class="text-right mb-3">
            <a class="btn btn-primary">Ajouter promotion</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Promotion</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Places</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>DWWM 3</td>
                    <td>01-01-2024</td>
                    <td>01-12-2024</td>
                    <td>15</td>
                    <td>
                        <a class="btn btn-info btn-sm">Voir</a>
                        <a class="btn btn-warning btn-sm">Éditer</a>
                        <a class="btn btn-danger btn-sm">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script>
        const body = document.querySelector("body");
        const pageContainer = document.querySelector('.pageContainer');

        const welcomeForm1Data = [{
            type: "email",
            name: "email",
            placeholder: "mon-email@mail.com",
            classes: "form-label",
            id: 'email'
        }]

        createForm(welcomeForm1Data, "http://localhost:8888/Gestion-apprenants/public/auth/check_email", pageContainer);

        const inputsData = [{
                type: "text",
                name: "userName",
                placeholder: "Name",
                classes: "form-label",
                id: "userName",
            },
            {
                type: "email",
                name: "userEmail",
                placeholder: "Email",
                classes: "form-label",
                id: "userName",
            },
        ];

        function createForm(inputsData, action, target, id) {
            const form = document.createElement("form");
            form.action = action;
            form.method = "POST";
            form.classList.add("mb-3");

            inputsData.forEach((inputData) => {
                const label = document.createElement('label');
                label.for = inputData.name;
                label.textContent = inputData.name + "*";
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
            buttonSubmit.value = "Submit";
            buttonSubmit.classList.add("btn", "btn-primary");
            form.appendChild(buttonSubmit);

            target.appendChild(form);
        }
    </script> -->
    <!-- <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        form {
            background-color: #f8f9fa;
            padding: 80px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
    </style> -->
</body>

</html>