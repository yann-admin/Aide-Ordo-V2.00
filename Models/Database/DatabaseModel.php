<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier controller database: api_chichoune - table: useraccount via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Models\Database;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    use PDO;
    use Exception;

    use App\Core\Database\DbConnectSql;
    use App\Entities\User\User;

    # Class other
    use App\Core\Form\PdoDbException;


    error_reporting(E_ALL);
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class DatabaseModel extends DbConnectSql{
/* ▂ ▅ Methodes ▅ ▂ */  

    /* ▂ ▅  duplicateCheck( string $table, string $ColumnName, $Value )  ▅ ▂ */
    public function duplicateCheck( string $table, string $ColumnName, $Value ) { 
        $this -> request = $this -> connexion -> prepare( "SELECT $table.$ColumnName FROM $table WHERE $table.$ColumnName=:columnValue" );
        $this -> request -> bindParam(":columnValue", $Value , PDO::PARAM_STR);
        $pdoDbException = '';
        try {
            $this -> request -> execute();
            $results = $this -> request -> fetch(PDO::FETCH_OBJ);
            $this -> request -> closeCursor();
            if ($results) {
                return true; // Return true if duplicate exists, false otherwise
            } else {
                return false; // No duplicate found
            };
        }catch ( Exception $e ){
            $pdoDbException =  new PdoDbException( $e );
            /* Ferme le curseur, permettant à la requete d'être de nouveau executée */
            $this -> request -> closeCursor();
            return  $pdoDbException;
        }
    }

    /* ▂ ▅  matchCheck( string $table, string $ColumnName, $Value )  ▅ ▂ */
    public function matchCheck( string $table, string $ColumnName, $Value ) { 
        $this -> request = $this -> connexion -> prepare( "SELECT $table.$ColumnName FROM $table WHERE $table.$ColumnName=:columnValue" );
        $this -> request -> bindParam(":columnValue", $Value , PDO::PARAM_STR);
        $pdoDbException = '';
        try {
            $this -> request -> execute();
            $results = $this -> request -> fetch(PDO::FETCH_OBJ);
            $this -> request -> closeCursor();
            if ($results) {
                return true; // Return true if exists
            } else {
                return false; // No match found
            };
        }catch ( Exception $e ){
            $pdoDbException =  new PdoDbException( $e );
            /* Ferme le curseur, permettant à la requete d'être de nouveau executée */
            $this -> request -> closeCursor();
            return  $pdoDbException;
        }
    }



/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
};

?>