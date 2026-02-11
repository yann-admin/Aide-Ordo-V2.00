<?php
	/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
		/* Fichier class: FooterData via constructor_Class_Other.php VERSION: 3.0.0*/ 
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

	/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
		namespace App\Core\Other;
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

		/* ▂ ▅  copy and paste in the code  ▅ ▂ */
			# $objFooterDataModel = new FooterDataModel();
			# $objFooterData = new FooterData();
			# -  $objFooterData -> setTextFooter($_POST['TextFooter']);
			# -  $objFooterData -> setOtherFooter($_POST['OtherFooter']);

			# -  $objFooterData -> getTextFooter();
			# -  $objFooterData -> getOtherFooter();

		/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

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
			public function setTextFooter($modifTextFooter){ $this -> textFooter_ = htmlspecialchars(trim($modifTextFooter), ENT_QUOTES); return $this; }
			public function setOtherFooter($modifOtherFooter){ $this -> otherFooter_ = htmlspecialchars(trim($modifOtherFooter), ENT_QUOTES); return $this; }


		/* ▂ ▅  Getters  ▅ ▂ */
			/* Traitement lecture htmlspecialchars_decode() 'Convertir des entités HTML spéciales en caractères'  */
			/* ENT_COMPAT => Je vais convertir les guillemets doubles et laisser les guillemets simples intacts. */
			public function getTextFooter(){ return htmlspecialchars_decode($this -> textFooter_, ENT_COMPAT); }
			public function getOtherFooter(){ return htmlspecialchars_decode($this -> otherFooter_, ENT_COMPAT); }


	};

?>