<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
	/* Fichier class: RenderData via constructor_Class_Other.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
	namespace App\Core\Render\Data;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
	# Class other
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class MainData{
	/* ▂ ▅ Attributs ▅ ▂ */
		protected $mainText_;
		protected $mainforms_;
		protected $mainData_;
		protected $mainModales_;
	/* ▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅  copy and paste in the code  ▅ ▂ */


	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅  construct  ▅ ▂ */
		/* @ $objRenderData( $forms='') */
		public function __construct( $mainText='', $mainforms='', $mainData='', $mainModales='' ){
			$this -> mainText_ = $mainText;
			$this -> mainforms_ = $mainforms;
			$this -> mainData_ = $mainData;
			$this -> mainModales_ = $mainModales;

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
		public function setMainText($modifText){ $this -> mainText_ = trim($modifText); return $this; }
		public function setMainForms($modifForms){ $this -> mainforms_ = trim($modifForms); return $this; }
		public function setMainData($modifData){ $this -> mainData_ = $modifData; return $this; }
		public function setMainModales($modifModales){ $this -> mainModales_ = $modifModales; return $this; }

	/* ▂ ▅  Getters  ▅ ▂ */
		/* Traitement lecture htmlspecialchars_decode() 'Convertir des entités HTML spéciales en caractères'  */
		/* ENT_COMPAT => Je vais convertir les guillemets doubles et laisser les guillemets simples intacts. */
		public function getMainText(){ return $this -> mainText_; }
		public function getMainForms(){ return $this -> mainforms_; }
		public function getMainData(){ return $this -> mainData_; }
		public function getMainModales(){ return $this -> mainModales_; }

};

?>