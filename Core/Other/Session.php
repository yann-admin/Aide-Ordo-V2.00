<?php
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

    /* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
        namespace App\Core\Other;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
    
	/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
        use App\Models\User\CookiesRememberModel;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Session {
            /* ▂ ▅ Attributs ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */
            
			    /*▂ ▅ ▆ █ construct █ ▆ ▅ ▂ */
                    public function __construct() {
                        // $this->sessionStart();
                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅  start  ▅ ▂ */
                    public function sessionStartTimer() {
                        $mode = 1;
                        $timeAutoRegenerateId = 300;
                        $timeAutoDisconnect = 900;                      
                        # La régénération des identifiants de session réduit le risque de vol d’identifiants de session, c’est pourquoi session_regenerate_id() doit être appelé périodiquement.
                        # Par exemple, régénérer l’ID de session toutes les 15 minutes pour le contenu sensible à la sécurité. Même dans le cas où un identifiant de session est volé, 
                        # les deux La session de l’utilisateur et de l’attaquant expirera. En d’autres termes, l’accès par l’utilisateur ou l’attaquant sera générer une erreur d’accès à la session obsolète.
                        
                        # Auto Disconnect Session
                        // if (!isset($_SESSION['autoDisconnectSession']) ) {
                        //     $_SESSION['autoDisconnectSession'] = time() + $timeAutoDisconnect;
                        // } else {
                        //     if (time() > $_SESSION['autoDisconnectSession']) {
                        //         $this->varSessionDestroy();
                        //         header('location:home'); 
                        //         return;
                        //     }
                        // }

                        # Auto Regenerate Id Session
                        if (!isset($_SESSION['autoRegenerateIdSession'])) {
                            $_SESSION['autoRegenerateIdSession'] = time() + $timeAutoRegenerateId;
                        } else {
                            if (time() > $_SESSION['autoRegenerateIdSession']) {
                                session_regenerate_id( false );
                                $_SESSION['autoRegenerateIdSession'] = time() + $timeAutoRegenerateId;
                            }
                        }

                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅  sessionDestroy  ▅ ▂ */
                    public function sessionDestroy(){
                        # Reco via https://www.php.net/manual/en/session.security.ini.php:
                        $this -> varSessionDestroy();
                        session_destroy(); 
                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

                /* ▂ ▅ varSessionDestroy  ▅ ▂ */
                    public function varSessionDestroy(){
                        if( isset($_COOKIE['rememberMe']) ){
                            # We get the cookie value
                            $cookieCrypted = $_COOKIE['rememberMe'];
                            # We instantiate the CookiesRememberModel() class 
                            $objCookiesModel = new CookiesRememberModel();
                            $result_Cookies = $objCookiesModel -> findByCookie( $cookieCrypted );
                            $objCookiesModel -> deleteByCookie( $result_Cookies->idCookieRemember );
                            setcookie("rememberMe", '', time() + (60*60*24), "/", $_ENV['DOMAINE'], true, true); // 1 day 
                        };
                        # Reco via https://www.php.net/manual/en/session.security.ini.php:
                        unset($_SESSION['autoDisconnectSession']);
                        unset($_SESSION['autoRegenerateIdSession']);
                        unset($_SESSION['connected']);
                        unset($_SESSION['token']);
                        unset($_SESSION['token_time']);  
                        unset($_SESSION['UserInformation']); 
                           
                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 


            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
    };  
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */  
?>