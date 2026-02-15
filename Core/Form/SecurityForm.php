<?php
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
        namespace App\Core\Form;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
    
	/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */

	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

 
    /* ▂ ▅ ▆ █ Grafcet █ ▆ ▅ ▂ */
        /*
            # Class SecurityForm
                ╚ function encode_XssTrim( array $posts )
                ╚ function decode_XssTrim( array $posts )  
                ╚ function SecurityForm( array $setting )  

            # encode_XssTrim( array $posts )
                - We create an empty array $postEncode
                - Loop for array $posts
                - We encode XSS & Trim each value of $posts and we stock in $postEncode
                - We return the array $postEncode

            # decode_XssTrim( array $posts 
                - We create an empty array $postDecode
                - Loop for array $posts
                - We decode XSS & Trim each value of $posts and we stock in $postDecode
                - We return the array $postDecode

            # function SecurityForm( array $setting )
                1.0 Control method
                    2.1 Control anti-robot  
                    2.2 Control token
                    2.3 Control token_time ( 4min )
                    2.4 Control value $post
                        2.4.1 Control empty field
                        2.4.2 Control regex pattern 
                1.1 Return response
        */
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class SecurityForm{
            /* ▂ ▅ ▆ █ Attributs ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */
                /* ▂ ▅ ▆ █ encode_XssTrim( array $posts):array ▅ ▂ */
                    public static function encode_XssTrim( array $posts ):array{
                        $postEncode=[];
                        // Loop for array $posts
                        foreach ($posts as $name => $post){
                            $postEncode[$name] = htmlspecialchars(trim($post));
                        };
                        return $postEncode;
                    }


                /* ▂ ▅ ▆ █ decode_XssTrim( array $posts):array ▅ ▂ */
                    public static function decode_XssTrim( array $posts ):array{
                        $postDecode=[];
                        // Loop for array $posts
                        foreach ($posts as $name => $post){
                            $postDecode[$name] = htmlspecialchars_decode($post);
                        };
                        return $postDecode;
                    }
 

                /* ▂ ▅ ▆ █ SecurityForm( array $setting ):array ▅ ▂ */
                    public static function SecurityForm( array $setting , string $ancre):array{
                        $response=['bitErrorSecurityForm'=>true, 'msgErrorSecurityForm'=>'error'];
                        # Step 2.0 control method
                        if( $_SERVER["REQUEST_METHOD"] === $setting['method'] ){
                            # Step 2.1 control antibot
                            if( (isset($setting["post"]["antirobot"])) && ($setting["post"]["antirobot"] === '') ){
                                # Step 2.2 control token
                                if( (isset($setting["post"]['token'])) && ($_SESSION['token'] === $setting["post"]['token']) ){
                                    # Step 2.3 control token_time ( 4min )
                                    $timestamp = time() - (4*60);
                                    if( $_SESSION['token_time'] >= $timestamp ){
                                        # Step 2.4 control value $post
                                        // Loop for array $setting['regexFieldRequired']
                                        $fieldEmpty = true;
                                        $fieldRegex = true;
                                        foreach ($setting['regexFieldRequired'] as $field => $regex){
                                            $fieldValue = $setting["post"][$field];
                                            if( $fieldValue == '' ){ 
                                                $fieldEmpty=false; break; 
                                            }else{
                                                if( $regex != '' ){
                                                    if( !preg_match($regex, $fieldValue) ){                                               
                                                        $fieldRegex=false;
                                                        break;
                                                    };
                                                };
                                            };
                                        };
                                        if($fieldEmpty){
                                            if($fieldRegex){
                                                $response=['bitErrorSecurityForm'=>false, 'msgErrorSecurityForm'=>''];
                                                return $response;
                                            }else{
                                            $response=['bitErrorSecurityForm'=>true, 'msgErrorSecurityForm'=>"Opération annulée! <br> Veuillez respecter le format demander pour le champ ` $field `."];
                                            return $response;
                                            };
                                        # Else 2.4
                                        }else{
                                            $response=['bitErrorSecurityForm'=>true, 'msgErrorSecurityForm'=>"Opération annulée! <br> Le champ de saisie ` $field  ` est obligatoire."];
                                            return $response;
                                        };                                  
                                        # End 2.4
                                        /* ---------------------------------------------------- */
                                        # Else 2.3
                                    }else{
                                        $response=['bitErrorSecurityForm'=>true, 'msgErrorSecurityForm'=>'Opération annulée! <br> Le jeton de contrôle est périmé. Veuillez actualiser la page s\'il vous plaît. <a href="'.$ancre.'" ><i class="fa-solid fa-arrow-rotate-left"></i> </a>'];
                                        return $response;
                                    };
                                    # End 2.3
                                    /* ---------------------------------------------------- */
                                # Else 2.2
                                }else{
                                $response=['bitErrorSecurityForm'=>true, 'msgErrorSecurityForm'=>'Opération annulée! <br> Les jetons de contrôle ne concorde pas.  Veuillez actualiser la page s\'il vous plaît. <a href="'.$ancre.'"> <i class="fa-solid fa-arrow-rotate-left"></i> </a>'];
                                return $response;
                                };
                                # End 2.2
                                /* ---------------------------------------------------- */
                            # Else 2.1
                            }else{
                            $response=['bitErrorSecurityForm'=>true, 'msgErrorSecurityForm'=>'Opération annulée! <br> Nous identifions l\'envoi du formulaire par un robot. <a href="'.$ancre.'"> <i class="fa-solid fa-arrow-rotate-left"></i> </a>'];
                            return $response;
                            };
                            # End 2.1
                            /* ---------------------------------------------------- */
                        # Else 2.0
                        }else{
                            $response=['bitErrorSecurityForm'=>true, 'msgErrorSecurityForm'=>'Opération annulée! <br> La méthode reçue n\'est pas conforme. Veuillez actualiser la page s\'il vous plaît.<a href="'.$ancre.'" ><i class="fa-solid fa-arrow-rotate-left"></i> </a>'];
                            return $response;
                        };
                        # End 2.0
                        /* ---------------------------------------------------- */
                    }

        };

?>