<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier entities database: api_chichoune - table: useraccount via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Entities\User;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    use PDO;
    use Exception;
    
    # Class other

    error_reporting(E_ALL);
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class User{
    /* ▂ ▅ Attributs ▅ ▂ */
        # Attributs database useraccount
        private $idUserAccount_;
        private $userName_;
        private $userFirstName_;
        private $userEmail_;
        private $userRecoveryCode_;
        private $userAccess_;
        # Attributs database loginaccount
        private $idLoginAccount_;
        private $identifiant_;
        private $password_;


    /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

    /* ▂ ▅ ▆ █ __construct() █ ▆ ▅ ▂ */
    # @ __construct( $idUserAccount='', $userName='', $userFirstName='', $userEmail='', $userRecoveryCode='', $userAccess='', $idLoginAccount='', $identifiant='', $password='' )
    public function __construct( $idUserAccount='', $userName='', $userFirstName='', $userEmail='', $userRecoveryCode='', $userAccess='', $idLoginAccount='', $identifiant='', $password='' ){
        $this -> idUserAccount_ = $idUserAccount;
        $this -> userName_ = $userName;
        $this -> userFirstName_ = $userFirstName;
        $this -> userEmail_ = $userEmail;
        $this -> userRecoveryCode_ = $userRecoveryCode;
        $this -> userAccess_ = $userAccess;
        $this -> idLoginAccount_ = $idLoginAccount;
        $this -> identifiant_ = $identifiant;
        $this -> password_ = $password;
    }

    /* ▂ ▅ ▆ █ hydrate() █ ▆ ▅ ▂ */
        # @ hydrate($donnees)
        public function hydrate($donnees){
            foreach ($donnees as $attribut => $valeur){
                $methode = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribut)));
                if (is_callable(array($this, $methode))){
                    $this->$methode($valeur);
                };
            }
        }

    /* ▂ ▅ ▆ █ Settets █ ▆ ▅ ▂  */
    /* Traitement faille XSS htmlspecialchars() 'Cette fonction retourne une chaîne avec ces Conversions réalisées.' */
    /* ENT_QUOTES => Convertira les deux citations doubles et simples. */
    # @ setAttribut($valeur) = htmlspecialchars(trim($valeur), ENT_QUOTES); return $this;
    public function setIdUserAccount($idUserAccount){ $this -> idUserAccount_ = htmlspecialchars(trim($idUserAccount), ENT_QUOTES); return $this; }
    public function setUserName($userName){ $this -> userName_ = htmlspecialchars(trim($userName), ENT_QUOTES); return $this; }
    public function setUserFirstName($userFirstName){ $this -> userFirstName_ = htmlspecialchars(trim($userFirstName), ENT_QUOTES); return $this; }
    public function setUserEmail($userEmail){ $this -> userEmail_ = htmlspecialchars(trim($userEmail), ENT_QUOTES); return $this; }
    public function setUserRecoveryCode($userRecoveryCode){ $this -> userRecoveryCode_ = htmlspecialchars(trim($userRecoveryCode), ENT_QUOTES); return $this; }
    public function setUserAccess($userAccess){ $this -> userAccess_ = htmlspecialchars(trim($userAccess), ENT_QUOTES); return $this; }
    public function setIdLoginAccount($idLoginAccount){ $this -> idLoginAccount_ = htmlspecialchars(trim($idLoginAccount), ENT_QUOTES); return $this; }
    public function setIdentifiant($identifiant){ $this -> identifiant_ = htmlspecialchars(trim($identifiant), ENT_QUOTES); return $this; }
    public function setPassword($password){ $this -> password_ = htmlspecialchars(trim($password), ENT_QUOTES); return $this; }
  
   

    /* ▂ ▅ ▆ █ Getters █ ▆ ▅ ▂  */
    /* Traitement faille XSS htmlspecialchars() 'Cette fonction retourne une chaîne avec ces Conversions réalisées.' */
    /* ENT_QUOTES => Convertira les deux citations doubles et simples. */
    # @ getAttribut() = htmlspecialchars_decode($this -> attribut_, ENT_COMPAT);
    public function getIdUserAccount(){ return htmlspecialchars_decode($this -> idUserAccount_, ENT_COMPAT); }
    public function getUserName(){ return htmlspecialchars_decode($this -> userName_, ENT_COMPAT); }
    public function getUserFirstName(){ return htmlspecialchars_decode($this -> userFirstName_, ENT_COMPAT); }
    public function getUserEmail(){ return htmlspecialchars_decode($this -> userEmail_, ENT_COMPAT); }
    public function getUserRecoveryCode(){ return htmlspecialchars_decode($this -> userRecoveryCode_, ENT_COMPAT); }
    public function getUserAccess(){ return htmlspecialchars_decode($this -> userAccess_, ENT_COMPAT); }
    public function getIdLoginAccount(){ return htmlspecialchars_decode($this -> idLoginAccount_, ENT_COMPAT); }
    public function getIdentifiant(){ return htmlspecialchars_decode($this -> identifiant_, ENT_COMPAT); }
    public function getPassword(){ return htmlspecialchars_decode($this -> password_, ENT_COMPAT); }

}