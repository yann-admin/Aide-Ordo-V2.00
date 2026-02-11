<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier controller database: api_chichoune - table: useraccount via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Models\User;
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
class UserModel extends DbConnectSql{
/* ▂ ▅ Methodes ▅ ▂ */  
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

    /* ▂ ▅  create( User $User )  ▅ ▂ */
    public function createJoint( User $User ) { 
        $this -> request = $this -> connexion -> prepare( "INSERT INTO useraccount
        SET useraccount.userName=:userName, useraccount.userFirstName=:userFirstName, useraccount.userEmail=:userEmail, useraccount.userRecoveryCode=:userRecoveryCode, useraccount.userAccess=:userAccess; INSERT INTO loginaccount SET loginaccount.identifiant=:identifiant, loginaccount.password=:password, loginaccount.idUserAccount=LAST_INSERT_ID(); "); 
        /* Set values for useraccount */
        $this -> request -> bindValue(":userName", $User -> getUserName(), PDO::PARAM_STR);
        $this -> request -> bindValue(":userFirstName", $User -> getUserFirstName(), PDO::PARAM_STR);
        $this -> request -> bindValue(":userEmail", $User -> getUserEmail(), PDO::PARAM_STR);
        $this -> request -> bindValue(":userRecoveryCode", $User -> getUserRecoveryCode(), PDO::PARAM_STR);
        $this -> request -> bindValue(":userAccess", $User -> getUserAccess(), PDO::PARAM_INT);
        /* Set values for loginaccount */ 
        $this -> request -> bindValue(":identifiant", $User -> getIdentifiant(), PDO::PARAM_STR);
        $this -> request -> bindValue(":password", $User -> getPassword(), PDO::PARAM_STR);
        $pdoDbException = $this -> executeTryCatch();
        if ( $pdoDbException == '' ) {
            return true;
        } else {
            return $pdoDbException; // Return the exception
        };
    }

    /* ▂ ▅  findJointByIdentifiant( string $identifiant )  ▅ ▂ */
    public function findJointByIdentifiant( string $identifiant ) { 
        $this -> request = $this -> connexion -> prepare( "SELECT loginaccount.*, useraccount.*  FROM loginaccount, useraccount WHERE loginaccount.identifiant=:identifiant AND loginaccount.idUserAccount = useraccount.idUserAccount" );
        $this -> request -> bindParam(":identifiant", $identifiant , PDO::PARAM_STR);
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

    /* ▂ ▅  findById( int $id )  ▅ ▂ */
    public function findById( int $id ) { 
        $this -> request = $this -> connexion -> prepare( "SELECT useraccount.* FROM useraccount WHERE useraccount.idUserAccount=:idUserAccount" );
        $this -> request -> bindParam(":idUserAccount", $id , PDO::PARAM_STR);
        $this -> request -> execute();
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

    /* ▂ ▅  update( int $id, Useraccount $Useraccount )  ▅ ▂ */
    public function update(  User $User, int $id ) { 
        $this -> request = $this -> connexion -> prepare( "UPDATE useraccount
        SET useraccount.userName=:userName, useraccount.userFirstName=:userFirstName, useraccount.userEmail=:userEmail, useraccount.userRecoveryCode=:userRecoveryCode, useraccount.userAccess=:userAccess
        WHERE useraccount.idUserAccount = :idUserAccount");
        $this -> request -> bindParam(":idUserAccount", $id , PDO::PARAM_INT);
        $this -> request -> bindValue(":userName", $User -> getUserName(), PDO::PARAM_STR);
        $this -> request -> bindValue(":userFirstName", $User -> getUserFirstName(), PDO::PARAM_STR);
        $this -> request -> bindValue(":userEmail", $User -> getUserEmail(), PDO::PARAM_STR);
        $this -> request -> bindValue(":userRecoveryCode", $User -> getUserRecoveryCode(), PDO::PARAM_STR);
        $this -> request -> bindValue(":userAccess", $User -> getUserAccess(), PDO::PARAM_INT);
        $pdoDbException = $this -> executeTryCatch();
        if ( $pdoDbException == '' ) {
            return true;
        } else {
            return $pdoDbException; // Return the exception
        };
    }

    /*▂ ▅  delete( int $id )  ▅ ▂ */
    public function delete( int $id ) {
        $this -> request = $this -> connexion -> prepare("DELETE FROM loginaccount WHERE loginaccount.idUserAccount = :idUserAccount; DELETE FROM useraccount WHERE useraccount.idUserAccount = :idUserAccount;");
        $this -> request -> bindParam(":idUserAccount", $id , PDO::PARAM_INT);
        $pdoDbException = $this -> executeTryCatch();
        if ( $pdoDbException == '' ) {
            return true;
        } else {
            return $pdoDbException; // Return the exception
        };
    }


/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
};

?>