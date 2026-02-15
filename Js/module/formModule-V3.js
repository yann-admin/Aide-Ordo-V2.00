/*
MEMO:
    https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener
*/

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import Form from "../Classes/classForm-V3.js";
import { handleFormSubmit } from "./submitForm-V3.js";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */


/* ▂ ▅ ▆ █ Grafcet █ ▆ ▅ ▂ 

    ▂ ▅ ▆ █ CONSTANT CONSOLE █ ▆ ▅ ▂

    ▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂

    ▂ ▅ ▆ █ CREATED ADDEVENTLISTENER █ ▆ ▅ ▂
        ╚ step 1: earphone construction event: blur
        ╚ step 2: Button 
        ╚ step 3: Picto Eye 
        ╚ step 4: earphone construction event: change

    ▂ ▅ ▆ █ FUNCTION LISTEN SUBMIT BTN █ ▆ ▅ ▂

    ▂ ▅ ▆ █ FUNCTION LISTEN BTN BACK █ ▆ ▅ ▂
        ╚ Step 1 We get url in data-url attribute of button and we redirect to this url

    ▂ ▅ ▆ █ FUNCTION TOGGLE PASSWORD VISIBILITY █ ▆ ▅ ▂
        ╚ Step 1 We test type input password => change type to text and change picto eye, else we change type to password and change picto eye



    ▂ ▅ ▆ █ FUNCTION VALIDITY FIELD █ ▆ ▅ ▂
        ╚ step 1: We test if field form is input or field form classList does not include "validate" => return
            ╚ If Step 2 We search error.validity
                ╚ Else Step 3 if no error we reset error message and style of field
        ╚ Step 4 We call function read input required and disabled submit button if form is not valid

    ▂ ▅ ▆ █ FUNCTION HAS ERROR █ ▆ ▅ ▂
        ╚ step 1: We test type of field => return
        ╚ step 2: We statement variable validity of field
        ╚ step 3: We test validity, if valid => return
        ╚ step 4: We test validity.valueMissing => return error type and message
        ╚ step 5: We test validity.typeMismatch => return error type and message
        ╚ step 6: We test validity.patternMismatch => return error type and message
        ╚ step 7: We test validity.tooLong => return error type and message
        ╚ step 8: We test validity.tooShort => return error type and message
        ╚ step 9: We test validity.badInput => return error type and message
        ╚ step 10: We test validity.stepMismatch => return error type and message
        ╚ step 11: We test validity.rangeOverflow => return error type and message
        ╚ step 12: We test validity.rangeUnderflow => return error type and message
        ╚ step 13: We return error type and message unknownError

    ▂ ▅ ▆ █ FUNCTION SHOW ERROR █ ▆ ▅ ▂

    ▂ ▅ ▆ █ FUNCTION RESET ERROR █ ▆ ▅ ▂


    ▂ ▅ ▆ █ FUNCTION LOOP INPUT VALIDITY █ ▆ ▅ ▂
        ╚ Step 1 We loop over input form and test validity of each input, if one is not valid we disabled submit button

    ▂ ▅ ▆ █ FUNCTION COMPARE VALUE █ ▆ ▅ ▂
        ╚ Step 1 We test value field1 == field2
            ╚ If Step 2 We Show error.message
                ╚ Else Step 3 if no error we reset error message and style of field

    ▂ ▅ ▆ █ FUNCTION INIT FORM █ ▆ ▅ ▂


    ▂ ▅ ▆ █ FUNCTION DISABLED BTN SUBMIT █ ▆ ▅ ▂


    ▂ ▅ ▆ █ FUNCTION RESET FORM █ ▆ ▅ ▂


*/



/* ▂ ▅ ▆ █ CONSTANT CONSOLE █ ▆ ▅ ▂ */
const MODE_DEV = false;
if (MODE_DEV) console.clear();


/* ▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂ */
// Step 1: We create an object of the class Form
/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
export const MYFORM = new Form(document.querySelectorAll('.validate'));
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */
const BTN_SUBMIT = MYFORM.buttons_.find(button => button.name == "submit");
const BTN_BACK = MYFORM.buttons_.find(button => button.name == "back");
const BTN_DELETE = MYFORM.buttons_.find(button => button.name == "delete");
let inhibitSubmit = false;
if (MODE_DEV) console.log('MYFORM: ', MYFORM);  



