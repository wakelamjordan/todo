<?php

namespace App\Controller;

use App\Model\Task;
use App\Model\TaskManager;
use App\Service\MyFct;
use Exception;

class IndexController extends MyFct
{
    private $manager;

    public function __construct()
    {
        // Initialisation de l'objet TaskManager
        $this->manager = new TaskManager();

        // Récupération de l'action depuis la requête GET
        $action = '';

        // Extraction des variables de la requête GET
        extract($_GET);

        try {
            // Gestion des actions basées sur le paramètre 'action'
            switch ($action) {
                case 'find':
                    $this->openOne(); // Ouvre un élément spécifique
                    break;
                case 'edit':
                    $this->edit(); // Édite un élément
                    break;
                case 'new':
                    $this->new(); // Crée un nouvel élément
                    break;
                case 'delete':
                    $this->delete(); // Supprime un élément
                    break;
                case 'list':
                    $this->todoList(); // Affiche la liste des éléments
                    break;
                default:
                    $this->index(); // Page d'accueil par défaut
            }
        } catch (Exception $e) {
            // Gestion des exceptions et affichage du message d'erreur
            echo "Erreur : " . $e->getMessage();
        }
    }

    /**
     * Affiche la page d'accueil
     */
    public function index()
    {
        $this->generatePage('../src/View/base.html.php');
    }

    /**
     * Affiche la liste des tâches
     */
    public function todoList()
    {
        // Obtenir tous les éléments de la liste
        $tasks = $this->manager->readAll();

        // Définir le type de contenu de la réponse comme JSON
        header('Content-Type: application/json');

        // Convertir les données en JSON et les envoyer en réponse
        echo json_encode($tasks);
    }

    public function openOne()
    {
        // Vérifie si l'ID est présent et si c'est un entier valide
        if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
            throw new Exception('Tâche non valide');
        }

        // Récupère l'ID
        $id = (int)$_GET['id'];

        // Affiche l'ID
        $result = $this->manager->readOne($id);

        if (!$result) {
            throw new Exception('Tâche non trouvée');
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        // Autres opérations que tu veux faire avec l'ID ici
    }

    public function edit()
    {
        $form = $_POST;

        $form['id'] = intval($_GET['id']);

        if (!$form) {
            throw new Exception('Tâche non valide');
        }

        $task = new Task($form);

        $result = $this->manager->update($task);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function new()
    {
        $form = $_POST;

        if (!$form) {
            throw new Exception('Tâche non valide');
        }

        $task = new Task($form);

        $result = $this->manager->create($task);

        header('Content-Type: application/json');

        echo json_encode($result);
    }

    public function delete()
    {
        $id = $_GET['id'];


        if (!$id) {
            throw new Exception('Tâche non valide');
        }

        $task = new Task(['id' => $id]);

        $this->manager->delete($task);
    }
}
