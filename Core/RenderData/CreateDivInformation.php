<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Core\RenderData;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
    class CreateDivInformation {
        /* ▂ ▅ Attributs ▅ ▂ */
            private $textInfo_ ;
            private $resulat_ ;
        /* ▂▂▂▂▂▂▂▂▂▂▂ */

        /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

        // /*▂ ▅ ▆ █ construct █ ▆ ▅ ▂ */
        //     # @ objUserInformation($type='', $textInfo='')
        //     public function __construct($textInfo=''){
        //         $this -> textInfo_ = $textInfo;
        //     }
        // /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

        // /*▂ ▅ ▆ █ Setters █ ▆ ▅ ▂ */
        //     public function setTextInfo($textInfo){ $this -> textInfo_ = $textInfo; }
        // /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


        /* ▂ ▅ ▆ █ Getters █ ▆ ▅ ▂ */ 
            public function getPrimary( $messageProcess ){ # #031633
                $this -> resulat_='';
                $this -> resulat_='<p class="alert alert-primary mb-2 p-0" role="alert">'. $messageProcess . '</p>';
                return $this -> resulat_; 
            }

            public function getSecondary( $messageProcess ){ # #161719
                $this -> resulat_='';
                $this -> resulat_='<p class="alert alert-secondary mb-2 p-0" role="alert">'. $messageProcess . '</p>';
                return $this -> resulat_; 
            }

            public function getSuccess( $messageProcess ){ # #198754
                $this -> resulat_='';
                $this -> resulat_='<p class="alert alert-success mb-2 p-0" role="alert">'. $messageProcess . '</p>';
                return $this -> resulat_; 
            }

            public function getDanger( $messageProcess){ # #2c0b0e
                $this -> resulat_='';
                $this -> resulat_='<p class="alert alert-danger mb-2 p-0" role="alert"> '. $messageProcess . '</p>';
                return $this -> resulat_;
            }

            public function getWarning( $messageProcess ){ # #332701
                $this -> resulat_='';
                $this -> resulat_='<p class="alert alert-warning mb-2 p-0" role="alert">'. $messageProcess . '</p>';
                return $this -> resulat_;
            }

            public function getInfo( $messageProcess ){ # #0dcaf0
                $this -> resulat_='';
                $this -> resulat_='<p class="alert alert-info mb-2 p-0" role="alert">'. $messageProcess . '</p>';
                return $this -> resulat_;
            }

            public function getLight( $messageProcess ){ # #f8f9fa 
                $this -> resulat_='';
                $this -> resulat_='<p class="alert alert-light mb-2 p-0" role="alert">'. $messageProcess . '</p>';
                return $this -> resulat_;
            }

            public function getDark( $messageProcess ){ # #212529
                $this -> resulat_='';
                $this -> resulat_='<p class="alert alert-dark mb-2 p-0" role="alert">'. $messageProcess . '</p>';
                return $this -> resulat_;
            }
        /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
            

    }; 
?>