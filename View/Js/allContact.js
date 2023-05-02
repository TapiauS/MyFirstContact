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
                    <a href="${element.id}">Plus d'info</button>
                </ul>
            </div>
        </div>`
        const button=document.querySelector('#'+element.id);
        console.log(button);
        button.addEventListener('click',()=>{
            fetch('/coursPHP/GestionnaireContact/allContactEndPoints.php?id='+element.id)
                .then(response=>response.json())
                .then(data => {
                data.forEach(element => {
                    console.log(element);
                    cards.innerHTML=
                    `<div class='col-6 col-md-3'>
                        <div class="card" style="width: 18rem;">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Nom:${element.firstname}</li>
                                <li class="list-group-item">Mail:${element.email}</li>
                                <li class="list-group-item">Phone Number:${element.phonenumber}</li>
                                <button id="${element.id}">Plus d'info</button>
                            </ul>
                        </div>
                    </div>`
                    });
                }
            )
        })
    });
  }
)
  .catch(error => {
    console.log(error);
  });