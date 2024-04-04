<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <h1>Titre de la page</h1>
    <p class="descriptionParagraph">Sous-titre de la page</p>
    <div class="pageContainer">
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
    <script src="./../src/scripts/form.js"></script>
</body>

</html>