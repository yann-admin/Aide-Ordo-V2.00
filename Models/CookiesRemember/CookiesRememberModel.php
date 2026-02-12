<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier controller database: api_chichoune - table: cookiesremember via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Models\CookiesRemember;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    use PDO;
    use Exception;
    use App\Core\Database\DbConnectSql;
    use App\Entities\CookiesRemember\CookiesRemember;
    # Class other
    use App\Core\Form\PdoDbException;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class CookiesRememberModel extends DbConnectSql{
    /* ▂ ▅  executeTryCatch()  ▅ ▂ */
    public function executeTryCatch() { 
        try {
            $this -> request -> execute();
            $pdoDbException = '';
        }catch ( Exception $e ){
            $pdoDbException =  new PdoDbException( $e );
        }
        /* Ferme le curseur, permettant à la requete d'être de nouveau executée */
        $this -> request -> closeCursor();
        return  $pdoDbException;
    }

    /* ▂ ▅  create( Cookiesremember $Cookiesremember )  ▅ ▂ */
    public function addCookies(CookiesRemember $cookieCrypted,  $cookies ) { 
        $this -> request = $this -> connexion -> prepare( "INSERT INTO cookiesremember
        SET cookiesremember.cookieCrypted=:cookieCrypted, cookiesremember.adressIp=:adressIp, cookiesremember.keyCrypto=:keyCrypto, cookiesremember.endDate=:endDate ; ");
        /* Set values for cookiesremember */
        $this -> request -> bindValue(":cookieCrypted", $cookieCrypted -> getCookiesCrypted(), PDO::PARAM_STR);
        $this -> request -> bindValue(":adressIp", $cookies['adressIp'], PDO::PARAM_STR);
        $this -> request -> bindValue(":keyCrypto", $cookieCrypted -> getKeyCrypto(), PDO::PARAM_STR); 
        $this -> request -> bindValue(":endDate", $cookies['endDate'], PDO::PARAM_INT);
        
        $pdoDbException = $this -> executeTryCatch();
        if ( $pdoDbException == '' ) {
            return true;
        } else {
            return $pdoDbException; // Return the exception
        };

    }
  
    /* ▂ ▅  findKey( string $key )  ▅ ▂ */
    public function findByCookie( string $cookieCrypted ) { 
        $this -> request = $this -> connexion -> prepare( "SELECT cookiesremember.* FROM cookiesremember WHERE cookiesremember.cookieCrypted=:cookieCrypted" );
        $this -> request -> bindParam(":cookieCrypted", $cookieCrypted , PDO::PARAM_STR);
        $pdoDbException = '';
        try {
            $this -> request -> execute();
            $results = $this -> request -> fetch(PDO::FETCH_OBJ);
            $this -> request -> closeCursor();
            if ($results) {
                return $results; // Return true if exists
            } else {
                return ''; // No match found
            };
        }catch ( Exception $e ){
            $pdoDbException =  new PdoDbException( $e );
            /* Ferme le curseur, permettant à la requete d'être de nouveau executée */
            $this -> request -> closeCursor();
            return  $pdoDbException;
        }
    }


    /*▂ ▅  delete( int $id )  ▅ ▂ */
    public function deleteByCookie( int $id ) {
        $this -> request = $this -> connexion -> prepare("DELETE FROM cookiesremember WHERE cookiesremember.idCookieRemember = :idCookieRemember");
        $this -> request -> bindParam(":idCookieRemember", $id , PDO::PARAM_INT);
        $pdoDbException = $this -> executeTryCatch(); 
        return $pdoDbException; 
    }





};
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>