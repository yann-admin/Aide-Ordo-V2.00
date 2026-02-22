<?php
/* ▂ ▅ ▆ █ Variables █ ▆ ▅ ▂ */

if(isset($objMainData)){
    $mainMessage = $objMainData -> getMainText();
    $mainforms = $objMainData -> getMainForms();
    $mainModale = $objMainData -> getMainModales();
    $mainData = $objMainData -> getMainData();
};

/* ▂ ▅ ▆ █ HTML █ ▆ ▅ ▂ */
?>
<!-- HTML -->  
<div class=" d-flex justify-content-center " > 
    <div id="Msg-body" class="col-10 col-sm-5 col-lg-3 mt-3 mb-3"> <?= nl2br($mainMessage) ?> </div>
</div> 