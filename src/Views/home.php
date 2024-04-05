<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex flex-column">
    <h1>Titre de la page</h1>
    <p class="descriptionParagraph">Sous-titre de la page</p>
    <div class="pageContainer">
        <!-- Ici injection du contenu (des "pages") avec Javascript -->
    </div>
    <!-- <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Toutes les promotions</h2>
            <a href="" class="btn btn-success font-weight-bold">Ajouter promotion</a>
        </div>
        <p>tableau des promotions de Simplon</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Promotion</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Places</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr class="squareBullets table-header">
                    <td>DWWM 3</td>
                    <td>01-01-2024</td>
                    <td>01-12-2024</td>
                    <td>15</td>
                    <td>
                        <a class="btn btn-sm">Voir</a>
                        <a class="btn btn-sm">Éditer</a>
                        <a class="btn btn-sm">Supprimer</a>
                    </td>
                </tr>
                <tr class="squareBullets">
                    <td>DWWM 2</td>
                    <td>01-01-2024</td>
                    <td>01-12-2024</td>
                    <td>15</td>
                    <td>
                        <a class="btn btn-sm">Voir</a>
                        <a class="btn btn-sm">Éditer</a>
                        <a class="btn btn-sm">Supprimer</a>
                    </td>
                </tr>
                <tr class="squareBullets">
                    <td>CDA</td>
                    <td>01-01-2024</td>
                    <td>01-12-2024</td>
                    <td>12</td>
                    <td>
                        <a class="btn btn-sm">Voir</a>
                        <a class="btn btn-sm">Éditer</a>
                        <a class="btn btn-sm">Supprimer</a>
                    </td>    
                </tr>
                <tr class="squareBullets">
                    <td>CDA list</td>
                    <td>01-01-2024</td>
                    <td>01-12-2024</td>
                    <td>12</td>
                    <td>
                        <a class="btn btn-sm">Voir</a>
                        <a class="btn btn-sm">Éditer</a>
                        <a class="btn btn-sm">Supprimer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> -->

    <!-- <div class="container mt-5">
        <h2 class="mb-3">Création d'une promotion</h2>
        <form>
            <div class="form-group mb-3">
                <label for="nomPromotion">Nom de la promotion</label>
                <input type="text" class="form-control" id="nomPromotion" placeholder="Entrez le nom de la promotion">
            </div>
            <div class="form-group mb-3">
                <label for="dateDebut">Date de début</label>
                <input type="date" class="form-control" id="dateDebut">
            </div>
            <div class="form-group mb-3">
                <label for="dateFin">Date de fin</label>
                <input type="date" class="form-control" id="dateFin">
            </div>
            <div class="form-group mb-3">
                <label for="placesDisponibles">Place(s) disponible(s)</label>
                <input type="number" class="form-control" id="placesDisponibles" placeholder="Nombre de places disponibles">
            </div>
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </form>
    </div> -->

    <!-- <div class="container mt-5">
        <h2>Édition de la promotion DWWM3</h2>
        <p>Les changements appliqués sont définitifs</p>
        <form>
            <div class="form-group mb-3">
                <label for="nomPromotion">Nom de la promotion</label>
                <input type="text" class="form-control" id="nomPromotion" value="DWWM3">
            </div>
            <div class="form-group mb-3">
                <label for="dateDebut">Date de début</label>
                <input type="date" class="form-control" id="dateDebut" value="2024-01-01">
            </div>
            <div class="form-group mb-3">
                <label for="dateFin">Date de fin</label>
                <input type="date" class="form-control" id="dateFin" value="2024-12-01">
            </div>
            <div class="form-group mb-3">
                <label for="placesDisponibles">Place(s) disponible(s)</label>
                <input type="number" class="form-control" id="placesDisponibles" value="15">
            </div>
            <div class="form-group mb-3">
                <button type="button" class="btn btn-danger">Supprimer</button>
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
        </form>
    </div> -->
    <script type="module" src="./../src/scripts/form.js"></script>
    <!-- <script type="module" src="./../src/scripts/promotionCreate.js"></script> 
    <script type="module" src="./../src/scripts/promotionList.js"></script>
    <script type="module" src="./../src/scripts/promotionUpdate.js"></script> -->
</body>

</html>