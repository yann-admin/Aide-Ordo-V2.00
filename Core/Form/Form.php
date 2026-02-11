<?php
	/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
		/* Toolbox VERSION: 3.0 */ 
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\Core\Form;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
        use App\Core\Form\Token;
        use App\Core\Form\Files;
	/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Form{
            /* ▂ ▅ ▆ █ Attributs █ ▆ ▅ ▂ */
                private $formElements;
            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

            /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

                /*▂ ▅ ▆ █ construct █ ▆ ▅ ▂ */
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▆ █ Getters █ ▆ ▅ ▂ */
                    public function getFormElements( ){ return $this -> formElements; }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

                /* ▂ ▅ ▆ █ addAtributes( ) █ ▆ ▅ ▂ */
                    private function addAtributes( array $attributes ):string{
                        $att="";
                        # Read attributes and writting $att :
                        foreach($attributes as $attribute => $value){
                            if (($attribute == 'pattern')) {
                                $att .= "$attribute = $value ";
                            }else{
                                $att .= "$attribute = '$value' "; 
                            };
                        };
                        return $att;
                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ DivContainerForm █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addDivContainerFormOpen( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <div>
                        public function addDivContainerFormOpen( array $attributes=[] ):self{
                            # Added to form comments
                            $this -> formElements ="<!-- ▂ ▅ ▆ █ - StartForm - █ ▆ ▅ ▂ -->";
                            # Added to form elements
                            $this -> formElements .= "<div ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                    /* ▂ ▅ ▆ █ addDivContainerFormClose( ) █ ▆ ▅ ▂ */
                        # Methods for generating the close HTML tag of the </div>
                        public function addDivContainerFormClose( ){
                            # Added to form elements
                            $this -> formElements .= "</div>";
                            # Added to form comments
                            $this -> formElements .="<!--  ▂ ▂ ▂ ▂  - EndForm - ▂ ▂ ▂ ▂  -->";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */                

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Form █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ startForm( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <form>
                        public function startForm(string $comment='',  array $attributes=[] ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements
                            $this -> formElements .= "<form ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                    /* ▂ ▅ ▆ █ endForm( ) █ ▆ ▅ ▂ */
                        # Methods for generating the close HTML tag of the </form>
                        public function endForm(string $comment='' ):self{
                            # Added to form elements
                            $this -> formElements .= "</form>";
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment -->";};
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ TitleForm █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addTitleForm( ) █ ▆ ▅ ▂ */
                        # Methods for generating the title HTML tag of the </form>
                        public function addTitleForm(string $comment='', string $balise='', string $title='', array $attributes=[]  ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements
                            $this -> formElements .= "<div ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            $this -> formElements .= "<$balise>" . $title . "</$balise>";
                            $this -> formElements .= "</div>";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ ImageForm █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addTitleForm( ) █ ▆ ▅ ▂ */
                        # Methods for generating the title HTML tag of the </form>
                        public function addImageForm(string $comment='', string $alt='', array $attributes=[]  ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements
                            $this -> formElements .= "<img ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            $this -> formElements .= $alt ;
                            $this -> formElements .= "</img>";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Span █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addSpan( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <span>
                        public function addSpan(string $comment='', string $i='', array $attributes=[] ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements
                            $this -> formElements .= "<span ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            $this -> formElements .="$i</span>";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ divInputGroupFormFloating █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addDivInputGroupFormFloatingOpen( ) █ ▆ ▅ ▂ */
                        # Methods for generating the Input Group Form Floating HTML tag of the </form>
                        public function addDivInputGroupFormFloatingOpen(string $comment='', array $attributes=[]  ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements ="<!--  $comment */";};
                            # Added to form elements
                            $this -> formElements .= "<div ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                    /* ▂ ▅ ▆ █ addDivInputGroupFormFloatingClose( ) █ ▆ ▅ ▂ */
                        # Methods for generating the Input Group Form Floating HTML tag of the </form>
                        public function addDivInputGroupFormFloatingClose( string $comment='' ){
                            # Added to form elements
                            $this -> formElements .= "</div>";
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment */";};
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Input █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addInput( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <input>
                        public function addInput( string $comment='', array $attributes=[] ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements 
                            $this -> formElements .= "<input ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            return $this;
                        }   
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                    /* ▂ ▅ ▆ █ addCheckBox( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <input>
                        public function addCheckBox( string $comment='', array $attributes=[] ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements 
                            $this -> formElements .= "<input ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            return $this;
                        }   
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Ancre █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addAncre( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <button>
                            public function addAncre( string $comment='', string $text='', array $attributes=[] ):self{
                                # Added to form comments
                                if($comment!=""){$this -> formElements .= "<!-- $comment  -->";};
                                # Added to form elements 
                                $this->formElements .= "<a ";
                                # And its possible attributes
                                $this->formElements .= isset($attributes) ? $this->addAtributes($attributes) . ">$text</a>" : ">$text</a>";
                                return $this;
                            } 
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Div( ) █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addDivOpen( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <div>
                        public function addDivOpen( string $comment='', array $attributes=[] ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements
                            $this -> formElements .= "<div ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            return $this;
                        }
                    //* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                    /* ▂ ▅ ▆ █ addDivClose( ) █ ▆ ▅ ▂ */
                            # Methods for generating the close HTML tag of the </div>
                        public function addDivClose( string $comment='' ){
                            # Added to form elements
                            $this -> formElements .= "</div>";
                             # Added to form comments
                            if($comment!=""){$this -> formElements .= "/* $comment */";};
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ <br> █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addBr( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <br>
                        public function addBr( ){
                            # Added to form elements
                            $this -> formElements .= "<br/>";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Label( ) █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addLabel( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <label>
                        public function addLabel( string $comment='', string $text='', array $attributes=[] ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements 
                            $this -> formElements .= "<label ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            $this -> formElements .=" $text </label>";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Security █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addAntiRobot( ) █ ▆ ▅ ▂ */
                        # Method to prevent form submission when submitted by a robot
                            public function addAntiRobot($value):self{
                                # Added to form elements
                                $this -> formElements .= "<input type='hidden' function='data-security' name='antirobot' id='antirobot' value='$value' >";
                                return $this;
                            }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                    /* ▂ ▅ ▆ █ addToken( ) █ ▆ ▅ ▂ */
                        # Methods for creating ephemeral tokens
                        public function addToken( ):self{
                            # A token is instantiated each time the form is loaded.
                            Token::createdToken();
                            # Added to form elements
                            $this -> formElements .= "<input type='hidden' function='data-security' name='token' id='token' value='" . trim($_SESSION['token']) ."' >";
                            // $this -> formElements .= "<input type='hidden' name='token_time' id='token_time' value='" . trim($_SESSION['token_time']) ."' >";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂   */  

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Boutton █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addBtn( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <button>
                            public function addBtn( string $comment='',  string $text='', array $attributes=[] ):self{
                                # Added to form comments
                                if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                                 # Added to form elements 
                                $this->formElements .= "<button ";
                                # And its possible attributes
                                $this->formElements .= isset($attributes) ? $this->addAtributes($attributes) . ">$text</button>" : ">$text</button>";
                                return $this;
                            } 
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ DivContainerForm( ) █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
        }
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
?>