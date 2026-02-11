<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
	/* Fichier class: RenderData via constructor_Class_Other.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
	namespace App\Core\RenderData;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
	# Class other
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class RenderData{
	/* ▂ ▅ Attributs ▅ ▂ */
		protected $ongletText_;
		protected $forms_;
		protected $scriptJs_;
		protected $sheetCss_;
		protected $data_;
		protected $other_;
	/* ▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅  copy and paste in the code  ▅ ▂ */
		# $objRenderDataModel = new RenderDataModel();
		# $objRenderData = new RenderData();
		# -  $objRenderData -> setOngletText($_POST['OngletText']);
		# -  $objRenderData -> setForms($_POST['Forms']);
		# -  $objRenderData -> setScriptJs($_POST['ScriptJs']);
		# -  $objRenderData -> setSheetCss($_POST['SheetCss']);
		# -  $objRenderData -> setData($_POST['Data']);
		# -  $objRenderData -> setOther($_POST['Other']);

		# -  $objRenderData -> getOngletText();
		# -  $objRenderData -> getForms();
		# -  $objRenderData -> getScriptJs();
		# -  $objRenderData -> getSheetCss();
		# -  $objRenderData -> getData();
		# -  $objRenderData -> getOther();

	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅  construct  ▅ ▂ */
		/* @ $objRenderData( $ongletText='', $forms='', $scriptJs='', $sheetCss='', $data='', $other='',  ) */
		public function __construct( $ongletText='', $forms='', $scriptJs='', $sheetCss='', $data='', $other='',  ){
			$this -> ongletText_ = $ongletText;
			$this -> forms_ = $forms;
			$this -> scriptJs_ = $scriptJs;
			$this -> sheetCss_ = $sheetCss;
			$this -> data_ = $data;
			$this -> other_ = $other;
		}


	/* ▂ ▅  hydrate()  ▅ ▂ */
		/* @ hydrate($donnees) */
		public function hydrate($donnees){
			foreach ($donnees as $attribut => $valeur){
				$methode = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
				if (is_callable(array($this, $methode))){
					$this->$methode($valeur);
				};
			}
		}

	/* ▂ ▅  read()  ▅ ▂ */
		/* @ read($donnees) */
		public function read($donnees){
			$arrayRead = array();
			foreach($donnees as $attribut){
				$methode = 'get'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
				if (is_callable(array($this, $methode))){
					$arrayRead[$attribut] = $this->$methode();
				};
			}
			return $arrayRead;
		}

	/* ▂ ▅  Setters  ▅ ▂ */
		/* Traitement faille XSS htmlspecialchars() 'Cette fonction retourne une chaîne avec ces Conversions réalisées.' */
		/* ENT_QUOTES => Convertira les deux citations doubles et simples. */
		private function setOngletText($modifOngletText){ $this -> ongletText_ = trim($modifOngletText); return $this; }
		private function setForms($modifForms){ $this -> forms_ = trim($modifForms); return $this; }
		private function setScriptJs($modifScriptJs){ $this -> scriptJs_ = trim($modifScriptJs); return $this; }
		private function setSheetCss($modifSheetCss){ $this -> sheetCss_ =trim($modifSheetCss); return $this; }
		private function setData($modifData){ $this -> data_ = trim($modifData); return $this; }
		private function setOther($modifOther){ $this -> other_ = trim($modifOther); return $this; }


	/* ▂ ▅  Getters  ▅ ▂ */
		/* Traitement lecture htmlspecialchars_decode() 'Convertir des entités HTML spéciales en caractères'  */
		/* ENT_COMPAT => Je vais convertir les guillemets doubles et laisser les guillemets simples intacts. */
		private function getOngletText(){ return $this -> ongletText_; }
		private function getForms(){ return $this -> forms_; }
		private function getScriptJs(){ return $this -> scriptJs_; }
		private function getSheetCss(){ return $this -> sheetCss_; }
		private function getData(){ return$this -> data_; }
		private function getOther(){ return $this -> other_; }


};

?>