
const queryParams = new URLSearchParams(window.location.search);
const id = queryParams.get('id');
const card=document.querySelector('#card');



fetch('allContactEndPoints.php?id='+id)
  .then(response => response.json())
  .then(data => {
    card.innerHTML+=
    `<div class='col-6 col-md-3'>
        <div class="card" style="width: 18rem;">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Nom:${data.firstname}</li>
                <li class="list-group-item">Mail:${data.email}</li>
                <li class="list-group-item">Phone Number:${data.phonenumber}</li>
                <img src="Images/${data.picture}" alt="image de profil">
            </ul>
        </div>
    </div>`
    })
  .catch(error => {
    console.log(error);
  });