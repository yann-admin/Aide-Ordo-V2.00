/* ▂ ▅  ????????????????????  ▅ ▂ */
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
/* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
// export { ARRAY_OBJ_FORMS };
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ▂ ▅ ▆ █ CONSTANT CONSOLE █ ▆ ▅ ▂ */
    const MODE_DEV = true;
//if (MODE_DEV) console.clear();
    
/* ▂ ▅ ▆ █ HANDLE ACTION BUTTONS (delete, update, etc.) █ ▆ ▅ ▂ */
export async function fetchActionBtn(event) {
     /* Step 1: Variables */
    event.preventDefault();
    let thisBtn = event.currentTarget;
    let thisUrl = thisBtn.getAttribute('data-url');
    try {
        /* Step 2: Prepare fetch options */
        let fetchOptions = {
            method: "POST",
            credentials: "include",
            headers: {
                "Content-Type": "application/json",
                Accept: "text/html, application/xhtml+xml, application/xml",
                Accept: "php/json"
            },
            body: '{}',
        };
        /* Step 3: We verify response and return response as Json */
        let responsePostData = await fetch(thisUrl, fetchOptions);
        if (MODE_DEV) { console.log('responsePostData: ', responsePostData); };

       /* Step 4: We verify response status */
        if (!responsePostData.ok) {
            /* Step 4.1: We get response text */
            let responseText = await responsePostData.text();
            /* Step 4.2: We log error */
            console.error(`Error! status: ${responsePostData.status}`, responseText);
            /* Step 4.3: We throw error */
            throw new Error(`Error! status: ${responsePostData.status}`);
        } else {
            /* Step 4.4: We get response as Json */
            let response = await responsePostData.json();
            if (MODE_DEV) { console.log("Sending JSON data to:", thisUrl, responsePostData); }
            //let div = response.div;
            let elementDiv = document.getElementById(response.div);
            let status = response.status;
            let msg = response.msg;
            let data = response.data;
            let redirect = response.redirect;

            if (msg != '') { elementDiv.innerHTML = msg; } else { elementDiv.innerHTML = ''; };
            if (status == true) { 
                if (data != '') { };
                
                if (redirect != '') {
                    setTimeout(() => {  
                    window.location.href = redirect;
                    }, 3000); 
                };
                
                if(MODE_DEV) { console.log("response: ", status, div, msg, data, redirect); }
            };       

        };




    } catch (error) {
        console.error('Error:', error);
    }
};
