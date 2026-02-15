<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
	/* Fichier class: headData via constructor_Class_Other.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
	namespace App\Core\Render\Data;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
	# Class other
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class HeadData{
	/* ▂ ▅ Attributs ▅ ▂ */
		protected $textOnglet_;
		protected $author_;
		protected $keywords_;
		protected $description_;
		protected $shortcutIcon_;
		protected $baseCss_;
		protected $sheetCss_;
		protected $scriptJs_;
		
	/* ▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅  copy and paste in the code  ▅ ▂ */


	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

	/* ▂ ▅  construct  ▅ ▂ */
		/* @ $objHeadData( $author='', $keywords='', $description='',  ) */
		public function __construct( $textOnglet='', $author='', $keywords='', $description='', $shortcutIcon='', $baseCss='', $sheetCss='', $scriptJs='' ){
			$this -> textOnglet_ = "Aide-Ordo";
			$this -> author_ = "MT-Dev: Yann MARTIN";
			$this -> keywords_ = "Aide ordonnancement, Assistance ordonnancement, Support ordonnancement, ordonnancement, MT-Dev, Yann MARTIN";
			$this -> description_ = "Plateforme d'assistance et de support pour les utilisateurs de ordonnancement";
			$this -> shortcutIcon_ = "App/Images/LogoChichoune50x50.png";
			$this -> baseCss_ = "App/Css/base.css";
			$this -> sheetCss_ = "";
			$this -> scriptJs_ = "";
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
		public function setTextOnglet($modifTextOnglet){ $this -> textOnglet_ = trim($modifTextOnglet); return $this; }
		public function setAuthor($modifAuthor){ $this -> author_ = trim($modifAuthor); return $this; }
		public function setKeywords($modifKeywords){ $this -> keywords_ = trim($modifKeywords); return $this; }
		public function setDescription($modifDescription){ $this -> description_ = trim($modifDescription); return $this; }
		public function setShortcutIcon($modifShortcutIcon){ $this -> shortcutIcon_ = trim($modifShortcutIcon); return $this; }
		public function setBaseCss($modifBaseCss){ $this -> baseCss_ = trim($modifBaseCss); return $this; }
		public function setSheetCss($modifSheetCss){ $this -> sheetCss_ = trim($modifSheetCss); return $this; }
		public function setScriptJs($modifScriptJs){ $this -> scriptJs_ = trim($modifScriptJs); return $this; }

	/* ▂ ▅  Getters  ▅ ▂ */
		/* Traitement lecture htmlspecialchars_decode() 'Convertir des entités HTML spéciales en caractères'  */
		/* ENT_COMPAT => Je vais convertir les guillemets doubles et laisser les guillemets simples intacts. */
		public function getTextOnglet(){ return $this -> textOnglet_; }
		public function getAuthor(){ return $this -> author_; }
		public function getKeywords(){ return $this -> keywords_; }
		public function getDescription(){ return $this -> description_; }
		public function getShortcutIcon(){ return $this -> shortcutIcon_; }
		public function getBaseCss(){ return $this -> baseCss_; }
		public function getSheetCss(){ return $this -> sheetCss_; }
		public function getScriptJs(){ return $this -> scriptJs_; }
			
};
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>