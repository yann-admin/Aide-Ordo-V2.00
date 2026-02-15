<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier controller database: api_chichoune - table: useraccount via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Models\User;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    # Class PDO & Exception
    use PDO;
    use Exception;

    # Class Database
    use App\Core\Database\DbConnectSql;

    # Class Controller & Entity & Models 
    use App\Entities\User\User;

    # Class other
    //use App\Core\Form\PdoDbException;

    error_reporting(E_ALL);
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 


/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class UserModel extends DbConnectSql{
/* ▂ ▅ Methodes ▅ ▂ */

    /* ▂ ▅  executeTryCatchFind()  ▅ ▂ */
    public function executeTryCatchFind( ) {
        $resultRequest = ['error' => '', 'dataRequest' => [] ];
        try {
            $this -> request -> execute();
            $resultRequest['dataRequest'] = $this -> request-> fetchAll(PDO::FETCH_OBJ);
            $this -> request -> closeCursor();
            return $resultRequest;
        }catch ( Exception $e ){
            $resultRequest['error'] = new Exception( $e );
            /* Ferme le curseur, permettant à la requete d'être de nouveau executée */ 
            $this -> request -> closeCursor();
            error_log($resultRequest['error']->getMessage());
            return  $resultRequest;
        };
    }


    /* ▂ ▅  searchValue( string $value )  ▅ ▂ */
    public function searchValue( string $Column , $value ) { 
        $this -> request = $this -> connexion -> prepare( "SELECT loginaccount.*, useraccount.*  FROM loginaccount, useraccount WHERE loginaccount.$Column=:$Column AND loginaccount.idUserAccount = useraccount.idUserAccount" );
        $this -> request -> bindParam(":$Column", $value , PDO::PARAM_STR);
        $resultRequest = $this -> executeTryCatchFind( );
        return $resultRequest;

    }




}