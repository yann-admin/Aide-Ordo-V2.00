<?php
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\Core\Form;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /**/
    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █    Class    █ ▆ ▅ ▂ */
        class Token {
            /* ▂ ▅ ▆ █ Attributs █ ▆ ▅ ▂ */
            private $token;
            private $token_time;
            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

                /* ▂ ▅ ▆ █ construct █ ▆ ▅ ▂ */
                    public function __construct($token, $token_time){
                        $this->token = $token;
                        $this->token_time = $token_time;
                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▆ █ Setters █ ▆ ▅ ▂ */
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▆ █ Getters █ ▆ ▅ ▂ */
                    public function getToken(){ return $this -> token;}
                    public function getToken_time(){ return $this -> token_time;}
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


                /* ▂ ▅ ▆ █ createdToken( ) █ ▆ ▅ ▂ */      
                    public static function createdToken(){
                        # Checks if $_SESSION['token'] exists and if not = NULL
                        if(isset($_SESSION['token'])){
                            # destroy 
                            unset($_SESSION['token']);
                            unset($_SESSION['token_time']);
                        };
                        # A new token is instantiated
                        $oToken = new Token(bin2hex(openssl_random_pseudo_bytes(32)), time());
                        $_SESSION['token'] = $oToken->getToken();
                        $_SESSION['token_time'] = $oToken->getToken_time();
                    }    
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▆ █ controlToken( ) █ ▆ ▅ ▂ */   
                    public static function controlToken( ){
                        $retour[0] = false;
                        $retour[1] = "";
                        # Checking that the $_SESSION['token'] token matches the $_POST['token'] token
                        if($_SESSION['token'] == $_POST['token']){
                            # we check the dateline $_POST['token'] >= $timestamp
                            $timestamp = time() - (4*60);
                            # Dateline control
                            if($_POST['token_time'] >= $timestamp){
                                # If the token's dateline is correct
                                $retour[0] = false;
                                $retour[1] = "L'ajout des données est réalisé"; 
                            }else{
                                # If the token's dateline has expired
                                $retour[0] = true;
                                $retour[1] = "Le jeton de controle est expiré, opération annulée !"; 
                            }
                        }else{
                            # the token does not match
                            $retour[0] = true;
                            $retour[1] = "Le jeton de controle ne correspond pas, opération annulée !";   
                        }
                        return $retour;   
                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
                
            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
        }
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

?>