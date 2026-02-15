<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Controllers\Connection;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    # Class Controller
    use App\Controllers\Controller;

    # Class Form
    use App\Core\Form\Form;
    use App\Core\Form\Regex;
    use App\Core\Form\SecurityForm;

    # Class Controller & Entity & Models 
    use App\Models\User\UserModel;
    // use\App\Entities\User\User;


    #  Class Data 
    use App\Core\Render\Data\HeadData;
    use App\Core\Render\Data\MainData;
    use App\Core\Render\Data\FooterData;
    use App\Core\Render\DivMsgInformation;

    error_reporting(E_ALL);
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Grafcet █ ▆ ▅ ▂ */
    /*


    */
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class ConnectionController extends Controller {
 /* ▂ ▅ Attributs ▅ ▂ */
    # Class Form
    private $objForm_;
    private $objRegex_; 
    private $objSecurityForm_;

    # Class Controller & Entity & Models 
    private $objUserModel_;
    private $objUser_;

    #  Class Data 
    private $objHeadData_;
    private $objMainData_;
    private $objFooterData_;
    private $objDivMsgInformation_;




    /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

    /* ▂ ▅ ▆ █ __construct() █ ▆ ▅ ▂ */
    public function __construct( ){;
        # Class Form
        $this -> objForm_ = new Form();     
        $this -> objRegex_ = new Regex();  
        $this -> objSecurityForm_ = new SecurityForm();  

        # Class Controller & Entity & Models 
        $this -> objUserModel_ = new UserModel();
        // $this -> objUser_ = new User();

        #  Class Data 
        $this -> objHeadData_ = new HeadData();
        $this -> objMainData_ = new MainData();
        $this -> objFooterData_ = new FooterData(); 
        $this -> objDivMsgInformation_ = new DivMsgInformation();

    }

    /* ▂ ▅ ▆ █ login() █ ▆ ▅ ▂ */
    public function login(){
        /* ▂ ▅ ▆ █  Variables  █ ▆ ▅ ▂ */
            $form = $this->objForm_;
            /* ▂   Regex   ▂ */
            $regex = $this -> objRegex_ -> readRegex() -> getReadRegex();
            /* ▂   Tooltip   ▂ */
            $tooltip = $this -> objRegex_ -> readTooltip() -> getReadTooltip();
            /* ▂   Pattern   ▂ */
            $pattern = $this -> objRegex_ -> readPattern() -> getReadPattern();
            /* ▂   Form   ▂ */
            $action = 'App/Public/index.php?controller=Connection|Connection&action=connect';
            $method = 'POST';
            $idForm = 'login';
            $BtnSubmit_txt = 'Connection <i class="fa-solid fa-paper-plane"></i>';
            $BtnBack_txt = 'Home <i class="fa-solid fa-house"></i>';
            $BtnBack_url = 'home';

            $identifiantValue = "yannocH17";
            $passwordValue = "455501991Ym@";	

            $arrayInputidentifiant=['minLength'=>'8', 'maxLength'=>'10', 'required'=>'required', 'tooltip'=>$tooltip['identifiant'], 'pattern'=>$pattern['identifiant'], 'regex'=>$regex['identifiant'], 'label'=>'Votre identifiant', 'value'=>$identifiantValue ];
            $arrayInputpassword=['minLength'=>'10', 'maxLength'=>'12', 'required'=>'required', 'tooltip'=>$tooltip['password'], 'pattern'=>$pattern['password'], 'regex'=>$regex['password'], 'label'=>'Votre mot de passe', 'value'=>$passwordValue ];
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

        /* ▂ ▅ ▆ █  Form  █ ▆ ▅ ▂ */
            
            /* ▂ ▅ ▆ █  Header form  █ ▆ ▅ ▂ */
                $form -> addDivContainerFormOpen( [ 'name'=>'divForm-LoginaccountForm', 'id'=>'divForm-LoginaccountForm', 'class'=>'col-10 col-sm-5 col-lg-3 mb-3 py-3 text-center container-form-login' ] );
                /* @startForm( 'comment', [list of attributs] ) */
                $form -> startForm( 'startForm', [ 'name'=>'LoginaccountForm', 'id'=>$idForm, 'action'=>$action, 'method'=>$method, 'enctype'=>'multipart/form-data', 'class'=>'justify-content-center row validate',] );

                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>''] );
                    /* @addImageForm('comment', 'balise', 'text title, [list of attributs]) */
                    $form -> addImageForm( '', '', [ 'name'=>'', 'id'=>'', 'src'=>'App/Images/LogoChichoune.png','class'=>'imageForm' ] );
                /* @addTitleForm('comment', 'balise', 'text title, [list of attributs]) */
                $form -> addTitleForm( 'Title Form', 'h4', '- Connection/Créer un compte -', [ 'name'=>'', 'id'=>'', 'class'=>'titleForm fst-italic my-4' ] );
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose( '' );
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/

            /* ▂ ▅ ▆ █  Div information user  █ ▆ ▅ ▂ */
                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['id'=>'Msg-form', 'class'=>''] );

                /* @addDivClose( 'comment' ) */
                $form -> addDivClose( '' );
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

            /* ▂ ▅ ▆ █  Input group : - identifiant -  █ ▆ ▅ ▂ */
                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-2'] );
                    /* @addDivInputGroupFormFloatingOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivInputGroupFormFloatingOpen( '',  ['class'=>'input-group align-content-center has-validation'] );
                        /*-------- Picto input ----------- */
                        /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                        $form -> addSpan( '', '<i class="fa-solid fa-user"></i>', [ 'id'=>'pictoInput-identifiant', 'href'=>'#', 'class'=>'input-group-text' ]);
                        /*---------------------------- */
                        /*-------- input ----------- */
                        /* @addDivOpen( 'comment', [ list of attributs ] ) */
                        $form -> addDivOpen( '',  ['class'=>'form-floating is-invalid'] );
                            /* @addInput( 'comment', [ list of attributs ] ) */
                            $form -> addInput('', [ 'type'=>'text', 'name'=>'identifiant', 'id'=>'identifiant', 'placeholder'=>'', 'minLength'=>$arrayInputidentifiant['minLength'], 'maxLength'=>$arrayInputidentifiant['maxLength'], 'required'=>$arrayInputidentifiant['required'], 'pattern'=>$arrayInputidentifiant['pattern'], 'regex'=>$arrayInputidentifiant['regex'], 'value'=>$arrayInputidentifiant['value'], 'class'=>'form-control']);
                            /* @addLabel( 'comment', 'text', [ list of attributs ] ) */
                            $form -> addLabel( '', $arrayInputidentifiant['label'], [ 'id'=>'inputLabel-identifiant', 'for'=>'identifiant', 'class'=>'' ]);
                        /* @addDivClose( 'comment' ) */
                        $form -> addDivClose( '' );
                        /*---------------------------- */
                        /*-------- FeedBack ----------- */
                        /* @addDivOpen( 'comment', [ list of attributs ] ) */
                        $form -> addDivOpen( '',  ['id'=>'feedback-identifiant', 'class'=>'invalid-feedback'] );
                        /* @addDivClose( 'comment' ) */
                        $form -> addDivClose( '' );
                        /*---------------------------- */
                    /* @addDivInputGroupFormFloatingClose( 'comment' ) */
                    $form -> addDivInputGroupFormFloatingClose( '' );
                    /*-------- Tooltip ----------- */
                    /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                    $form -> addSpan( '', '<i class="fa-solid fa-circle-info"></i>', [ 'id'=>'addon-identifiant', 'href'=>'#', 'class'=>'pictoInfo', 'data-bs-toggle'=>'tooltip', 'data-bs-placement'=>'left', 'data-bs-html'=>'true', 'data-bs-custom-class'=>'custom-tooltip', 'data-bs-title'=>$arrayInputidentifiant['tooltip'] ]);
                    /*---------------------------- */
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose( '' );
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/

            /* ▂ ▅ ▆ █  Input group : - password -  █ ▆ ▅ ▂ */
                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-2'] );
                    /* @addDivInputGroupFormFloatingOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivInputGroupFormFloatingOpen( '',  ['class'=>'input-group align-content-center has-validation'] );
                        /*-------- Picto input ----------- */
                        /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                        $form -> addSpan( '', '<i class="fa-solid fa-lock"></i>', [ 'id'=>'pictoInput-password', 'href'=>'#', 'class'=>'input-group-text' ]);
                        /*---------------------------- */
                        /*-------- input ----------- */
                        /* @addDivOpen( 'comment', [ list of attributs ] ) */
                        $form -> addDivOpen( '',  ['class'=>'form-floating is-invalid'] );
                            /* @addInput( 'comment', [ list of attributs ] ) */
                            $form -> addInput('', [ 'type'=>'password', 'name'=>'password', 'id'=>'password', 'placeholder'=>'', 'minLength'=>$arrayInputpassword['minLength'], 'maxLength'=>$arrayInputpassword['maxLength'], 'required'=>$arrayInputpassword['required'], 'pattern'=>$arrayInputpassword['pattern'], 'regex'=>$arrayInputpassword['regex'], 'value'=>$arrayInputpassword['value'], 'class'=>'form-control']);
                            /* @addLabel( 'comment', 'text', [ list of attributs ] ) */
                            $form -> addLabel( '', $arrayInputpassword['label'], [ 'id'=>'inputLabel-password', 'for'=>'password', 'class'=>'' ]);
                        /* @addDivClose( 'comment' ) */
                        $form -> addDivClose( '' );
                        /*---------------------------- */
                        
                        /*-------- Picto input ----------- */
                        /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                        $form -> addSpan( '', '<i class="fa-solid fa-eye"></i>', [ 'id'=>'password-eye', 'href'=>'#', 'class'=>'input-group-text pictoEye' ]);
                        /*---------------------------- */

                        /*-------- FeedBack ----------- */
                        /* @addDivOpen( 'comment', [ list of attributs ] ) */
                        $form -> addDivOpen( '',  ['id'=>'feedback-password', 'class'=>'invalid-feedback'] );
                        /* @addDivClose( 'comment' ) */
                        $form -> addDivClose( '' );
                        /*---------------------------- */
                    /* @addDivInputGroupFormFloatingClose( 'comment' ) */
                    $form -> addDivInputGroupFormFloatingClose( '' );
                    /*-------- Tooltip ----------- */
                    /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                    $form -> addSpan( '', '<i class="fa-solid fa-circle-info"></i>', [ 'id'=>'addon-password', 'href'=>'#', 'class'=>'pictoInfo', 'data-bs-toggle'=>'tooltip', 'data-bs-placement'=>'left', 'data-bs-html'=>'true', 'data-bs-custom-class'=>'custom-tooltip', 'data-bs-title'=>$arrayInputpassword['tooltip'] ]);
                    /*---------------------------- */
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose( '' );
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/

            /* ▂ ▅ ▆ █  checkbox-Consent :   █ ▆ ▅ ▂ */
                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-1'] );
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['class'=>'form-check'] );
                                $form -> addCheckBox('', [ 'type'=>'checkbox', 'name'=>'check-RememberMe', 'id'=>'check-RememberMe', 'class'=>'form-check-input']);
                                /* @addLabel( 'comment', 'text', [ list of attributs ] ) */
                                $form -> addLabel( '', 'Rester Connecté', ['for'=>'check-RememberMe', 'class'=>'form-check-label fst-italic' ]);
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose();  
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['id'=>'feedback-check-RememberMe', 'class'=>'invalid-feedback'] );
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose();
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose();
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */          

            /* ▂ ▅ ▆ █  Ancre :  create-account █ ▆ ▅ ▂ */
                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-4'] );
                    /* @addAncre( 'comment', 'text de l'ancre',  [ list of attributs ] ) */
                    $form -> addAncre('', 'Créer un compte', ['href'=>'user-create', 'class'=>'link-secondary  link-offset-2 link-offset-5-hover link-opacity-80 link-opacity-100-hover link-underline-danger link-underline-opacity-0 link-underline-opacity-100-hover fst-italic'] ); 
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose();
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

            /* ▂ ▅ ▆ █  Ancre : Politique de confidentialité  █ ▆ ▅ ▂ */
                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-4'] );
                    /* @addAncre( 'comment', 'text de l'ancre',  [ list of attributs ] ) */
                    $form -> addAncre('', 'Politique de confidentialité', ['href'=>'#', 'class'=>'link-secondary  link-offset-2 link-offset-5-hover link-opacity-50 link-opacity-100-hover link-underline-danger link-underline-opacity-0 link-underline-opacity-100-hover fst-italic'] ); 
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose();
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

            /* ▂ ▅ ▆ █  Anti robot  █ ▆ ▅ ▂ */
                /* @addAntiRobot( 'value' ) */
                $form -> addAntiRobot( '' );
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

            /* ▂ ▅ ▆ █  Token  █ ▆ ▅ ▂ */
                $form -> addToken();
                # ├ Appel function Token::createdToken()
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

            /* ▂ ▅ ▆ █  Button  █ ▆ ▅ ▂ */
                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>'container'] );
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['class'=>'col d-flex justify-content-evenly'] );
                        /* @addBtn( 'comment', 'textBtn',[ list of attributs ] ) */
                        $form -> addBtn( '', $BtnSubmit_txt, [ 'type'=>'submit', 'name'=>'submit', 'id'=>'submit','value'=>'submit', 'class'=>'btn btn-primary' ] );
                        /* @addBtn( 'comment', 'textBtn',[ list of attributs ] ) */
                        $form -> addBtn( '', $BtnBack_txt, [ 'type'=>'button', 'name'=>'back', 'id'=>'back', 'data-url'=>$BtnBack_url, 'value'=>'back', 'class'=>'btn btn-danger' ] );
                        /* @addBtn( 'comment', 'textBtn',[ list of attributs ] ) */
                        //$form -> addBtn( '', '<i class="fa-solid fa-broom"></i>', [ 'type'=>'button', 'name'=>'clear', 'id'=>'clear', 'value'=>'Reset', 'class'=>'btn btn-danger' ] );										
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose();
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose();
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

            /* ▂ ▅ ▆ █  FOOTER FORM  █ ▆ ▅ ▂ */
                /* @endForm( 'comment' ) */
                $form -> endForm( 'endForm' );

                $form -> addDivContainerFormClose();
                
                /* ▂   getFormElements   ▂ */
                $form = $form -> getFormElements();
                // return $form;
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 

        /* ▂ ▅ ▆ █  Traitement  █ ▆ ▅ ▂ */
            $this->objMainData_ -> setMainForms($form);
            $this->objHeadData_ -> setTextOnglet("Aide-Ordo - Connection");
            $this->objHeadData_ -> setSheetCss("App/Css/Connection/connection-login.css");
            $this->objHeadData_ -> setScriptJs("App/Js/Common/form-V3.js");
            $this -> render('connection/connection-login', ['objHeadData' => $this->objHeadData_, 'objMainData' => $this->objMainData_, 'objFooterData' => $this->objFooterData_] );
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */ 
    }

    /* ▂ ▅ ▆ █ connect() █ ▆ ▅ ▂ */
    public function connect(){

        # Step 1.0 We define variables
        $pregMatch = $this->objRegex_ -> readPregMatch() -> getReadPregMatch();
        $regexFieldRequired=['identifiant'=>$pregMatch['identifiant'], 'password'=>$pregMatch['password'] ];
        

        # Step 2.0 We retrieve the $POST values ​​from the request
        $post=json_decode(file_get_contents('php://input'), true);

        # Step 3.0 We encode XSS & Trim	$post Cleanup
        $postEncode = $this->objSecurityForm_ -> encode_XssTrim( $post );

        # Step 4.4 We call the function SecurityForm( $setting, $redirect )
        $setting = ['method'=>'POST', 'post'=>$postEncode, 'regexFieldRequired'=> $regexFieldRequired ];
        $resultSecurityForm = $this->objSecurityForm_ -> SecurityForm( $setting, 'home' );

        # Step 5.0 We control the response of the function SecurityForm( $setting, $redirect )
        if ( $resultSecurityForm['bitErrorSecurityForm'] === true ) {
            # @ constructResponse( array $array=[ 'alertType'=>'', 'divUse'=>'', 'messageTxt'=>'', 'dataInResponse'=>[], 'redirect'=>'' ] )
            $arrayResponse = [ 'alertType'=>'danger', 'divUse'=>'Msg-form', 'messageTxt'=>$resultSecurityForm['msgErrorSecurityForm'], 'dataInResponse'=>[], 'redirect'=>'' ];
            $responseFetch = $this -> constructResponse( $arrayResponse );
            echo $responseFetch;
            exit();
        }else{

            /* ▂ ▅ ▆ CODE ▆ ▅ ▂ */

                # Step 6.0 We search identifiant in database 
                $results = $this->objUserModel_ -> searchValue( 'identifiant', $postEncode['identifiant'] );

                if ( $results['error'] == '' ) {

                        # Step 7.0 We verify identifant 
                        if ( $postEncode['identifiant'] === $results['dataRequest'][0]->identifiant ) {

                            # Step 7.0 We verify the password with the hash stored in database
                            if ( password_verify( $postEncode['password'], $results['dataRequest'][0]->password ) ) {
                                # Step 8.0 regenerate session id
                                session_regenerate_id(true);

                                # Step 9.0 set $_SESSION variables
                                $_SESSION['User'] = [
                                    'id'=>$results['dataRequest'][0]->idUserAccount ,
                                    'userName'=>$results['dataRequest'][0]->userName,
                                    'firstName'=>$results['dataRequest'][0]->userFirstName,
                                    'userEmail'=>$results['dataRequest'][0]->userEmail,
                                    'userAccess'=>$results['dataRequest'][0]->userAccess,
                                    'userConnected'=>true
                                ];

                                # Step 10.0 We create session and we return success message
                                # @ constructResponse( array $array=[ 'alertType'=>'', 'divUse'=>'', 'messageTxt'=>'', 'dataInResponse'=>[], 'redirect'=>'' ] )
                                $arrayResponse = [ 'alertType'=>'success', 'divUse'=>'Msg-form', 'messageTxt'=>'Vous êtes connecté avec succès !', 'dataInResponse'=>[], 'redirect'=>'home' ];
                                $responseFetch = $this -> constructResponse( $arrayResponse );
                                echo $responseFetch;
                                exit();

                            }else{

                                # @ constructResponse( array $array=[ 'alertType'=>'', 'divUse'=>'', 'messageTxt'=>'', 'dataInResponse'=>[], 'redirect'=>'' ] ) 
                                $arrayResponse = [ 'alertType'=>'warning', 'divUse'=>'Msg-form', 'messageTxt'=>'Mot de passe incorrect.', 'dataInResponse'=>[], 'redirect'=>'' ];
                                $responseFetch = $this -> constructResponse( $arrayResponse );
                                echo $responseFetch;
                                exit();
                            };
                        }else{

                            # @ constructResponse( array $array=[ 'alertType'=>'', 'divUse'=>'', 'messageTxt'=>'', 'dataInResponse'=>[], 'redirect'=>'' ] )
                            $arrayResponse = [ 'alertType'=>'warning', 'divUse'=>'Msg-form', 'messageTxt'=>'Identifiant incorrect.', 'dataInResponse'=>[], 'redirect'=>'' ];
                            $responseFetch = $this -> constructResponse( $arrayResponse );
                            echo $responseFetch;
                            exit();
                        };

                }else{

                    # @ constructResponse( array $array=[ 'alertType'=>'', 'divUse'=>'', 'messageTxt'=>'', 'dataInResponse'=>[], 'redirect'=>'' ] )
                    $arrayResponse = [ 'alertType'=>'danger', 'divUse'=>'Msg-form', 'messageTxt'=>$results['error']->getMessage(), 'dataInResponse'=>[], 'redirect'=>'' ];
                    $responseFetch = $this -> constructResponse( $arrayResponse );
                    echo $responseFetch;
                    exit();

                };
            /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */

        }

    }


    /* ▂ ▅ ▆ █ disconnect( )█ ▆ ▅ ▂ */
    public function disconnect(){
        unset($_SESSION['token']);
        unset($_SESSION['token_time']);
        unset($_SESSION['User']);
        session_destroy();
        header('Location: home');
        exit();
    }


    /* ▂ ▅ ▆ █ disconnect( )█ ▆ ▅ ▂ */
    # @ constructResponse( array $array=[ 'alertType'=>'', 'divUse'=>'', 'messageTxt'=>'', 'dataInResponse'=>[], 'redirect'=>'' ] )
    private function constructResponse( array $array ) {
            switch ($array['alertType']) {
                case 'primary':
                    # code if primary #031633 
                    $messageProcess = $this->objDivMsgInformation_ -> getPrimary( $array['messageTxt']);
                    break;
                case 'secondary':
                    # code if secondary #161719
                    $messageProcess = $this->objDivMsgInformation_ -> getSecondary( $array['messageTxt'] );
                    break;
                case 'danger':
                    # code if danger #2c0b0e
                    $messageProcess = $this->objDivMsgInformation_ -> getDanger( $array['messageTxt'] );
                    break;
                case 'warning':
                    # code if warning #332701
                    $messageProcess = $this->objDivMsgInformation_ -> getWarning( $array['messageTxt'] );
                    break;
                case 'info':
                    # code if info #0dcaf0
                    $messageProcess = $this->objDivMsgInformation_ -> getInfo( $array['messageTxt'] );
                    break;
                case 'light':
                    # code if light #f8f9fa
                    $messageProcess = $this->objDivMsgInformation_ -> getLight( $array['messageTxt'] );
                    break;
                case 'dark':
                    # code if dark #212529
                    $messageProcess = $this->objDivMsgInformation_ -> getDark( $array['messageTxt'] );
                    break;
                case 'success':
                    # code if success
                    $messageProcess = $this->objDivMsgInformation_ -> getSuccess( $array['messageTxt'] );
                    break;
            };
            # @ $reponseFetch = [ 'alertType'=>'', 'divUse'=>'', 'messageTxt'=>'', 'dataInResponse'=>[], 'redirect'=>'' ]
            $responseFetch = [ 'divUse'=>$array['divUse'], 'messageTxt'=>$messageProcess, 'dataInResponse'=>$array['dataInResponse'], 'redirect'=>$array['redirect']];       
            if( is_array($array) ){
                # We return the response in json format
                return json_encode($responseFetch, JSON_UNESCAPED_SLASHES);
            }else{
                # We return the response in string format
                return $responseFetch;
            };



    }
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
};