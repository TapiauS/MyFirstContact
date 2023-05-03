const firstName=document.querySelector('#firstname');
const lastName=document.querySelector('#lastname');
const mail=document.querySelector('#mail');
const phoneNumber=document.querySelector('#phonenumber');
const birthDate=document.querySelector("#birthdate");
const submit=document.querySelector("#submit");
const form=document.querySelector("form");

const nameRegex=/^([a-zA-Z\s]*)$/;
const mailRegex=/^\S+@\S+\.\S+$/;
const dateRegex=/^(?:\d{4}-\d{2}-\d{2})?$/;
const phoneRegex=/^\+33[1-9]\d{8}$/;

const queryParams = new URLSearchParams(window.location.search);
const id = queryParams.get('id');

fetch('allContactEndPoints.php?id='+id)
    .then(response => response.json())
    .then(data=>{
        console.log(data);
        firstName.value=data.firstname;
        lastName.value=data.lastname;
        mail.value=data.email;
        phoneNumber.value=data.phone;
        birthDate.value=data.placeholder;
    });

form.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior
    const now = new Date();
    const date=new Date(birthDate.value);
    
    // Calculate the minimum and maximum dates
    const minDate = new Date(now.getFullYear() - 100, now.getMonth(), now.getDate());
    const maxDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    let success=nameRegex.test(firstName.value)&&nameRegex.test(lastName.value)&&mailRegex.test(mail.value)&&phoneRegex.test(phoneNumber.value)
        &&date > minDate &&date < maxDate;
        
    // send the form data to the server using an AJAX request
    if(success){
        const formData = new FormData(form);
        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .catch(error => {
            // handle any errors that occur during the request
        });
    }
    });


