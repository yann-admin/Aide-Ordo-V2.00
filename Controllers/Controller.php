<?php
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        #namespace=Nom du projet \ nom du dossier
        namespace App\Controllers;    
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        abstract class Controller{
            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

                /* ▂ ▅ ▆ █ render(string $patch, array $data = []) █ ▆ ▅ ▂ */
                    public function render(string $patch, array $data = []){
                        # Permet d'extraire les données récupérées sous forme de variables
                        extract($data);
                        # on créer le buffer de sortie:
                        ob_start();
                        # Créer le chemin et inclut le fichier de la vue souhaitée
                        include dirname(__DIR__). '/Views/' . $patch . '.php';
                        # On Vide le buffer dans la variable $title et $content
                        $content = ob_get_clean();
                        # On fabrique le "template"
                        include dirname(__DIR__) .'/Views/base.php';
                    }
               /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */    
            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
        };  
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>