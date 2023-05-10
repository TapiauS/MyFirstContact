const firstName=document.querySelector('#firstname');
const lastName=document.querySelector('#lastname');
const mail=document.querySelector('#mail');
const phoneNumber=document.querySelector('#phonenumber');
const birthDate=document.querySelector("#birthdate");
const submit=document.querySelector("#submit");
const picturepath=document.querySelector("#picture");
const image=document.querySelector("#picturedisplay");
let oldimagevalue;
const form=document.querySelector("form");

const nameRegex=/^([a-zA-Z\s]*)$/;
const mailRegex=/^\S+@\S+\.\S+$/;
const dateRegex=/^(?:\d{4}-\d{2}-\d{2})?$/;
const phoneRegex=/^(\+33[1-9]\d{8})?$/;

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
        oldimagevalue=data.picture;
        image.innerHTML=`<img src='Images/${oldimagevalue}'>`;
        birthDate.value=data.placeholder;
    });



picturepath.addEventListener('change',event=>{

    const file = event.target.files[0];
    const reader = new FileReader();
    reader.addEventListener('load', event => {
        image.innerHTML=`<img src='${event.target.result}'>`
    });
    reader.readAsDataURL(file);
});

form.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior
    const now = new Date();
    const date=new Date(birthDate.value);
    
    // Calculate the minimum and maximum dates
    const minDate = new Date(now.getFullYear() - 100, now.getMonth(), now.getDate());
    const maxDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    
    let success=nameRegex.test(firstName.value)&&nameRegex.test(lastName.value)&&mailRegex.test(mail.value)&&phoneRegex.test(phoneNumber.value)
        &&(birthDate.value===""||(date > minDate&&date < maxDate));

    if(success){
        HTMLFormElement.prototype.submit.call(form);
    }
    });


