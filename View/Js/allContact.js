const cards=document.querySelector('#cards');


fetch('/coursPHP/GestionnaireContact/allContactEndPoints.php')
  .then(response => response.json())
  .then(data => {
    data.forEach(element => {
        console.log(element);
        cards.innerHTML+=
        `<div class='col-12 col-sm-6 col-md-3'>
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nom:${element.firstname==null?"":element.firstname}</li>
                    <li class="list-group-item">Mail:${element.email}</li>
                    <li class="list-group-item">Phone Number:${element.phone==null?"":element.phone}</li>
                    <img src="Images/${element.picture}" alt="image de profil">
                    <a href="/coursPHP/GestionnaireContact/index.php?target=onecontact&id=${element.id}">Plus d'info</button>
                    <a href="/coursPHP/GestionnaireContact/index.php?target=updatecontact&id=${element.id}">Modifier contact</button>
                    <a href="/coursPHP/GestionnaireContact/index.php?target=deletecontact&id=${element.id}">Supprimer contact</button>
                </ul>
            </div>
        </div>`
    });
  }
)
  .catch(error => {
    console.log(error);
  });