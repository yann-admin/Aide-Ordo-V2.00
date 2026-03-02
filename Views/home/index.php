<?php
/* ▂ ▅ ▆ █ Variables █ ▆ ▅ ▂ */

if(isset($mainData)){
    $mainMessage = $mainData -> getMainText();
    $mainforms = $mainData -> getMainForms();
    $mainModale = $mainData -> getMainModales();
    $mainData = $mainData -> getMainData();
}

/* ▂ ▅ ▆ █ HTML █ ▆ ▅ ▂ */
?>
<!-- HTML -->  
<div class=" d-flex justify-content-center " > 
    <div id="Msg-body" class="col-10 col-sm-5 col-lg-3 mt-3 mb-3"> <?= nl2br($mainMessage) ?> </div>
</div> 