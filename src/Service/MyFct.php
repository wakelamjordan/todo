<?php

namespace App\Service;

use Exception;

class MyFct
{
    public function generatePage($filePath, $variables = [])
    {
        // Lire le contenu du fichier
        $content = file_get_contents($filePath);

        if ($content === false) {
            throw new Exception("Le fichier ne peut pas être lu.");
        }

        // Remplacer les variables dans le contenu
        foreach ($variables as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }

        // Afficher le contenu avec les variables remplacées
        echo $content;
    }
}
