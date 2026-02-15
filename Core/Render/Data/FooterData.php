<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
	/* Fichier class: FooterData via constructor_Class_Other.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
	namespace App\Core\Render\Data;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
	# Class other
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class FooterData{
	/* ▂ ▅ Attributs ▅ ▂ */
		protected $textFooter_;
		protected $otherFooter_;
	/* ▂▂▂▂▂▂▂▂▂▂▂ */


	/* ▂ ▅  construct  ▅ ▂ */
		/* @ $objFooterData( $textFooter='', $otherFooter='',  ) */
		public function __construct( $textFooter='', $otherFooter='',  ){
			$this -> textFooter_ = "Développée par MT-Dev";
			$this -> otherFooter_ = $otherFooter;

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
		public function setTextFooter($modifTextFooter){ $this -> textFooter_ = trim($modifTextFooter); return $this; }
		public function setOtherFooter($modifOtherFooter){ $this -> otherFooter_ = trim($modifOtherFooter); return $this; }


	/* ▂ ▅  Getters  ▅ ▂ */
		/* Traitement lecture htmlspecialchars_decode() 'Convertir des entités HTML spéciales en caractères'  */
		/* ENT_COMPAT => Je vais convertir les guillemets doubles et laisser les guillemets simples intacts. */
		public function getTextFooter(){ return $this -> textFooter_; }
		public function getOtherFooter(){ return $this -> otherFooter_; }


};

?>