<?php
	/* ▂ ▅ ▆ █ InModaleation █ ▆ ▅ ▂ */
		/* Toolbox VERSION: 3.0 */ 
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\Core\Render\Data;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Modale{
            /* ▂ ▅ ▆ █ Attributs █ ▆ ▅ ▂ */
                private $id_;
                private $title_;
                private $msg_;
                private $bodyContent_;
                private $image_;
                private $btnSave_;
                private $textBtnSave_;
                private $btnCancel_;
                private $textBtnCancel_;
                private $btnClose_;
                private $textBtnClose_;

            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 


            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

                /*▂ ▅ ▆ █ construct █ ▆ ▅ ▂ */
                    public function __construct( ){
                        $this -> id_ = "";
                        $this -> title_ = "Titre de la modale";
                        $this -> msg_ = "dev msg";
                        $this -> bodyContent_ = "dev body content";
                        $this -> image_ = "dev image";
                        $this -> btnSave_ = "dev btn save";
                        $this -> textBtnSave_ = "Enregistrer";
                        $this -> btnCancel_ = "dev btn cancel";
                        $this -> textBtnCancel_ = "Annuler";
                        $this -> btnClose_ = "dev btn close";
                        $this -> textBtnClose_ = "Fermer";
                    }

                /* ▂ ▅ ▆ █ Setters █ ▆ ▅ ▂ */
                    public function setId( string $id ):self{$this -> id_ = $id;return $this;}
                    public function setTitle( string $title ):self{$this -> title_ = $title;return $this;}
                    public function setMsg( string $msg ):self{$this -> msg_ = $msg;return $this;}
                    public function setBodyContent( string $bodyContent ):self{$this -> bodyContent_ = $bodyContent;return $this;}
                    public function setImage( string $image ):self{$this -> image_ = $image;return $this;}
                    public function setBtnSave( string $btnSave ):self{$this -> btnSave_ = $btnSave;return $this;}
                    public function setTextBtnSave( string $textBtnSave ):self{$this -> textBtnSave_ = $textBtnSave;return $this;}
                    public function setBtnCancel( string $btnCancel ):self{$this -> btnCancel_ = $btnCancel;return $this;}
                    public function setTextBtnCancel( string $textBtnCancel ):self{$this -> textBtnCancel_ = $textBtnCancel;return $this;}
                    public function setBtnClose( string $btnClose ):self{$this -> btnClose_ = $btnClose;return $this;}
                    public function setTextBtnClose( string $textBtnClose ):self{$this -> textBtnClose_ = $textBtnClose;return $this;}  

                /* ▂ ▅ ▆ █ Getters █ ▆ ▅ ▂ */
                    public function getId():string{return $this -> id_;}
                    public function getTitle():string{return $this -> title_;}
                    public function getMsg():string{return $this -> msg_;}
                    public function getBodyContent():string{return $this -> bodyContent_;}
                    public function getImage():string{return $this -> image_;}
                    public function getBtnSave():string{return $this -> btnSave_;}
                    public function getTextBtnSave():string{return $this -> textBtnSave_;}
                    public function getBtnCancel():string{return $this -> btnCancel_;}
                    public function getTextBtnCancel():string{return $this -> textBtnCancel_;}
                    public function getBtnClose():string{return $this -> btnClose_;}
                    public function getTextBtnClose():string{return $this -> textBtnClose_;}


                // /* ▂ ▅ ▆ █ addAtributes( ) █ ▆ ▅ ▂ */
                //     private function addAtributes( array $attributes ):string{
                //         $att="";
                //         # Read attributes and writting $att :
                //         foreach($attributes as $attribute => $value){
                //             if (($attribute == 'pattern')) {
                //                 $att .= "$attribute = $value ";
                //             }else{
                //                 $att .= "$attribute = '$value' "; 
                //             };
                //         };
                //         return $att;
                //     }
                // /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

 
            /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ DivContainerModale █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addDivContainerModaleOpen( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <div>
                //         public function addDivContainerModaleOpen( array $attributes=[] ):self{
                //             # Added to Modale comments
                //             $this -> modaleElements ="<!-- ▂ ▅ ▆ █ - StartModale - █ ▆ ▅ ▂ -->";
                //             # Added to Modale elements
                //             $this -> modaleElements .= "<div ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                //     /* ▂ ▅ ▆ █ addDivContainerModaleClose( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the close HTML tag of the </div>
                //         public function addDivContainerModaleClose( ){
                //             # Added to Modale elements
                //             $this -> modaleElements .= "</div>";
                //             # Added to Modale comments
                //             $this -> modaleElements .="<!--  ▂ ▂ ▂ ▂  - EndModale - ▂ ▂ ▂ ▂  -->";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */                

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ TitleModale █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addTitleModale( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the title HTML tag of the </Modale>
                //         public function addTitleModale(string $comment='', string $balise='', string $title='', array $attributes=[]  ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //             # Added to Modale elements
                //             $this -> modaleElements .= "<div ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             $this -> modaleElements .= "<$balise>" . $title . "</$balise>";
                //             $this -> modaleElements .= "</div>";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ <content> █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addcontent( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <br>
                //         public function addcontent( string $comment='', string $content='' ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //             # Added to Modale elements
                //             $this -> modaleElements .= $content;
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ ImageModale █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addImageModale( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the image HTML tag of the </modale>
                //         public function addImageModale(string $comment='', string $alt='', array $attributes=[]  ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //             # Added to Modale elements
                //             $this -> modaleElements .= "<img ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             $this -> modaleElements .= $alt ;
                //             $this -> modaleElements .= "</img>";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Span █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addSpan( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <span>
                //         public function addSpan(string $comment='', string $i='', array $attributes=[] ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //             # Added to Modale elements
                //             $this -> modaleElements .= "<span ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             $this -> modaleElements .="$i</span>";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ divInputGroupModaleFloating █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addDivInputGroupModaleFloatingOpen( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the Input Group Modale Floating HTML tag of the </Modale>
                //         public function addDivInputGroupModaleFloatingOpen(string $comment='', array $attributes=[]  ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements ="<!--  $comment */";};
                //             # Added to Modale elements
                //             $this -> modaleElements .= "<div ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                //     /* ▂ ▅ ▆ █ addDivInputGroupModaleFloatingClose( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the Input Group Modale Floating HTML tag of the </Modale>
                //         public function addDivInputGroupModaleFloatingClose( string $comment='' ){
                //             # Added to Modale elements
                //             $this -> modaleElements .= "</div>";
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment */";};
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Input █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addInput( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <input>
                //         public function addInput( string $comment='', array $attributes=[] ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //             # Added to Modale elements 
                //             $this -> modaleElements .= "<input ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             return $this;
                //         }   
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                //     /* ▂ ▅ ▆ █ addCheckBox( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <input>
                //         public function addCheckBox( string $comment='', array $attributes=[] ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //             # Added to Modale elements 
                //             $this -> modaleElements .= "<input ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             return $this;
                //         }   
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Ancre █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addAncre( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <button>
                //             public function addAncre( string $comment='', string $text='', array $attributes=[] ):self{
                //                 # Added to Modale comments
                //                 if($comment!=""){$this -> modaleElements .= "<!-- $comment  -->";};
                //                 # Added to Modale elements 
                //                 $this->modaleElements .= "<a ";
                //                 # And its possible attributes
                //                 $this->modaleElements .= isset($attributes) ? $this->addAtributes($attributes) . ">$text</a>" : ">$text</a>";
                //                 return $this;
                //             } 
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Div( ) █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addDivOpen( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <div>
                //         public function addDivOpen( string $comment='', array $attributes=[] ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //             # Added to Modale elements
                //             $this -> modaleElements .= "<div ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             return $this;
                //         }
                //     //* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                //     /* ▂ ▅ ▆ █ addDivClose( ) █ ▆ ▅ ▂ */
                //             # Methods for generating the close HTML tag of the </div>
                //         public function addDivClose( string $comment='' ){
                //             # Added to Modale elements
                //             $this -> modaleElements .= "</div>";
                //              # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "/* $comment */";};
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ <br> █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addBr( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <br>
                //         public function addBr( ){
                //             # Added to Modale elements
                //             $this -> modaleElements .= "<br/>";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Label( ) █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addLabel( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <label>
                //         public function addLabel( string $comment='', string $text='', array $attributes=[] ):self{
                //             # Added to Modale comments
                //             if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //             # Added to Modale elements 
                //             $this -> modaleElements .= "<label ";
                //             # And its possible attributes
                //             $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //             $this -> modaleElements .=" $text </label>";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Security █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addAntiRobot( ) █ ▆ ▅ ▂ */
                //         # Method to prevent Modale submission when submitted by a robot
                //             public function addAntiRobot($value):self{
                //                 # Added to Modale elements
                //                 $this -> ModaleElements .= "<input type='hidden' function='data-security' name='antirobot' id='antirobot' value='$value' >";
                //                 return $this;
                //             }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                //     /* ▂ ▅ ▆ █ addToken( ) █ ▆ ▅ ▂ */
                //         # Methods for creating ephemeral tokens
                //         public function addToken( ):self{
                //             # A token is instantiated each time the Modale is loaded.
                //             Token::createdToken();
                //             # Added to Modale elements
                //             $this -> ModaleElements .= "<input type='hidden' function='data-security' name='token' id='token' value='" . trim($_SESSION['token']) ."' >";
                //             // $this -> ModaleElements .= "<input type='hidden' name='token_time' id='token_time' value='" . trim($_SESSION['token_time']) ."' >";
                //             return $this;
                //         }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂   */  

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Boutton █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addBtn( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <button>
                //             public function addBtn( string $comment='',  string $text='', array $attributes=[] ):self{
                //                 # Added to Modale comments
                //                 if($comment!=""){$this -> ModaleElements .= "<!--  $comment  -->";};
                //                  # Added to Modale elements 
                //                 $this->modaleElements .= "<button ";
                //                 # And its possible attributes
                //                 $this->modaleElements .= isset($attributes) ? $this->addAtributes($attributes) . ">$text</button>" : ">$text</button>";
                //                 return $this;
                //             } 
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */


                //     /* ▂ ▅ ▆ █ addBtnAncre( ) █ ▆ ▅ ▂ */
                //         # Methods for generating the opening HTML tag of the <button>
                //             public function addBtnAncre( string $comment='', string $text='', string $href='#', array $attributes=[] ):self{
                //                 # Added to Modale comments
                //                 if($comment!=""){$this -> ModaleElements .= "<!--  $comment  -->";};
                //                  # Added to Modale elements 
                //                 $this->modaleElements .= "<a href='$href'><button ";
                //                 # And its possible attributes
                //                 $this->modaleElements .= isset($attributes) ? $this->addAtributes($attributes) . ">$text</button></a>" : ">$text</button></a>";
                //                 return $this;
                //             } 
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */







                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

                // /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Paragraph █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                //     /* ▂ ▅ ▆ █ addParagraph( ) █ ▆ ▅ ▂ */
                //     public function addParagraph( string $comment='', string $text='', array $attributes=[] ):self{
                //         # Added to Modale comments
                //         if($comment!=""){$this -> modaleElements .= "<!--  $comment  -->";};
                //         # Added to Modale elements 
                //         $this -> modaleElements .= "<p ";
                //         # And its possible attributes
                //         $this -> modaleElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                //         $this -> modaleElements .=" $text </p>";
                //         return $this;
                //     }
                //     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                // /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

        }