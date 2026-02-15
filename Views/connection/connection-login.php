<?php
/* ▂ ▅ ▆ █ Variables █ ▆ ▅ ▂ */

if(isset($objMainData)){
    $MainMessage = $objMainData -> getMainMessage();
    $Mainforms = $objMainData -> getMainForms();
};

/* ▂ ▅ ▆ █ HTML █ ▆ ▅ ▂ */
?>
<!-- HTML -->  
<div class=" d-flex justify-content-center " > 
    <div id="Msg-body" class="col-10 col-sm-5 col-lg-3 mt-3 mb-3"> <?= nl2br($MainMessage) ?> </div>
</div>    
    
<!-- Add form -->
<?= $Mainforms; ?>      


	