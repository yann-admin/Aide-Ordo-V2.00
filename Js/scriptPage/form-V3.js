/*
MEMO:
    https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener

    WARNNING: On mobile, the change event doesn't work if parameters are passed. Known iOS and Android bug. 
*/

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import * as loader from "../module/loader.js";
import * as myModule from "../module/formModule-V3.js";

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑▲↑ */  

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ▂ ▅ ▆ █ START LOADER █ ▆ ▅ ▂ */
loader.startLoader(3000);

/*▂ ▅ ▆ █ CONSTANT CONSOLE █ ▆ ▅ ▂ */
const MODE_DEV = false;
if (MODE_DEV) console.clear();



/* ▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂ */


/* ▂ ▅ ▆ █ window.addEventListener █ ▆ ▅ ▂ */
window.addEventListener("load", () => {
/* For Bootstrap: */
/* Enable tooltips Bootstrap: */
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    
/* Step 1: We create function AddEventListener  */
myModule.createdAddEventListener();


});



/* ▂ ▅ ▆ █ STOP LOADER █ ▆ ▅ ▂ */
loader.stopLoader(500);

