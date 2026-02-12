<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier entities database: api_chichoune - table: cookiesremember via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Entities\CookiesRemember;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    # Class Crypto & Key
    use \Defuse\Crypto\Crypto;
    use \Defuse\Crypto\Key;
    require '../vendor/autoload.php';

    error_reporting(E_ALL);
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class CookiesRemember{
/* ▂ ▅ Attributs ▅ ▂ */ 
    private $keyCrypto_;
    private $cookiesCrypted_;


/* ▂ ▅ ▆ █ __construct() █ ▆ ▅ ▂ */
    /* @ $objCookiesRemember( ) */
    public function __construct( ){;
        $this -> keyCrypto_ = '';
        $this -> cookiesCrypted_ = '';
    }


/* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

    /* ▂ ▅ ▆ █ createCookieCrypted() █ ▆ ▅ ▂ */
    public function createCookieCrypted( $cookies ) {
        $this -> keyCrypto_ = Key::createNewRandomKey();
        $this -> cookiesCrypted_ = Crypto::encrypt( json_encode($cookies), $this -> keyCrypto_ );
    }

    /* ▂ ▅ ▆ █ decryptCookieCrypted() █ ▆ ▅ ▂ */
    public function decryptCookieCrypted( $cookieCrypted, $keyCrypto) { 
    $cookieDecryptJson = Crypto::decrypt( $cookieCrypted, Key::loadFromAsciiSafeString( $keyCrypto ) );
    return json_decode($cookieDecryptJson);
    }

    /* ▂ ▅ ▆ █ Setters() █ ▆ ▅ ▂ */
    public function setKeyCrypto( $keyCrypto ) {$this -> keyCrypto_ = $keyCrypto;}
    public function setCookiesCrypted( $cookiesCrypted ) {$this -> cookiesCrypted_ = $cookiesCrypted;}


    /* ▂ ▅ ▆ █ Getters() █ ▆ ▅ ▂ */
    public function getKeyCrypto( ) {return $this -> keyCrypto_-> saveToAsciiSafeString();}
    public function getCookiesCrypted( ) {return $this -> cookiesCrypted_ ;}

};
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>