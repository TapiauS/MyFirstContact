const queryParams = new URLSearchParams(window.location.search);
const id = queryParams.get('id');
const card=document.querySelector('#card');

fetch('allContactEndPoints.php?id='+id)
  .then(response => response.json())
  .then(data => {
    data.forEach(element => {
        console.log(element);
        card.innerHTML+=
        `<div class='col-6 col-md-3'>
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nom:${element.firstname}</li>
                    <li class="list-group-item">Mail:${element.email}</li>
                    <li class="list-group-item">Phone Number:${element.phonenumber}</li>
                </ul>
            </div>
        </div>`
    });
  }
)
  .catch(error => {
    console.log(error);
  });