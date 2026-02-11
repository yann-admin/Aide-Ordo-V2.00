/* ▂ ▅  ????????????????????  ▅ ▂ */
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
/* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import * as loader from "./loader.js";
import { MYFORM } from "./formModule-V3.js";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
// export { ARRAY_OBJ_FORMS };
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ▂ ▅ ▆ █ CONSTANT CONSOLE █ ▆ ▅ ▂ */
    const MODE_DEV = true;
    //if (MODE_DEV) console.clear();



/* ▂ ▅ ▆ █ HANDLE FORM SUBMIT █ ▆ ▅ ▂ */
export async function handleFormSubmit(event) {
    loader.startLoader(3000);
    event.preventDefault();    
    let thisForm = event.currentTarget.form;
    let thisUrl = thisForm.action;
    /* 
    Note: Only valid form fields are included in a FormData object, i.e. those that have a name (name attribute), are not disabled and are checked (radio buttons and checkboxes) or selected (one or more options in a selection).
    */
 
    /* Step 1: We create object Formdata */
    let formData = new FormData(thisForm);
    /* Step 2: We add button to formData  */
    let button = thisForm.querySelectorAll('button');
    Array.from(button).forEach(button => {
        formData.append(button.id, button.value);
    });
    /* Step3: Submit formData as Json the url */
    try {
        let objData = Object.fromEntries(formData.entries());
        let objDataJsonString = JSON.stringify(objData);
        /* Step 3.1: Prepare fetch options */
        let fetchOptions = {
            method: "POST",
            credentials: "include",
            headers: {  
                "Content-Type": "application/json",
                Accept: "text/html, application/xhtml+xml, application/xml",
                Accept: "php/json"
            },
            body: objDataJsonString,
        };
        /* Step 3.2: We verify response and return response as Json */
        let responsePostData = await fetch(thisUrl, fetchOptions);
        if (MODE_DEV) { console.log('responsePostData: ', responsePostData); };
       /* Step 3.3: We verify response status */
        if (!responsePostData.ok) {
            /* Step 3.3.1: We get response text */
            let responseText = await responsePostData.text();
            /* Step 3.3.2: We log error */
            console.error(`Error! status: ${responsePostData.status}`, responseText);
            /* Step 3.3.3: We throw error */
            throw new Error(`Error! status: ${responsePostData.status}`);
        } else {
            /* Step 3.4: We get response as Json */
            let response = await responsePostData.json();
            if (MODE_DEV) { console.log("Sending JSON data to:", thisUrl, objDataJsonString, responsePostData); }
            //let div = response.div;
            let elementDiv = document.getElementById(response.div);
            let status = response.status;
            let msg = response.msg;
            let data = response.data;
            let redirect = response.redirect;

            if (msg != '') { elementDiv.innerHTML = msg; } else { elementDiv.innerHTML = ''; };
            if (status == true) { 
                if (data != '') {  };
                if (redirect != '') { window.location.href = redirect; };
                
                if(MODE_DEV) { console.log("response: ", status, div, msg, data, redirect); }
            };



        };
       

       
       
        
       
       
       
       

    } catch (error) {
            console.error(error.message);
    };

    loader.stopLoader(300);
};



