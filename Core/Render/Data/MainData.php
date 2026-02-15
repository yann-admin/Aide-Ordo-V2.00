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
		protected $MainMessage_;
		protected $Mainforms_;


	/* ▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅  copy and paste in the code  ▅ ▂ */


	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅  construct  ▅ ▂ */
		/* @ $objRenderData( $forms='') */
		public function __construct( $MainMessage='', $Mainforms='' ){
			$this -> MainMessage_ = $MainMessage;
			$this -> Mainforms_ = $Mainforms;

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
		public function setMainMessage($modifMessage){ $this -> MainMessage_ = trim($modifMessage); return $this; }
		public function setMainForms($modifForms){ $this -> Mainforms_ = trim($modifForms); return $this; }
		
	/* ▂ ▅  Getters  ▅ ▂ */
		/* Traitement lecture htmlspecialchars_decode() 'Convertir des entités HTML spéciales en caractères'  */
		/* ENT_COMPAT => Je vais convertir les guillemets doubles et laisser les guillemets simples intacts. */
		public function getMainMessage(){ return $this -> MainMessage_; }
		public function getMainForms(){ return $this -> Mainforms_; }

};

?>