/* ▂ ▅ ▆ █ FUNCTION CREATED ADDEVENTLISTENER █ ▆ ▅ ▂ */
export function createdAddEventListener() {
    /* Step 1: earphone construction event: blur */
    document.addEventListener('blur', function (event) { validityField(event) }, true);

    /* Step 2: Button  */
    if (MYFORM.buttons_ != undefined) {
        MYFORM.buttons_.forEach(button => {
            if (button.name == "back") {
                button.addEventListener("click", listenBtnBack);
            } else if (button.name == "submit") {
                button.addEventListener("click", listenBtnSubmit);
                button.disabled = true;
            };
           if(button.name == "delete") { button.addEventListener("click", listenBtnDelete);};
        });
    };

    /* Step 3: Picto Eye */
    if (MYFORM.pictoEye_ != undefined) {
        MYFORM.pictoEye_.forEach(picto => {
            picto.addEventListener("click", togglePasswordVisibility);
            if(MODE_DEV) console.log("togglePasswordVisibility added to pictoEye" + picto.id);
        });
    };

    /* Step 4: earphone construction event: change */
    if (MYFORM.inputs_ != undefined) {
        let fieldPasswordExist = false;
        let fieldConfirmPasswordExist = false;
        let fieldPassword;
        let fieldConfirmPassword;
        MYFORM.inputs_.forEach(input => {
            if (input.name == "password") { fieldPasswordExist = true; fieldPassword = input; };
            if (input.name == "confirmPassword") { fieldConfirmPasswordExist = true; fieldConfirmPassword = input; };
        });

        if (fieldPasswordExist && fieldConfirmPasswordExist) {
            fieldPassword.addEventListener("change", compareValue);
            fieldConfirmPassword.addEventListener("change", compareValue);
        };  

        if (MODE_DEV) console.log("fieldPasswordExist: " + fieldPasswordExist);
        if (MODE_DEV) console.log("fieldConfirmPasswordExist: " + fieldConfirmPasswordExist);
    };

};
/* ▂ ▅ ▆ █ FUNCTION LISTEN SUBMIT BTN █ ▆ ▅ ▂ */
function listenBtnSubmit(event) {
    /* Step 1 We prevent default behavior of submit button */
    event.preventDefault();
    /* Step 2 We call function handleFormSubmit and we pass event as parameter */
    handleFormSubmit(event);/* @ function handleFormSubmit module submitForm.js  */
    if (MODE_DEV) console.log("Submit button clicked");
};

/* ▂ ▅ ▆ █ FUNCTION LISTEN BTN BACK █ ▆ ▅ ▂ */
function listenBtnBack(event) {
    event.preventDefault();
    if (MODE_DEV) console.log("Back button clicked");
    /* Step 1 We get url in data-url attribute of button and we redirect to this url */
    window.location.href = BTN_BACK.getAttribute('data-url');
};

/* ▂ ▅ ▆ █ FUNCTION LISTEN BTN DELETE █ ▆ ▅ ▂ */
function listenBtnDelete(event) {
    event.preventDefault();
    if (MODE_DEV) console.log("Delete button clicked");
    /* Step 1 We get url in data-url attribute of button and we redirect to this url */
    window.location.href = BTN_DELETE.getAttribute('data-url');
};

/* ▂ ▅ ▆ █ FUNCTION TOGGLE PASSWORD VISIBILITY █ ▆ ▅ ▂ */
function togglePasswordVisibility(event) {
    var target = event.currentTarget;
    var input = target.parentNode.querySelector('input');
    /* Step 1 We test type input password => change type to text and change picto eye, else we change type to password and change picto eye */
    if (input.type === "password") {
        input.type = "text";
        target.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        target.style.color = "#ff0000";
    } else {
        input.type = "password";
        target.innerHTML = '<i class="fa-solid fa-eye"></i>';
        target.style.color = "#212529";
    };
};

/* ▂ ▅ ▆ █ FUNCTION VALIDITY FIELD █ ▆ ▅ ▂ */
function validityField(e) {
    let field = e.target; 
    if(field.form==null){return;};
    /* Step 1 We test if field form is input or field form classList does not include "validate" => return */
    if ( !field.form.className.includes('validate') ) { return; };

    /* Step 2 We search error.validity  */
    let error = hasError(field);
    /* Step 3 We Show error.message  */
    if (error) {
        showError(field, error.message); 
    } else {
        /* Step 3 if no error we reset error message and style of field */
        resetErrorField(field);        
    };

    /* Step 4 We call function read input required and disabled submit button if form is not valid */
    loopInputValidity(); 

    if (MODE_DEV) {if (error) {console.log((error.type ? 'type:' + error.type : '') + " " + (error.message ? 'message:' + error.message : '') + " " + (error.pattern ? 'pattern: ' + error.pattern : ''));}};   
};

