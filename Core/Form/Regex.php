<?php
	/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
		/* Toolbox VERSION: 3.0 */ 
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\Core\Form;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Regex{
            /* ▂ ▅ ▆ █ Attributs █ ▆ ▅ ▂ */
                private $regex;
                private $tooltip;
                private $pregMatch;
                private $pattern;
            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

                /*▂ ▅ ▆ █ construct █ ▆ ▅ ▂ */
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▆ █ Getters █ ▆ ▅ ▂ */
                    public function getReadRegex( ){ return $this -> regex; }
                    public function getReadTooltip( ){ return $this -> tooltip; }
                    public function getReadPregMatch( ){ return $this -> pregMatch; }
                    public function getReadPattern( ){ return $this -> pattern; }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */       

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Tooltip █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                public function readTooltip( ):self{
                    $this -> tooltip = [
                        'identifiant' => 'Votre identifiant doit comporter entre 8 et 10 caractères, inclure au moins une lettre majuscule, une lettre minuscule. Il peut inclure des lettres, des chiffres, des tirets bas (_) et des tirets (-).',
                        'password' => 'Votre mot de passe doit comporter entre 10 et 12 caractères, inclure au moins une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial parmi / @ $ ! % * ? & #.',
                        'email' => 'Veuillez entrer une adresse e-mail valide au format exemple : user@example.com',
                        'text' => 'Ce champ ne peut contenir que des lettres, des espaces, des tirets et des apostrophes.',
                        'textarea' => 'Ce champ peut contenir des lettres, des chiffres, des espaces et les signes de ponctuation suivants : . , ; : ! ? ( & ) " \'', 
                        'date' => 'Veuillez entrer une date au format AAAA-MM-JJ.',
                        'datetime-local' => 'Veuillez entrer une date et une heure au format AAAA-MM-JJThh:mm.',
                        'time' => 'Veuillez entrer une heure au format hh:mm.',
                        'number' => 'Veuillez entrer un nombre valide. ',
                        'adress' => 'Ce champ peut contenir des lettres, des chiffres, des espaces et les signes de ponctuation suivants : , .',
                        'postal-code' => 'Veuillez entrer un code postal à 5 chiffres.',
                        'phone' => 'Veuillez entrer un numéro de téléphone valide, qui peut inclure des chiffres, des espaces, des tirets, des parenthèses et un signe plus.',
                        'select' => 'Veuillez sélectionner une option valide dans la liste déroulante.',
                        'file' => 'Veuillez sélectionner un fichier valide.',
                        'url' => 'Veuillez entrer une URL valide.',
                        'checkbox' => 'Veuillez cocher cette case pour continuer.',
                        'radio' => 'Veuillez sélectionner une option parmi les choix disponibles.',
                        'color' => 'Veuillez sélectionner une couleur valide.',
                        'range' => 'Veuillez entrer une valeur dans la plage spécifiée.',
                        'month' => 'Veuillez entrer une valeur au format AAAA-MM.',
                        'week' => 'Veuillez entrer une valeur au format AAAA-Www.',  
                    ];
                    return $this;
                }
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Pattern / Regex █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    public function readRegex( ):self{
                        $this -> regex = [
                            'identifiant' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9_-]{8,10}$",
                            'password' => "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\/@$!%*?&#])[A-Za-zÀ-ÖØ-öø-ÿ\d\/@$!%*?&#]{10,12}$",
                            'email' => "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$",
                            'text' => "^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]{2,}$",
                            // 'textarea' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s.,;:!?()\"'-]+$",
                            'textarea' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s\/\@\$\!\%\*\?\&\#\.\,\;\:\!\?\(\)\"'\-\[\]]{2,}+$",
                            'date' => "^\d{4}-\d{2}-\d{2}$",
                            'datetime-local' => "^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$",
                            'time' => "^\d{2}:\d{2}$",
                            'number' => "^\d+$",
                            'adress' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s.,'-]+$",
                            'postal-code' => "^[\d]{5}$",
                            'phone' => "^\+?[0-9\s\-()]+$",
                            'select' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'file' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'url' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'search' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'checkbox' => "^(on|off)$",
                            'radio' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'color' => "^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$",
                            'range' => "^\d+$",
                            'month' => "^\d{4}-(0[1-9]|1[0-2])$",
                            'week' => "^\d{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$",

                        ];
                        return $this;
                    }
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */   

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ pregMatch █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    public function readPregMatch( ):self{
                        $this -> pregMatch = [
                            'identifiant' => "/^[A-Za-z0-9À-ÖØ-öø-ÿ_-]{8,10}$/",
                            'password' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\/@$!%*?&#])[A-Za-zÀ-ÖØ-öø-ÿ\d\/@$!%*?&#]{10,12}$/",
                            'email' => "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
                            'text' => "/^[A-Za-zÀ-ÖØ-öø-ÿ\s]{2,}/",
                            // 'textarea' => "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s.,;:!?()&\"'- ]+$/",
                            'textarea' => "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s\/\@\$\!\%\*\?\&\#\.\,\;\:\!\?\(\)\"'\-\[\]]{2,}+$/",
                            'date' => "/^\d{4}-\d{2}-\d{2}$/",
                            'datetime-local' => "/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/",
                            'time' => "/^\d{2}:\d{2}$/",
                            'number' => "/^\d+$/",
                            'adress' => "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s\.\,'-]+$/",
                            'postal-code' => "/^[\d]{5}$/",
                            'phone' => "/^\+?[0-9\s\-()]+$/",
                            'select' => "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$/",
                            'file' => "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$/",
                            'url' => "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$/",
                            'search' => "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$/",
                            'checkbox' => "/^(on|off)$/",
                            'radio' => "/^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$/",
                            'color' => "/^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/",
                            'range' => "/^\d+$/",   
                            'month' => "/^\d{4}-(0[1-9]|1[0-2])$/",
                            'week' => "/^\d{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$/",

                        ];
                        return $this;
                    }
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */       
                
                

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Pattern █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    public function readPattern( ):self{
                        $this->pattern=[
                            'identifiant' => '^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-zÀ-ÖØ-öø-ÿ\d]{8,10}$', # TEST OK
                            'password' => "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\/@$!%*?&#])[A-Za-zÀ-ÖØ-öø-ÿ\d\/@$!%*?&#]{10,12}$", # TEST OK
                            'email' => "[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$", # TEST OK
                            'text' => "^[A-Za-zÀ-ÖØ-öø-ÿ_\s\-']{2,}$", # TEST OK
                            'textarea' => "^[A-Za-z0-9À-ÖØ-öø-ÿ_\s\/\@\$\!\%\*\?\&\#\.\,\;\:\!\?\(\)\"'\-\[\]]{2,}$", # TEST OK
                            'date' => "^\d{4}-\d{2}-\d{2}$",
                            'datetime-local' => "^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$", 
                            'time' => "^\d{2}:\d{2}$",
                            'number' => "^\d+$",
                            'adress' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s\.\,'\-]{2,}$",# TEST OK
                            'postal-code' => "^\d{5}$",# TEST OK
                            'phone' => "^\+?[0-9\s\-\(\)]+$",# TEST OK
                            'select' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'file' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'url' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'search' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'checkbox' => "^(on|off)$",
                            'radio' => "^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s'-]{2,}$",
                            'color' => "^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$",
                            'range' => "^\d+$",
                            'month' => "^\d{4}-(0[1-9]|1[0-2])$",
                            'week' => "^\d{4}-W(0[1-9]|[1-4][0-9]|5[0-3])$",
                            
                        ];
                        return $this;
                    }
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */                

            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
        }
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
?> 