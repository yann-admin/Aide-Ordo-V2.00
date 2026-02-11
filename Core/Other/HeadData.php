<?php
	/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
		/* Fichier class: headData via constructor_Class_Other.php VERSION: 3.0.0*/ 
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

	/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
		namespace App\Core\Other;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

	/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
		# Class other
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

	/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
	class HeadData{
		/* ▂ ▅ Attributs ▅ ▂ */
			protected $author_;
			protected $keywords_;
			protected $description_;
			private $shortcutIcon_;
		/* ▂▂▂▂▂▂▂▂▂▂▂ */

		/* ▂ ▅  copy and paste in the code  ▅ ▂ */
			# $objHeadDataModel = new HeadDataModel();
			# $objHeadData = new HeadData();
			# -  $objHeadData -> setAuthor($_POST['Author']);
			# -  $objHeadData -> setKeywords($_POST['Keywords']);
			# -  $objHeadData -> setDescription($_POST['Description']);

			# -  $objHeadData -> getAuthor();
			# -  $objHeadData -> getKeywords();
			# -  $objHeadData -> getDescription();

		/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

		/* ▂ ▅  construct  ▅ ▂ */
			/* @ $objHeadData( $author='', $keywords='', $description='',  ) */
			public function __construct( $author='', $keywords='', $description='',  ){
				$this -> author_ = "MT-Dev: Yann MARTIN";
				$this -> keywords_ = "Aide ordonnancement, Assistance ordonnancement, Support ordonnancement, ordonnancement, MT-Dev, Yann MARTIN";
				$this -> description_ = "Plateforme d'assistance et de support pour les utilisateurs de ordonnancement";
				$this -> shortcutIcon_ = "App/Images/LogoChichoune50x50.png";
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
			public function setAuthor($modifAuthor){ $this -> author_ = htmlspecialchars(trim($modifAuthor), ENT_QUOTES); return $this; }
			public function setKeywords($modifKeywords){ $this -> keywords_ = htmlspecialchars(trim($modifKeywords), ENT_QUOTES); return $this; }
			public function setDescription($modifDescription){ $this -> description_ = htmlspecialchars(trim($modifDescription), ENT_QUOTES); return $this; }
			public function setShortcutIcon($modifShortcutIcon){ $this -> shortcutIcon_ = htmlspecialchars(trim($modifShortcutIcon), ENT_QUOTES); return $this; }

		/* ▂ ▅  Getters  ▅ ▂ */
			/* Traitement lecture htmlspecialchars_decode() 'Convertir des entités HTML spéciales en caractères'  */
			/* ENT_COMPAT => Je vais convertir les guillemets doubles et laisser les guillemets simples intacts. */
			public function getAuthor(){ return htmlspecialchars_decode($this -> author_, ENT_COMPAT); }
			public function getKeywords(){ return htmlspecialchars_decode($this -> keywords_, ENT_COMPAT); }
			public function getDescription(){ return htmlspecialchars_decode($this -> description_, ENT_COMPAT); }
			public function getShortcutIcon(){ return htmlspecialchars_decode($this -> shortcutIcon_, ENT_COMPAT); }
				
	};
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>