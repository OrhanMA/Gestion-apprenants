
<?php

// Définition d'un trait `Response`.
trait Response
{
    /**
     * Définition de la méthode render avec deux paramètres :
     * - $view (le nom de la vue à rendre).
     * - $data (les données à passer à la vue, optionnel).
     */
    public function render($view, $data = null)
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                // Crée une variable dynamique avec le nom de la clé et lui assigne la valeur correspondante.
                // Par exemple, si $data est ['titre' => 'Mon Titre'], cela crée une variable `$titre` avec la valeur 'Mon Titre'.
                ${$key} = $value;
            }
        }

        // print_r(__DIR__ . '/../Views/' . $view . ".php");
        // Inclut le fichier de la vue spécifiée par le paramètre $view
        include_once __DIR__ . '/../Views/' . $view . ".php";
    }
}
