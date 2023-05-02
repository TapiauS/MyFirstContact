const cards=document.querySelector('#cards');


fetch('/coursPHP/GestionnaireContact/allContactEndPoints.php')
  .then(response => response.json())
  .then(data => {
    data.forEach(element => {
        console.log(element);
        cards.innerHTML+=
        `<div class='col-6 col-md-3'>
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nom:${element.firstname}</li>
                    <li class="list-group-item">Mail:${element.email}</li>
                    <li class="list-group-item">Phone Number:${element.phonenumber}</li>
                    <a href="/coursPHP/GestionnaireContact/oneContactController?id=${element.id}">Plus d'info</button>
                </ul>
            </div>
        </div>`
    });
  }
)
  .catch(error => {
    console.log(error);
  });