const username = document.getElementById('userName');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm_password');
const email = document.getElementById('userEmail');
const first_name = document.getElementById('firstName');

//validators
function validateUsername() {
    if(checkIfEmpty(username)) return;
    return true;
}
function validatePassword() {
    if(checkIfEmpty(password)) return;
    if(!meetLength(password, 4, 100)) return;
    //check password to have at least one uppercase letter, one lowercase letter and one number
    if(!containsCharacters(password, 1)) return;
    return true;
}
function validateConfirmPassword() {
    if(password.className !== 'demo-input-box'){
        setInvalid(confirmPassword, 'Password must be valid');
        return;
    }
    if(password.value !== confirmPassword.value) {
        setInvalid(confirmPassword, 'Passwords must match');
        return;
    } else {
        setValid(confirmPassword);
    }
    return true;
}
function validateEmail(){
    if(checkIfEmpty(email)) return;
    if(!containsCharacters(email, 2)) return;
    return true;
}
function validateFirstName() {
    if(!checkIfOnlyLetters(first_name)) return;
    return true;
}


//utility functions
function checkIfEmpty(field) {
    if(isEmpty(field.value.trim())){
        setInvalid(field, `${field.previousElementSibling.innerHTML} must not be empty`);
        return true;
    } else {
        setValid(field);
        return false;
    }
}

function isEmpty(value) {
    if(value === '') return true;
    return false;
}

function setInvalid(field, message){
    field.className = 'invalid';
    field.nextElementSibling.innerHTML = message;
}

function setValid(field){
    field.className = 'demo-input-box';
    field.nextElementSibling.innerHTML = '';
}

function checkIfOnlyLetters(field) {
    if(/^[a-zA-Z ]+$/.test(field.value)){
        setValid(field);
        return true;
    } else {
        setInvalid(field, `${field.previousElementSibling.innerHTML} must contain only letters`);
    }
}

function meetLength(field, minLength, maxLength) {
    if(field.value.length >= minLength && field.value.length < maxLength){
        setValid(field);
        return true;
    } else if(field.value.length < minLength) {
        setInvalid(field, `${field.previousElementSibling.innerHTML} must be at least ${minLength} characters long`);
        return false;
    } else {
        setInvalid(field, `${field.previousElementSibling.innerHTML} must be shorter than ${maxLength} characters`);
        return false;
    }
}

function containsCharacters(field, code) {
    let regEx;
    switch (code) {
        case 1:
            //password
            regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
            return matchWithRegEx(regEx, field, 'Must contain at least one uppercase letter, one lowercase letter and one number');
        case 2:
            //email
            regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return matchWithRegEx(regEx, field, 'Must be a valid email');
        default:
            return false;
    }

}

function matchWithRegEx(regEx, field, message) {
    if(field.value.match(regEx)){
        setValid(field);
        return true;
    } else {
        setInvalid(field, message);
        return false;
    }
}