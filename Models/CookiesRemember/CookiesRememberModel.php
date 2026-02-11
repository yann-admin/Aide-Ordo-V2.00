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
        public function create($cookies, $Cookiesremember ) { 
            $this -> request = $this -> connexion -> prepare( "INSERT INTO cookiesremember
            SET cookiesremember.cookies=:cookies, cookiesremember.adressIp=:adressIp, cookiesremember.randomKey=:randomKey, cookiesremember.idUserAccount=:idUserAccount" );
            $this -> request -> bindValue(":cookies", $Cookiesremember , PDO::PARAM_STR);
            $this -> request -> bindValue(":adressIp", $cookies["adressIp"], PDO::PARAM_STR);
            $this -> request -> bindValue(":randomKey", $cookies["keyCrypto"], PDO::PARAM_STR);
            $this -> request -> bindValue(":idUserAccount", 0, PDO::PARAM_INT); 
            $pdoDbException = $this -> executeTryCatch();
            if ( $pdoDbException == '' ) {
                return true;
            } else {
                return $pdoDbException; // Return the exception
            };
        }
    /* ▂▂▂▂▂▂▂▂▂▂▂ */







};
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>