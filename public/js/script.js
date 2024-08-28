const openModal = document.getElementById("openModal");
const formModal = document.getElementById("formModal");
const modalClose = document.querySelector(".btn-close");

const inputTitle = document.getElementById("title");
const inputDescription = document.getElementById("description");
const radioStatu = document.querySelector("input[type=radio][value='0']");

/**
 * Répartit les tâches dans les listes correspondantes en fonction de leur statut.
 * 
 * @param {Array} taskList - Liste des tâches à traiter.
 */
function dispatchTask(taskList) {
  // Création des tableaux pour chaque statut de tâche
  let todo = [];    // Tâches à faire
  let current = []; // Tâches en cours
  let done = [];    // Tâches terminées

  // Récupération des éléments DOM pour chaque liste de tâches
  let listTodo = document.getElementById("listTodo");
  let listCurrent = document.getElementById("listCurrent");
  let listDone = document.getElementById("listDone");

  // Parcours de toutes les tâches
  for (let i = 0; i < taskList.length; i++) {
    let item = taskList[i];

    // Répartition des tâches en fonction de leur statut
    switch (item.no) {
      case 0:
        todo.push(item); // Ajout à la liste des tâches à faire
        break;
      case 1:
        current.push(item); // Ajout à la liste des tâches en cours
        break;
      case 2:
        done.push(item); // Ajout à la liste des tâches terminées
        break;
    }
  }

  // Conversion des tableaux de tâches en HTML
  let todoHtml = elementsTodoList(todo);
  let currentHtml = elementsTodoList(current);
  let doneHtml = elementsTodoList(done);

  // Mise à jour du contenu HTML des listes
  listTodo.innerHTML = todoHtml;
  listCurrent.innerHTML = currentHtml;
  listDone.innerHTML = doneHtml;
}

function newTask() {
  // let openModal = document.getElementById("openModal");
  // let formModal = document.getElementById("formModal");

  // let inputTitle = document.getElementById("title");
  // let inputDescription = document.getElementById("description");
  // let radioStatu = document.querySelector("input[type=radio][value='0']");

  inputTitle.value = "";
  inputDescription.value = "";
  radioStatu.checked = true;

  formModal.action = "http://127.0.0.1/todo_php/public/?action=new";

  openModal.click();
}

function deleteItem(id) {
  // Code JavaScript à exécuter lors du clic sur le bouton
  let ok = confirm("Confirmez la suppression de la tâche id " + id);

  if (ok) {
    var xhr = new XMLHttpRequest();
    var urlDelete = "http://127.0.0.1/todo_php/public/?action=delete&id=" + id;
    // var data = JSON.stringify({
    //   id: id,
    // });

    // Configurer la requête POST
    xhr.open("POST", urlDelete, true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    // Fonction de rappel lorsque la requête est terminée
    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 300) {
        // La requête a réussi, traiter la réponse
        // console.log("Réponse reçue : ", xhr.responseText);
        getTasks("http://127.0.0.1/todo_php/public/?action=list");
      } else {
        // La requête a échoué, afficher l'erreur
        console.error("Erreur : ", xhr.statusText);
      }
    };

    // Fonction de rappel en cas d'erreur
    xhr.onerror = function () {
      console.error("Erreur de requête : ", xhr.statusText);
    };

    // Envoyer les données avec la requête
    xhr.send();
  }
}

function elementsTodoList(list) {
  let element = "";

  for (let i = 0; i < list.length; i++) {
    let task = list[i];

    element += `
    <div class="card text-black position-relative">
        <div class="card-header"onclick="findOneTask(${task.id})">
            ${task.title}
        </div>
            <div class="position-sticky bottom-100 text-end">
                <div class="gap-2">
                    <button
                        type="button"
                        name=""
                        id=""
                        class="btn btn-danger"
                        onclick="deleteItem(${task.id})">
                        <i
                            class="fas fa-trash-can"></i>
                    </button>
                </div>
            </div>
        <div class="card-body" onclick="findOneTask(${task.id})">
            <blockquote class="blockquote mb-0">
                <p>
                    ${task.description}
                </p>
            </blockquote>
        </div>
    </div>
    `;
  }
  return element;
}

function setDataTaskInForm(dataTask) {
  // let formModal = document.getElementById("formModal");

  // let inputTitle = document.getElementById("title");
  // let inputDescription = document.getElementById("description");
  let radioStatus = document.querySelectorAll("input[type=radio]");

  inputTitle.value = dataTask.title;
  inputDescription.value = dataTask.description;

  for (let i = 0; i < radioStatus.length; i++) {
    let value = radioStatus[i].value;

    if (parseInt(value) === dataTask.no) {
      radioStatus[i].checked = true;

      break;
    }
  }
}

function getTasks(url) {
  // Créer une nouvelle instance de XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Configurer la requête GET
  xhr.open("GET", url, true);

  // Définir ce qui se passe lorsque la requête est terminée
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      // La requête a réussi, traiter la réponse
      var response = JSON.parse(xhr.responseText);
      dispatchTask(response);
    } else {
      // La requête a échoué, afficher l'erreur
      console.error("Erreur : ", xhr.statusText);
    }
  };

  // Définir ce qui se passe en cas d'erreur
  xhr.onerror = function () {
    console.error("Erreur de requête : ", xhr.statusText);
  };

  // Envoyer la requête
  xhr.send();
}

function findOneTask(id) {
  // Créer une nouvelle instance de XMLHttpRequest
  var xhr = new XMLHttpRequest();

  let urlOneTask = "http://127.0.0.1/todo_php/public/?action=find&id=" + id;

  formModal.action = "http://127.0.0.1/todo_php/public/?action=edit&id=" + id;

  // Configurer la requête GET
  xhr.open("GET", urlOneTask, true);

  // Définir ce qui se passe lorsque la requête est terminée
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      // La requête a réussi, traiter la réponse
      var response = JSON.parse(xhr.responseText);
      setDataTaskInForm(response);
      openModal.click();
    } else {
      // La requête a échoué, afficher l'erreur
      console.error("Erreur : ", xhr.statusText);
    }
  };

  // Définir ce qui se passe en cas d'erreur
  xhr.onerror = function () {
    console.error("Erreur de requête : ", xhr.statusText);
  };

  // Envoyer la requête
  xhr.send();
}

// function editTask(id) {
//   console.log(formModal);
//   // formModal.action = "http://127.0.0.1/todo_php/public/?action=edit&id=" + id;
// }

getTasks("http://127.0.0.1/todo_php/public/?action=list");

formModal.addEventListener("submit", (e) => {
  e.preventDefault(); // Empêche l'envoi du formulaire classique

  // Créer un objet FormData à partir du formulaire
  let formData = new FormData(formModal);

  let url = formModal.action;

  // console.log(url);

  // return;

  // Créer une requête AJAX
  let xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);

  // Définir une fonction de rappel pour traiter la réponse
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      let data = JSON.parse(xhr.response);

      console.log("je passe");

      getTasks("http://127.0.0.1/todo_php/public/?action=list");

      modalClose.click();

      // Traiter la réponse ici
    } else {
      console.error("Erreur :", xhr.statusText);
    }
  };

  // Envoyer les données du formulaire
  xhr.send(formData);
});
