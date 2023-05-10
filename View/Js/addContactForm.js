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
const phoneRegex=/^(\+33[1-9]\d{8})?$/;


form.addEventListener('submit', event => {
    event.preventDefault(); // prevent the default form submission behavior
    const now = new Date();
    const date=new Date(birthDate.value);
    
  // Calculate the minimum and maximum dates
    const minDate = new Date(now.getFullYear() - 100, now.getMonth(), now.getDate());
    const maxDate = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    let success=nameRegex.test(firstName.value)&&nameRegex.test(lastName.value)&&mailRegex.test(mail.value)&&phoneRegex.test(phoneNumber.value)
        &&(birthDate.value===""||(date > minDate&&date < maxDate));
        
    console.log("phone "+phoneRegex.test(phoneNumber.value));
    console.log("date "+date);
    console.log("mail "+mailRegex.test(mail.value));
    console.log((birthDate.value===""||(date > minDate&&date < maxDate)));
    console.log(success);
    console.log(form);
    // send the form data to the server using an AJAX request
    if(success){
      HTMLFormElement.prototype.submit.call(form);
    }
  });