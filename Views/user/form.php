<?php
	/* ▂ ▅ ▆ █ Variables █ ▆ ▅ ▂ */
if(isset($HeadData)){
  $dataHead = $HeadData->read(['author_','keywords_','description_','shortcutIcon_']);
  $authorMeta = (isset($dataHead['author_']) ? $dataHead['author_'] : "Author En Dev");
  $keywordsMeta = (isset($dataHead['keywords_']) ? $dataHead['keywords_'] : "Keywords En Dev");
  $descriptionMeta = (isset($dataHead['description_']) ? $dataHead['description_'] : "Description En Dev");
  $shortcutIcon = (isset($dataHead['shortcutIcon_']) ? $dataHead['shortcutIcon_'] : "");
};

if(isset($FooterData)){
  $dataFooter = $FooterData->read(['textFooter_','otherFooter_']);
  $footerText = (isset($dataFooter['textFooter_']) ? $dataFooter['textFooter_'] : "FooterText En Dev");
  $footerOther = (isset($dataFooter['otherFooter_']) ? $dataFooter['otherFooter_'] : "FooterOther En Dev");
};

if(isset($RenderData)){
  $dataRender = $RenderData->read(['forms_','other_','scriptJs_','sheetCss_', 'ongletText_']);
  $form = (isset($dataRender['forms_']) ? $dataRender['forms_'] : "Forms En Dev");
  $scriptJs = (isset($dataRender['scriptJs_']) ? $dataRender['scriptJs_'] : "ScriptJs En Dev");
  $sheetCss = (isset($dataRender['sheetCss_']) ? $dataRender['sheetCss_'] : "SheetCss En Dev");
  $data = (isset($dataRender['data_']) ? $dataRender['data_'] : "Data En Dev");
  $other = (isset($dataRender['other_']) ? $dataRender['other_'] : "");
  $titleOnglet = (isset($dataRender['ongletText_']) ? $dataRender['ongletText_'] : "OngletText En Dev");
};

/* ▂ ▅ ▆ █ HTML █ ▆ ▅ ▂ */
?>

<div class=" d-flex justify-content-center " > 
  <div id="Msg-body" class="col-10 col-sm-5 col-lg-3 mt-3 mb-3"> <?= nl2br($other) ?> </div>
</div>   
    
<!-- Add form -->
<?= $form; ?>      


	