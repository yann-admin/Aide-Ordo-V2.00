<?php
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\Core\Database;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
        use PDO;
        use Exception;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █    Class    █ ▆ ▅ ▂ */
        class DbConnectSql{
            /* ▂ ▅ ▆ █ Attributs █ ▆ ▅ ▂ */
                protected $connexion;
                protected $request;
            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */
                /* ▂ ▅ construct █ ▆ ▅ ▂ */
                    public function __construct(){
                        try{
                            $this -> connexion = new PDO("mysql:host=" . $_ENV["SERVER_SQL"] .";dbname=" . $_ENV["BASE_SQL"], $_ENV["USER_SQL"], $_ENV["PASSWORD_SQL"]);
                            #Activation des erreurs PDO:
                            $this -> connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            #Les retours de requete seront en tableau objet par défaut:
                            $this -> connexion -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                            #Encodage des caractères spéciaux "utf-8":
                            $this -> connexion -> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
                        }catch (Exception $e){
                            die('Erreur :' . $e->getMessage());
                        }
                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▆ █ Setters █ ▆ ▅ ▂ */
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▆ █ Getters █ ▆ ▅ ▂ */
                    public function getConnection(){ return $this -> connexion;}
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */      
        }
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */  
?>
