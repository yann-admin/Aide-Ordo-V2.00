/*
MEMO:
    https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener
*/

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import * as fieldVerify from "../Common/fieldVerify.js";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ▂ ▅ ▆ █ CONSTANT CONSOLE █ ▆ ▅ ▂ */
const MODE_DEV = true;
if (MODE_DEV) console.clear();
const MY_MODALE = document.getElementById('modal');
const modalTitle = MY_MODALE.querySelector('.modal-title');
const modalMsg = MY_MODALE.querySelector('#modal-msg');
const modalBody = MY_MODALE.querySelector('#modal-body-content');
const modalFooter = MY_MODALE.querySelector('.modal-footer');
const modalBtnSubmit = MY_MODALE.querySelector('#submit-btn');
const modalBtnBack = MY_MODALE.querySelector('#back-btn');
const imageModale = MY_MODALE.querySelector('#modal-image');
const modaleButtonsContainer = MY_MODALE.querySelector('#modal-buttons');

export async function functionToCallOnModalOpen(event) {

    let url = event.currentTarget.getAttribute('data-url');
    let fetchOptions = {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        credentials: "include",
        headers: {
            "Content-Type": "application/json",
            Accept: "text/html, application/xhtml+xml, application/xml",
            Accept: "php/json"
        },
        redirect: "follow",
        referrerPolicy: "no-referrer",
        body: '{}',
    };
    try {
        let responsePostData = await fetch(url, fetchOptions);
        let response = await responsePostData.json();
        if (MODE_DEV) console.log(`Response from server: ${response}`);
        if (responsePostData.ok) {
            // Assuming the response is HTML content to be injected into the modal
            if (response.id) {MY_MODALE.setAttribute('id', response.id)}else{MY_MODALE.setAttribute('id','modal')}; ;
            if (response.title) {modalTitle.textContent = response.title} else {modalTitle.textContent = "EN DEVELOPPEMENT"};
            if (response.msg) { modalMsg.textContent = response.msg } else { modalMsg.textContent = "EN DEVELOPPEMENT" };
            if (response.image) { imageModale.setAttribute('src', response.image) } else { imageModale.removeAttribute('src') };
            if (response.bodyContent) {modalBody.innerHTML = response.bodyContent} else {modalBody.innerHTML = "<p>EN DEVELOPPEMENT</p>"};
            if (response.buttons['btnSave'] || response.buttons['btnCancel'] || response.buttons['btnClose']) {
                modaleButtonsContainer.innerHTML = ""; // Clear existing buttons
                for (const [key, buttonHTML] of Object.entries(response.buttons)) {
                    if (buttonHTML) {
                        modaleButtonsContainer.innerHTML += buttonHTML; // Append each button to the container
                    };
                };
            }else {
                modaleButtonsContainer.innerHTML = "<p>EN DEVELOPPEMENT</p>";
            };

 
            /* Reattach event listeners to the new buttons in the modal */
            const newBtnSubmit = MY_MODALE.querySelector('#submit-btn');
            const newBtnBack = MY_MODALE.querySelector('#back-btn');
            const newBtnCancel = MY_MODALE.querySelector('#cancel-btn');
            const formInModal = MY_MODALE.querySelector('form'); // Assuming there's a form in the modal

            /* Enabled buttons and set attributes based on response */
            if (response.modeDelete) { newBtnSubmit.disabled = false; } else { newBtnSubmit.disabled = true; };

            /* Earphone construction event: blur */
            document.addEventListener('blur', function (event) { fieldVerify.validityField(event, newBtnSubmit) }, true);

            /* For tooltip */
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

            document.getElementById('submit-btn')?.addEventListener('click', function() {
                if (MODE_DEV) console.log(`Submit button in modal clicked`);
                handleFormSubmit(formInModal);
            });

            document.getElementById('back-btn')?.addEventListener('click', function() {
                if (MODE_DEV) console.log(`Back button in modal clicked`);
                //window.history.back(); // Example: Go back to the previous page
                window.location.href = newBtnBack.getAttribute('data-url'); // Example: Redirect to a specific URL
            }); 
            document.getElementById('cancel-btn')?.addEventListener('click', function() {
                if (MODE_DEV) console.log(`Cancel button in modal clicked`);
            });

        } else {
            
        };

    }catch (error) {
        
    };


    if (MODE_DEV) console.log(`URL to load in modal: ${url}`);
};

async function handleFormSubmit(formInModal) {

    const form = formInModal; // Get the form element that was submitted
    const formData = new FormData(form); // Create a FormData object from the form
    const formAction = form.getAttribute('action'); // Get the form's action URL
    const newBtnBack = MY_MODALE.querySelector('#back-btn');
    const newBtnCancel = MY_MODALE.querySelector('#cancel-btn');

    try {
        let objData = Object.fromEntries(formData.entries());
        let objDataJsonString = JSON.stringify(objData);
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
        let responsePostData = await fetch(formAction, fetchOptions);
        let response = await responsePostData.json();
        
        

        if (MODE_DEV) console.log(`Response from server on form submit: ${response}`);

        if (responsePostData.ok) {
            if (response.msg) { modalMsg.innerHTML = response.msg } else { modalMsg.innerHTML = "" };
            if (response.redirectUrl!='' && response.error===false) { newBtnBack.setAttribute('data-url', response.redirectUrl) } else { newBtnBack.setAttribute('data-url', '#') };
            // Handle successful response, e.g., show a success message, update the UI, etc.
            if (MODE_DEV) console.log(`Form submitted successfully. Server response: ${response}`);
        } else {
            // Handle error response, e.g., show an error message
            if (MODE_DEV) console.error(`Failed to submit form. Status: ${responsePostData.status}`);
        }
    } catch (error) {
        if (MODE_DEV) console.error(`Error submitting form: ${error}`);
    }
};