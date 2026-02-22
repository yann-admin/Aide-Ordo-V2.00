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
        class FormGroupInput{
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
                        foreach($attributes as $attribute => $value ){
                            if($attribute == 'label' || $attribute == 'options' || $attribute == 'text' || $attribute == 'balise' ){
                                continue;
                            }
                            if ( ($attribute == 'pattern')  ) {
                                $att .= "$attribute = $value ";
                            }else{
                                $att .= "$attribute = '$value' "; #'$value'
                            };

                        };
                        return $att;
                    }
                /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

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

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ Div  █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <div>
                        public function addDivOpen( string $comment='Div Open', array $attributes=[] ):self{
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
                        public function addDivClose( string $comment='Div Close' ){
                            # Added to form elements
                            $this -> formElements .= "</div>";
                             # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!-- $comment -->";};
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ addInputGroup █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addInputGroup( ) █ ▆ ▅ ▂ */
                        # Methods for generating the opening HTML tag of the <input>
                        # @ addInputGroup( string $comment='', string $iSpan1, string $iSpan2, array $attributes=[] )
                        public function addInputGroup( string $comment, $span1, $span2, array $attributes=[] ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements 
                            $this -> formElements .= "<div class = 'input-group align-content-center has-validation' >";
                                if($span1!="" ){
                                $this -> formElements .= "<!--  Picto input  -->";
                                $this -> formElements .= "<span id='pictoInput-nameFactory', href='#', class='input-group-text' > $span1 </span>";
                                };
                                $this -> formElements .= "<!--  Input  -->";
                                $this -> formElements .= "<div class='form-floating is-invalid' >";
                                    $this -> formElements .= "<input ";
                                    # And its possible attributes
                                    $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                                    $this -> formElements .= "<label for={$attributes['id']}> {$attributes['label']} </label>";
                                $this -> formElements .= "</div>";  
                                $this -> formElements .= "<!--  FeedBack  -->";
                                $this -> formElements .= "<div id='feedback-{$attributes['id']}' class='invalid-feedback' >";
                                $this -> formElements .= "</div>";
                            $this -> formElements .= "</div>"; 
                            if($span2!="" ){
                                $this -> formElements .= "<span id='addon-{$attributes['id']}', href='#', class='pictoInfo', data-bs-toggle='tooltip', data-bs-placement='left', data-bs-html='true', data-bs-custom-class='custom-tooltip', data-bs-title='{$attributes['title']}'> $span2 </span>";
                            };
                            return $this;
                        }   
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

                    /* ▂ ▅ ▆ █ addInputGroupSelect( ) █ ▆ ▅ ▂ */
                    # Methodes génrérant un select avec l'ouverture de la balise <select> et des attributs 'name'
                        # @ addInputGroupSelect( string $comment, string $iSpan1, string $iSpan2, string $id, string $name, array $attributes=[] )
                        public function addInputGroupSelect(string $comment,  $span1, $span2, $id, $name, array $attributes=[]):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements 
                            $this -> formElements .= "<div class = 'input-group align-content-center has-validation' >";
                                if($span1!="" ){
                                $this -> formElements .= "<!--  Picto input  -->";
                                $this -> formElements .= "<span id='pictoInput-nameFactory', href='#', class='input-group-text' > $span1 </span>";
                                };
                                $this -> formElements .= "<!--  Input  -->";
                                $this -> formElements .= "<div class='form-floating is-invalid' >";
                                    $this -> formElements .= "<select ";
                                    # And its possible attributes
                                    $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                                    # We add options if they exist
                                    $this -> formElements .="<option value =''>Sélectionner...</option>";
                                    if(isset($attributes['options'] ) && count($attributes['options'])>0 ){

                                        foreach ($attributes['options'] as $key => $option) {
                                            if(isset($attributes['value']) && ($option['value'] == $attributes['value'])){
                                                $this -> formElements .="<option value ='{$option['value']}' selected>{$option['text']}</option>";
                                            }else{
                                                $this -> formElements .="<option value ='{$option['value']}'>{$option['text']}</option>";
                                            };
                                        };

                                    };
                                    $this -> formElements .="</select>";
                                    $this -> formElements .= "<label for={$attributes['id']}> {$attributes['label']} </label>";
                                $this -> formElements .= "</div>"; 
                                $this -> formElements .= "<!--  FeedBack  -->";
                                // $this -> formElements .= "<div id='feedback-{$attributes['id']}' class='' >"; #invalid-feedback
                                // $this -> formElements .= "</div>";
                            $this -> formElements .= "</div>"; 
                            if($span2!="" ){
                                $this -> formElements .= "<span id='addon-{$attributes['id']}', href='#', class='pictoInfo', data-bs-toggle='tooltip', data-bs-placement='left', data-bs-html='true', data-bs-custom-class='custom-tooltip', data-bs-title='{$attributes['title']}'> $span2 </span>";
                            };
                            return $this;
                        }   
                     /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */


                    // /* ▂ ▅ ▆ █ addInputGroupSelect( ) █ ▆ ▅ ▂ */
                    // # Methodes génrérant un select avec l'ouverture de la balise <select> et des attributs 'name'
                    //     public function addSelectId( string $name, string $idSelected, $nameKey, $nameValue, array $tableau, array $attributes=[]):self{
                            // //on commence la création du select 
                            // $this->formElements .= "<select name='$name'";
                            // //Et ses attributs éventuels
                            // $this->formElements .= isset($attributes) ? $this->addAtributes($attributes) . ">" : ">";
                            // //On ajoute les balises options
                            //     $this->formElements .="<option value =''>Sélectionner...</option>";
                            //     for ($row=0 ; $row<count($tableau) ; $row++){
                            //         if($idSelected!="" && ($idSelected==$tableau[$row]->$nameKey)){
                            //         $key = $tableau[$row]->$nameKey;
                            //         $value = $tableau[$row]->$nameValue;
                            //         $this->formElements .="<option value =$key selected>$value</option>";
                            //         }else{
                            //         $key = $tableau[$row]->$nameKey;
                            //         $value = $tableau[$row]->$nameValue;
                            //         $this->formElements .="<option value =$key>$value</option>";
                            //         }
                            //     };
                            // $this->formElements .="</select>";
                            // return $this;
                    //     }   
                    //  /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */





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


                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ TitleForm █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addTitleForm( ) █ ▆ ▅ ▂ */
                        # Methods for generating the title HTML tag of the </form>
                        public function addTitleForm(string $comment='', array $attributes=[]  ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements
                            $this -> formElements .= "<div ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            $this -> formElements .= "<{$attributes['balise']}>" . $attributes['text'] . "</{$attributes['balise']}>";
                            $this -> formElements .= "</div>";
                            return $this;
                        }
                    /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

                /* ▂ ▅ ▅ ▅ ▆ ▆ ▆ █ █ █ ImageForm █ █ █ ▆ ▆ ▆ ▅ ▅ ▅ ▂ */
                    /* ▂ ▅ ▆ █ addTitleForm( ) █ ▆ ▅ ▂ */
                        # Methods for generating the title HTML tag of the </form>
                        public function addImageForm(string $comment='', array $attributes=[]  ):self{
                            # Added to form comments
                            if($comment!=""){$this -> formElements .= "<!--  $comment  -->";};
                            # Added to form elements
                            $this -> formElements .= "<img ";
                            # And its possible attributes
                            $this -> formElements .= isset($attributes) ? $this -> addAtributes($attributes) . ">" : ">";
                            //$this -> formElements .= $alt ;
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
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 
 
        }
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
?>