/* ▂ ▅ ▆ █ FUNCTION HAS ERROR █ ▆ ▅ ▂ */
var hasError = function (field) {
    /* Step 1 We test type of field => return */
    if (field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') { return; };

    /* Step 2 We statement variable validity of field */
    var validity = field.validity;
 
    /* Step 3 We test validity, if valid => return */
    if (validity.valid) { return; };

    /* Step 4 We test validity.valueMissing => return error type and message */
    if (validity.valueMissing) { return { type: 'valueMissing', message: 'Veuillez remplir le champ s\'il vous plaît' }; };
    /* Step 5 We test validity.typeMismatch => return error type and message */
    if (validity.typeMismatch) {
        if (field.type === 'email'){
        return { type: 'typeMismatch', message: 'Veuillez entrer une adresse email valide s\'il vous plaît' };
        };
        if (field.type === 'url') {
        return { type: 'typeMismatch', message: 'Veuillez entrer une adresse URL valide s\'il vous plaît' };
        };
    };
    /* Step 6 We test validity.patternMismatch => return error type and message */
    if (validity.patternMismatch) {
        if (field.hasAttribute('title') && field.getAttribute('title') != "") {
            return { type: 'patternMismatch', message: field.getAttribute('title') };
        } else {
            return {pattern:field.pattern , type: 'patternMismatch', message: 'Veuillez respecter le format du champ s\'il vous plaît' };
        };
    };
    /* Step 7 We test validity.tooLong => return error type and message */
    if (validity.tooLong) { return { type: 'tooLong', message: 'Le champ doit comporter au maximum ' + field.maxLength + ' caractères.' + ' Vous utilisez actuellement ' + field.value.length + ' caractères.' }; }
    /* Step 8 We test validity.tooShort => return error type and message */
    if (validity.tooShort) { return { type: 'tooShort', message: 'Le champ doit comporter au minimum ' + field.minLength + ' caractères.' + ' Vous utilisez actuellement ' + field.value.length + ' caractères.' }; }
    /* Step 9 We test validity.badInput => return error type and message */
    if (validity.badInput) { return { type: 'badInput', message: 'Veuillez entrer un nombre valide pour le champ s\'il vous plaît' }; }
    /* Step 10 We test validity.stepMismatch => return error type and message */
    if (validity.stepMismatch) { return { type: 'stepMismatch', message: 'Veuillez entrer une valeur avec un pas ' + field.step +' pour le champ s\'il vous plaît' }; }
    /*  Step 11 WE test validity.rangeOverflow => return error type and message */
    if (validity.rangeOverflow) { return { type: 'rangeOverflow', message: 'Veuillez entrer une valeur inférieure ou égale à ' + field.max + ' pour le champ s\'il vous plaît' }; }
    /* Step 12 We test validity.rangeUnderflow => return error type and message */
    if (validity.rangeUnderflow) { return { type: 'rangeUnderflow', message: 'Veuillez entrer une valeur supérieure ou égale à ' + field.min + ' pour le champ s\'il vous plaît' }; }
    /* Step 13 We return error type and message unknownError */
    return { type: 'unknownError', message: 'Le champ ' + field.name + ' est invalide.' };
};

/* ▂ ▅ ▆ █ FUNCTION SHOW ERROR █ ▆ ▅ ▂ */
function showError(field, error) {
    /* We search element with class .invalid-feedback in field parentNode */
    Array.from(MYFORM.feedback_).forEach(element =>  {
        if (element.id == `feedback-${field.id}`) {
            element.innerHTML = error;
            element.classList.add('is-invalid');
            element.classList.remove('is-valid');
        }
    });
    /* We add class is-invalid bootstrap and remove class is-valid bootstrap to field */
    field.classList.add('is-invalid');
    field.classList.remove('is-valid');
};

/* ▂ ▅ ▆ █ FUNCTION RESET ERROR █ ▆ ▅ ▂ */
function resetErrorField(field) {
    /* We search element with class .invalid-feedback in field parentNode */
    Array.from(MYFORM.feedback_).forEach(element =>  {
        if (element.id == `feedback-${field.id}`) {
            element.innerHTML = '';
            element.classList.remove('is-invalid');
            element.classList.add('is-valid');
        }
    });
    /* We reset class is-invalid bootstrap and add class is-valid bootstrap to field */
    field.classList.remove('is-invalid');
    field.classList.add('is-valid');
};

/* ▂ ▅ ▆ █ FUNCTION LOOP INPUT VALIDITY █ ▆ ▅ ▂ */
function loopInputValidity( ) {
    let lengthInput = MYFORM.inputs_.length;
    if(MODE_DEV) { console.log(`lengthInput: ${lengthInput}`);}
    /* Step 1 We loop over input form and test validity of each input, if one is not valid we disabled submit button */
    Array.from(MYFORM.inputs_).forEach(input => {
        if (input.hasAttribute('function') && input.getAttribute('function') == "data-security") {
            lengthInput--;
        } else {
            if (input.validity.valid) { lengthInput--; };
        };
    });
    if (lengthInput == 0 && !inhibitSubmit) { BTN_SUBMIT.disabled = false; } else { BTN_SUBMIT.disabled = true; };  
    if(MODE_DEV) { console.log(`lengthInput: ${lengthInput}`);}
};

/* ▂ ▅ ▆ █ FUNCTION COMPARE VALUE █ ▆ ▅ ▂ */
function compareValue() {
    let field1 = document.getElementById('password');
    let field2 = document.getElementById('confirmPassword');
    /* Step 1 We test value field1 == field2 */
    let div =document.getElementById('Msg-form');
    if ((field1.value != field2.value) && (field1.value != "" && field2.value != "")) {
        /* Step 2 We Show error.message  */
        div.innerHTML = '<p class="alert alert-danger mb-2 p-0" role="alert"> Les mots de passe ne correspondent pas </p>';
        field1.classList.add('is-invalid');
        field1.classList.remove('is-valid');
        field2.classList.add('is-invalid');
        field2.classList.remove('is-valid');
        inhibitSubmit = true;
    } else {
        /* Step 3 if no error we reset error message and style of field */
        div.innerHTML = '';
        field1.classList.remove('is-invalid');
        field1.classList.add('is-valid');
        field2.classList.remove('is-invalid');
        field2.classList.add('is-valid');
        inhibitSubmit = false;
    };
};

/* ▂ ▅ ▆ █ FUNCTION INIT FORM █ ▆ ▅ ▂ */
 function initForm(form) {
    // /* Loop over them and prevent submission form class .needs-validation */
    form[0].addEventListener('submit', function (event) {
        if (!form[0].checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            //form[0].classList.add('was-validated');
        };
    }, false);


    /* Add attribute novalidate to form */
    /* Step 1 We add attribute novalidate to form to disable browser validation and use our custom validation */
    for (let i = 0; i < form.length; i++) {
        form[i].setAttribute('novalidate', 'novalidate');
    };

};

/* ▂ ▅ ▆ █ FUNCTION DISABLED BTN SUBMIT █ ▆ ▅ ▂ */
 function disabledBtnSubmit(form, submitBtn) {
    /* Step 1 We disabled submit button if form is not valid */
        if (form[0].getAttribute('novalidate')=='novalidate' ) {
            submitBtn.disabled = true;
        } else {
            submitBtn.disabled = false;
    };

};

/* ▂ ▅ ▆ █ FUNCTION RESET FORM █ ▆ ▅ ▂ */
 function resetForm(obj_form) {
    var input = obj_form.inputs_;
    var pictoEye = obj_form.pictoEye_;
    /* Step 1 Loop in obj_form.inputs_ and reset value */
    Array.from(input).forEach(input => {
        /* if input function is not data-security: reset input. */
        if (!input.hasAttribute('function') || input.getAttribute('function') !== "data-security") {
            /* If input is type text, email, password, select, textarea: reset value. */
            if (input.type === "text" || input.type === "email" || input.type === "password" || input.tagName.toLowerCase() === "select" || input.tagName.toLowerCase() === "textarea") {
                input.value = "";
            }
            /* If input is type radio or checkbox: reset checked. */
            else if (input.type === "radio" || input.type === "checkbox") {
                input.checked = false;
            };
            input.classList.remove('is-invalid');
            input.classList.remove('is-valid');
        };
    });
    /* Step 2 Loop in obj_form.pictoEye_ and reset <i></i> */
    Array.from(pictoEye).forEach(element => {
        element.innerHTML = '<i class="fa-solid fa-eye"></i>';
        element.style.color = "#212529";
    });
    /* Step 3 We reset error message and style of field */
    Array.from(OBJ_FORM.feedback_).forEach(element => {
        element.innerHTML = '';
        element.classList.remove('is-invalid');
        element.classList.remove('is-valid');
    });
};







