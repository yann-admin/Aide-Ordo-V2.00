/*
MEMO:
    https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener
*/
/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import { startLoader, stopLoader } from "../module/loader.js";
import Form from "../Classes/Form.js";
import { resetError } from "../module/formModuleV2.js";
import { handleFormSubmit } from "../module/submitForm.js";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */



// /* ▂ ▅  Recup var for CSS App\css\color.css ▅ ▂ */
//     // Get the root element
//     const css = document.querySelector( ':root' );
//     // Get the styles for the root
//     const style = getComputedStyle( css );
//     Exemple:
//     input.style.backgroundColor = style.getPropertyValue('--INVALID_BACKGROUND');
// /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

// / DEBUG /
// if(MODE_DEV)console.log("Log in: addEventListener ");
// if(MODE_DEV)console.log(objForm);
// if(MODE_DEV)console.log(' ' + );
// if(MODE_DEV)console.log("***********************************************");


/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import { functionUser, RESPONCE_AJAX} from "";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */
/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
export var RESPONCE_AJAX;
export function functionUser() { }
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */
/* ▂ ▅  CONSTANT  ▅ ▂ */
const MODE_DEV = true;

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂ */
/* ▂ ▅ ▆ █ Grafcet █ ▆ ▅ ▂ 
    Step 1 ▂ ▅ ▆ █ START LOADER █ ▆ ▅ ▂

    Step 2 ▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂

    Step 3 ▂ ▅ ▆ █ window.addEventListener █ ▆ ▅ ▂
        ╚ step 3.1 Initialize the form (  )
        ╚ step 3.2 For Bootstrap: Enable tooltips Bootstrap
        ╚ step 3.3 earphone construction event: listenBtnRest
        ╚ step 3.4 earphone construction event: listenSubmitForm

    Step 10 ▂ ▅ ▆ █ STOP LOADER █ ▆ ▅ ▂

    Step debug ▂ ▅ ▆ █ DEBUG █ ▆ ▅ ▂

*/

/* Step 1: ▂ ▅ ▆ █ START LOADER █ ▆ ▅ ▂ */
    startLoader(3000); 
    
/*Step 2 ▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂ */

/* Step 3 ▂ ▅ ▆ █ window.addEventListener █ ▆ ▅ ▂ */
    window.addEventListener("load", () => {
        /* Step 3.1: Initialize the form */
        /* @ function module formModule.js */
        // initForms();  
        
        /* Step 3.2: For Bootstrap: */
        /* For Bootstrap: */
            /* Enable tooltips Bootstrap: */
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        /* -------------- */

            /* Step 3.3 earphone construction event: listenBtnRest */
            listenBtnRest([ (MY_FORM.falseBtn_.id) ], resetError); /* @ function resetError module formModule.js  */
            function listenBtnRest(ids, callback) {
                ids.forEach(id => document.getElementById(id).addEventListener('click', (event) => callback(event)));
            };
        /* ------------------------------------ */
    
        /* Step 3.4: earphone construction event: listenSubmitForm */
            listenSubmitForm([ (MY_FORM.submitBtn_.id)] , handleFormSubmit);/* @ function handleFormSubmit module submitForm.js  */
            function listenSubmitForm(id, callback) {
                
                form.addEventListener("submit", function (event) { callback(event) }, true);
            };
        /* ------------------------------------ */
    });


/* Step 4 ▂ ▅ ▆ █ FunctionListeningInput █ ▆ ▅ ▂ */
    function FunctionListeningInput(ids, callback){
        ids.forEach(id => document.getElementById(id).addEventListener("click", () => callback(id)));
    };


/* Step 5 ▂ ▅ ▆ █ functionUser █ ▆ ▅ ▂ */
    function functionUser() { };


/* Step 10 ▂ ▅ ▆ █ STOP LOADER █ ▆ ▅ ▂ */
    stopLoader(500);

/* Step debug ▂ ▅ ▆ █ DEBUG █ ▆ ▅ ▂ */
if (MODE_DEV) console.log(HEADER_CONSOLE_LOG);
if (MODE_DEV) console.log(MY_FORM);
if (MODE_DEV) console.log(FOOTER_CONSOLE_LOG);
