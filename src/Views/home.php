<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1 id="titre">Ouais</h1>
    <style>
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
    </style>
    <script>
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
        const inputsData = [{
                type: "text",
                name: "userName",
                placeholder: "Name",
                classe: "form-label",
                id: "userName",
            },
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
    </script>
</body>

</html>