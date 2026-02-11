<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier entities database: api_chichoune - table: cookiesremember via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Entities\CookiesRemember;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    // use PDO;
    // use Exception;
    # Class Crypto & Key
    use \Defuse\Crypto\Crypto;
    use \Defuse\Crypto\Key;
    require '../vendor/autoload.php';

    error_reporting(E_ALL);
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class CookiesRemember{
/* ▂ ▅ Attributs ▅ ▂ */ 
    protected $keyCrypto_;
    protected $nameCookie_;
    protected $durationCookie_;
    protected $adressIp_;
    protected $idUserAccount_;
    protected $idLoginAccount_;
    protected $cookiesCrypted_;

/* ▂ ▅  construct  ▅ ▂ */
    /* @ $objCookiesRemember( ) */
    public function __construct(  ){;
        $this -> keyCrypto_ = Key::createNewRandomKey();
        $this -> nameCookie_ = 'cookie_remember';
        $this -> durationCookie_ = time() + $_ENV['END_DATE_REMEMBER_ME']; 
        $this -> adressIp_ = $_SERVER['REMOTE_ADDR'];
        $this -> idUserAccount_ = null;
        $this -> idLoginAccount_ = null;
        $this -> cookiesCrypted_ = null;    
    }



/* ▂ ▅  whriteCookies()  ▅ ▂ */
    public function whriteCookies($id1, $id2){
        $cookies = [
            'idLoginAccount' => $this -> idLoginAccount_,
            'idUserAccount' => $this -> idUserAccount_,
            'adressIp' => $this -> adressIp_,
            'durationCookie' => $this -> durationCookie_,
            'keyCrypto' => $this -> keyCrypto_->saveToAsciiSafeString()
        ];
        return $cookies;
    }

/* ▂ ▅  cryptCookies()  ▅ ▂ */
    public function cryptCookies($cookies){
        $cookiesJson = json_encode($cookies);
        $this -> cookiesCrypted_ = Crypto::encrypt($cookiesJson, $this -> keyCrypto_);
        return $this -> cookiesCrypted_;
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

    /* ▂ ▅  Setters  ▅ ▂ */
        /* Traitement faille XSS htmlspecialchars() 'Cette fonction retourne une chaîne avec ces Conversions réalisées.' */
        /* ENT_QUOTES => Convertira les deux citations doubles et simples. */

    /* ▂ ▅  Getters  ▅ ▂ */
        /* Traitement lecture htmlspecialchars_decode() 'Convertir des entités HTML spéciales en caractères'  */
        /* ENT_COMPAT => Je vais convertir les guillemets doubles et laisser les guillemets simples intacts. */
        public function getkeyCrypto(){ return $this -> keyCrypto_; }
        public function getNameCookie(){ return $this -> nameCookie_; }
        public function getDurationCookie(){ return $this -> durationCookie_; }
        public function getAdressIp(){ return $this -> adressIp_; }
        public function getIdUserAccount(){ return $this -> idUserAccount_; }
        public function getIdLoginAccount(){ return $this -> idLoginAccount_; }
        public function getCookiesCrypted(){ return $this -> cookiesCrypted_; }
};
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>