<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier controller database: api_chichoune - table: useraccount via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Controllers\User;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */

    use App\Core\Other\Session;

    # Class Controller
    use App\Controllers\Controller;

    # Class Form
    use App\Core\Form\Form;
    use App\Core\Form\Regex;
    use App\Core\Form\Token;
    use App\Core\Form\SecurityForm;

    # Class Entity & Models UserAccount
    use App\Models\Database\DatabaseModel;
    use App\Entities\User\User;
    use App\Models\User\UserModel;

    # Class Controllers & Entity & Models CookiesRemember
    use App\Entities\CookiesRemember\CookiesRemember;
    use App\Models\CookiesRemember\CookiesRememberModel;

    // #  Class RenderData & ResponseJson & CreateDivInformation
    use App\Core\RenderData\RenderData;
    use App\Core\RenderData\ResponseJson;
    use App\Core\RenderData\CreateDivInformation;

    // # Class other
    use App\Core\Other\HeadData;
    use App\Core\Other\FooterData;

    error_reporting(E_ALL);
    
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 


/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class UserController extends Controller{
/* ▂ ▅ ▆ █    Attributs    █ ▆ ▅ ▂ */
    # Attributs data for views
    private $objHeadData_;
    private $objFooterData_;
    private $objRenderData_;
    # Attributs Entity & Models 
    private $objUser_;
    private $objUserModel_;
    private $objDatabaseModel_;
    # Attributs Form
    private $objRegex_;
    private $objSecurityForm_;
    private $objForm_;
    # Attributs other
    private $objResponseJson_;
    private $objCreateDivInformation_;
    # Attributs CookiesRemember
    private $objCookiesRemember_;
    private $objCookiesRememberModel_;

/* ▂ ▅ ▆ █ __construct() █ ▆ ▅ ▂ */
public function __construct() {
    # Attributs data for views
    $this->objHeadData_ = new HeadData();
    $this->objFooterData_ = new FooterData();
    $this->objRenderData_ = new RenderData(); 
    # Attributs Entity & Models
    $this->objDatabaseModel_ = new DatabaseModel();
    $this->objUser_ = new User();
    $this->objUserModel_ = new UserModel();
    # Attributs Form
    $this->objRegex_ = new Regex();
    $this->objForm_ = new Form();
    $this->objSecurityForm_ = new SecurityForm();
    # Attributs other
    $this->objResponseJson_ = new ResponseJson();
    $this->objCreateDivInformation_ = new CreateDivInformation();
    # Attributs CookiesRemember
    $this->objCookiesRemember_ = new CookiesRemember();
    $this->objCookiesRememberModel_ = new CookiesRememberModel();

}

/* ▂ ▅ ▆ █    Methodes    █ ▆ ▅ ▂ */

    /* ▂ ▅ ▆ █ userShowFormLogin() █ ▆ ▅ ▂ */
    public function userShowFormLogin() {
        # Step 1.0: We construct the form
        $form = $this->constructFormUserLogin( );
        # Step 2.0: We render the view user/form with the data of head and footer and form
        $this -> objRenderData_->hydrate([
            'forms_' => $form,
            'ongletText_' => "Login - Chichoune Api",
            'sheetCss_' => "App/Css/formLoginAccount.css",
            'scriptJs_' => "App/Js/scriptPage/form-V3.js",
            'other_' => "Bienvenue sur la plateforme d'aide pour l'ordonnancement. \n Veuillez vous connecter pour accéder à votre espace personnalisé ou créer un compte si vous n'en avez pas encore.",
        ]);
        # Step 3.0 We render the view
        $this -> render('user/form', ['HeadData' => $this->objHeadData_, 'RenderData' => $this->objRenderData_, 'FooterData' => $this->objFooterData_] ); 
    }

    /* ▂ ▅ ▆ █  userShowFormAccount( )  █ ▆ ▅ ▂ */
    public function userShowFormAccount( ){
        $form = $this->constructFormUserAccount( 'create' );
        # Step 3.0: We render the view user/form with the data of head and footer and form
        $this -> objRenderData_->hydrate([
            'forms_' => $form,
            'ongletText_' => "Account - Chichoune Api",
            'sheetCss_' => "App/Css/formLoginAccount.css",
            'scriptJs_' => "App/Js/scriptPage/form-V3.js",
            'other_' => "",
        ]);
        # Step 4.0 We render the view
        $this -> render('user/form', ['HeadData' => $this->objHeadData_, 'RenderData' => $this->objRenderData_, 'FooterData' => $this->objFooterData_] ); 
    }

    /* ▂ ▅ ▆ █  userConnect( )  █ ▆ ▅ ▂ */
    public function userConnect( ){
        /* MEMO:  
                - Step 1.0 We define variables
                - Step 2.0 We retrieve the $POST values ​​from the request
                - Step 3.0 We encode XSS & Trim	$post Cleanup
                - Step 4.0 created regex pattern list
                - Step 5.0 created setting array
                - Step 6.0 We call the function SecurityForm( $setting )
                - Step 7.0 procees if no error else error
                    - Step 8.0 We find by identifiant in database @findJointByIdentifiant( string $identifiant )
                        - Step 8.1
                            - if not error PDO we verify if identifiant exist
                                - if identifiant exist we verify the password with password_verify( $postEncode['password'], $resultFind->password )
                                    - if password is ok we set $errorProcess = 'success' and $messageProcess with the message of success and we set session and redirect
                                    - if password is not ok we set $errorProcess = 'danger' and $messageProcess with the message of error
                                - if identifiant not exist we set $errorProcess = 'danger' and $messageProcess with the message of error
                            - if error PDO we set $errorProcess = '' and $messageProcess with the message of error PDO
                            - if error we set $errorProcess = 'danger' and $messageProcess with the message of error SecurityForm
                            - END PROCESS: switch ($errorProcess) to set status, divMsgUser, messageProcess for response json
                        - Step 8.2 We verify if the identifiant exist in database
                            - Step 8.2.1 if password is ok we set $errorProcess = 'success' and $messageProcess with the message of success and we set session and redirect
                            - Step 8.2.2 If cookie remember me is not set we set cookie remember me with the identifiant and a token
                - End process: switch ($errorProcess) to set status, divMsgUser, messageProcess for response json        

        */
        # Step 1.0 We define variables
        /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
        $status= false; $divMsgUser = "Msg-form"; $messageProcess = ""; $data = []; $redirect = ""; 
        $errorProcess = '';

        $pregMatch = $this->objRegex_ -> readPregMatch() -> getReadPregMatch();
        # Step 2.0 We retrieve the $POST values ​​from the request
        $post=json_decode(file_get_contents('php://input'), true);
        # Step 3.0 We encode XSS & Trim	$post Cleanup
        $postEncode = $this->objSecurityForm_ -> encode_XssTrim( $post );	
        # Step 4.0 created regex pattern list
        $regexFieldRequired=[ 'identifiant'=>$pregMatch['identifiant'], 'password'=>$pregMatch['password'] ];  
        # Step 5.0 created setting array                         
        $setting = ['method'=>'POST', 'post'=>$postEncode, 'regexFieldRequired'=> $regexFieldRequired ]; 
        # Step 6.0 We call the function SecurityForm( $setting )
        $responseSecurityForm = $this->objSecurityForm_ -> SecurityForm( $setting, 'user-login' ); 
        # Step 7.0 procees if no error else error
        if( ! $responseSecurityForm['bitErrorSecurityForm']){
            /* ▂ ▅ ▆ █ Code following function █ ▆ ▅ ▂ */
                # Step 8.0 We find by identifiant in database @findJointByIdentifiant( string $identifiant )
                $resultFind = $this->objUserModel_ -> findJointByIdentifiant( $postEncode['identifiant'] );
                if ( !isset($resultFind->errorText)  ) {
                    # Step 8.1 if not error PDO we verify if identifiant exist
                    if ( $resultFind !== '' && $resultFind->identifiant === $postEncode['identifiant'] ) {
                        # Step 8.2 if identifiant exist we verify the password with password_verify( $postEncode['password'], $resultFind->password )
                        if ( password_verify( $postEncode['password'], $resultFind -> password ) ) {
                            # Step 8.2.1 if password is ok we set $errorProcess = 'success' and $messageProcess with the message of success and we set session and redirect
                            /* Set Session */
                            $_SESSION['connected'] = true;
                            $_SESSION['UserInformation'] = [
                                'idUserAccount' => $resultFind -> idUserAccount,
                                'userName' => $resultFind -> userName,
                                'userFirstName' => $resultFind -> userFirstName,
                                'userEmail' => $resultFind -> userEmail,
                                'userAccess' => $resultFind -> userAccess,
                            ];
                            # Step 8.2.2 Cookies Remember ( if user want remember me )
                            if (! isset($_COOKIE['rememberMe'])){
                                # Step code 8.2.2.1 if "Remember Me" checkbox is checked we create a remember me cookie with a token and we save the token in the database with the idUserAccount
                                if( isset($postEncode['check-RememberMe']) && $postEncode['check-RememberMe'] === 'on' ){
                                    # Step code 8.2.2.2 We create cookie remember 
                                    $cookies = ['adressIp'=> $_SERVER['REMOTE_ADDR'], 
                                                'idUserAccount' => $resultFind -> idUserAccount, 
                                                'idLoginAccount' => $resultFind -> idLoginAccount, 
                                                'endDate' => time() + ($_ENV['END_DATE_REMEMBER_ME'])
                                                ];
                                    # Attributs CookiesRemember
                                    $this->objCookiesRemember_ -> createCookieCrypted( $cookies );
                                    $objCookiesRemember = $this->objCookiesRemember_; # Step code
                                    $addCookies = $this->objCookiesRememberModel_ -> addCookies( $objCookiesRemember,  $cookies );

                                    if( gettype($addCookies) == "boolean" ){
                                        if ( $addCookies ) {
                                            $objCookies= $objCookiesRemember -> getCookiesCrypted( );
                                            # Step code 8.2.2.3 set cookie remember 
                                            setcookie("rememberMe", $objCookies, (time() + $_ENV['END_DATE_REMEMBER_ME']), "/", $_ENV['DOMAINE'], true, true);
                                        };
                                    }else{
                                        # error PDO
                                        $errorProcess = 'danger';
                                        $messageProcess = "Error PDO in createCookieRemember ". "\n" . $addCookies -> errorText;
                                        goto endProcess;
                                    };

                                };
                            };

                            # Step 8.2.3 we set $errorProcess = 'success' and $messageProcess with the message of success and we set session and redirect
                            $errorProcess = 'success';
                            $messageProcess = "Connexion réussie. Redirection en cours...";
                            goto endProcess;

                        } else {
                            # Step 8.2.2 if password is not ok we set $errorProcess = 'danger' and $messageProcess with the message of error
                            $errorProcess = 'danger';
                            $messageProcess = "Le mot de passe n'est pas correct. Veuillez vérifier votre mot de passe.";
                            goto endProcess;
                        };

                    } else {
                        # Step 8.1 if identifiant not exist 
                        $errorProcess = 'danger';
                        $messageProcess = "L'identifiant n'est pas correct. Veuillez vérifier votre identifiant.";
                        goto endProcess;
                    };

                }else{
                    # error PDO
                    $errorProcess = '';
                    $messageProcess = "Error PDO in duplicateCheck email ". "\n" . $resultFind -> errorText;
                    goto endProcess;
                };

            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

        }else{
            # Step 7.1 if error we set $errorProcess = 1 and $messageProcess with the message of the error
            $errorProcess = 'danger';
            $messageProcess = $responseSecurityForm['msgErrorSecurityForm'];
            /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
            //$status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
        };

        /* ▂ ▅ ▆ █  END PROCESS  █ ▆ ▅ ▂ */
            endProcess:
            switch ($errorProcess) {
                case 'primary':
                    # code if primary #031633 
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getPrimary( $messageProcess);
                    break;
                case 'secondary':
                    # code if secondary #161719
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getSecondary( $messageProcess );
                    break;
                case 'danger':
                    # code if danger #2c0b0e
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                    break;
                case 'warning':
                    # code if warning #332701
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getWarning( $messageProcess );
                    break;
                case 'info':
                    # code if info #0dcaf0
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getInfo( $messageProcess );
                    break;
                case 'light':
                    # code if light #f8f9fa
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getLight( $messageProcess );
                    break;
                case 'dark':
                    # code if dark #212529
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDark( $messageProcess );
                    break;
                case 'success':
                    # code if success
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
                    $status= true; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "home";
                    $messageProcess = $this->objCreateDivInformation_ -> getSuccess( $messageProcess );
                    break;
                default:
                    # code if errorProcess is exceptionPDO
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                    break;
            }   

            $responseFetch = [ "status"=>$status, "div"=>$divMsgUser, "msg"=>$messageProcess, "data"=>$data, "redirect"=>$redirect ];
            echo ($this->objResponseJson_ -> responseFetch( $responseFetch ));        
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

    }


    /* ▂ ▅ ▆ █  checkCookieRemember( $cookieRemember)  █ ▆ ▅ ▂ */
    Public function checkCookieRemember( $cookieRemember ){ 
        # Step 1.0 We define variables
        /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
        $status= false; $divMsgUser = "Msg-form"; $messageProcess = ""; $data = []; $redirect = ""; 
        $errorProcess = '';
        # Step 2.0 We find cookies in database
        $resultFind = $this->objCookiesRememberModel_ -> findByCookie( $cookieRemember );
        # Step 3.0 if not error PDO we verify if identifiant exist
        if ( !isset($resultFind -> errorText) ) {
            if ( $resultFind !== '' && $resultFind -> cookieCrypted === $cookieRemember ) { 
                # Step 3.1 We decrypt cookie remember with the key crypto 
                $cookieDecrypted = $this->objCookiesRemember_ -> decryptCookieCrypted( $resultFind -> cookieCrypted,$resultFind -> keyCrypto ); 
                # Step 3.2 We verify if the cookie remember is not expired with the end date
                if ( $cookieDecrypted -> endDate >= time() ) {
                    # Step 3.3 We search data user in database
                    $dataUser = $this->objUserModel_ -> findById( $cookieDecrypted->idUserAccount ); 
                    # Step 3.4 We verify if not error PDO in findById 
                    if ( !isset($dataUser -> errorText) ) { 
                        if ( $dataUser !== '' ){
                            /* Set Session */
                            $_SESSION['connected'] = true;
                            $_SESSION['UserInformation'] = [
                                'idUserAccount' => $dataUser -> idUserAccount,
                                'userName' => $dataUser -> userName,
                                'userFirstName' => $dataUser -> userFirstName,
                                'userEmail' => $dataUser -> userEmail,
                                'userAccess' => $dataUser -> userAccess,
                            ];  
                            return true;
                        };

                    }else{
                    # error PDO $dataUser
                    $errorProcess = '';
                    $messageProcess = "Error PDO in dataUser email ". "\n" . $dataUser -> errorText;
                    goto endProcess;
                    };

                }else{

                };

            }else{ 

            };
            

        }else{
        # error PDO $resultFind
        $errorProcess = '';
        $messageProcess = "Error PDO in resultFind email ". "\n" . $resultFind -> errorText;
        goto endProcess;
        };
    

        /* ▂ ▅ ▆ █  END PROCESS  █ ▆ ▅ ▂ */
        endProcess:
            switch ($errorProcess) {
                case 'primary':
                    # code if primary #031633 
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getPrimary( $messageProcess);
                    break;
                case 'secondary':
                    # code if secondary #161719
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getSecondary( $messageProcess );
                    break;
                case 'danger':
                    # code if danger #2c0b0e
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                    break;
                case 'warning':
                    # code if warning #332701
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getWarning( $messageProcess );
                    break;
                case 'info':
                    # code if info #0dcaf0
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getInfo( $messageProcess );
                    break;
                case 'light':
                    # code if light #f8f9fa
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getLight( $messageProcess );
                    break;
                case 'dark':
                    # code if dark #212529
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDark( $messageProcess );
                    break;
                case 'success':
                    # code if success
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
                    $status= true; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "home";
                    $messageProcess = $this->objCreateDivInformation_ -> getSuccess( $messageProcess );
                    break;
                default:
                    # code if errorProcess is exceptionPDO
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                    break;
            }   

            $responseFetch = [ "status"=>$status, "div"=>$divMsgUser, "msg"=>$messageProcess, "data"=>$data, "redirect"=>$redirect ];
            echo ($this->objResponseJson_ -> responseFetch( $responseFetch ));        
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 

    }


     /* ▂ ▅ ▆ █  userDisconnect( )  █ ▆ ▅ ▂ */
     public function userDisconnect( ){
        # Step 1.0 We start the session management
        $objSession = new Session();
        $objSession -> sessionDestroy();        
        # Step 2.0 we redirect to login page
        header('location:user-login');
        exit();
    }

    /* ▂ ▅ ▆ █  userAddAccount( )  █ ▆ ▅ ▂ */
    public function userAddAccount( ){
        /* MEMO: - Step 1.0 We define variables
                - Step 2.0 We retrieve the $POST values ​​from the request
                - Step 3.0 We encode XSS & Trim	$post Cleanup
                - Step 4.0 created regex pattern list
                - Step 5.0 created setting array                         
                - Step 6.0 We call the function SecurityForm( $setting )
                - Step 7.0 procees if no error else error
                    - Step 8.0 We cretate code recovery 
                    - Step 9.0 We verify if the email exist in database  
                        - Step 9.1 not error PDO and verify if email exist
                            - Step 10.0 We verify if the identifiant exist in database
                                - if not exist we add the account in database
                                    - if add account is ok we set $errorProcess = 'success' and $messageProcess with the message of success
                                    - if add account is not ok we set $errorProcess = 'danger' and $messageProcess with the message of error
                                - if identifiant exist we set $errorProcess = 'danger' and $messageProcess with the message of error
                        - if error PDO we set $errorProcess = '' and $messageProcess with the message of error PDO
                    - if error we set $errorProcess = 'danger' and $messageProcess with the message of error SecurityForm
                - END PROCESS: switch ($errorProcess) to set status, divMsgUser, messageProcess for response json                    
        */
        # Step 1.0 We define variables
        /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
        $status= false; $divMsgUser = "Msg-form"; $messageProcess = ""; $data = []; $redirect = ""; 
        $errorProcess = '';
        
		$pregMatch = $this->objRegex_ -> readPregMatch() -> getReadPregMatch();
        # Step 2.0 We retrieve the $POST values ​​from the request
        $post=json_decode(file_get_contents('php://input'), true);
        # Step 3.0 We encode XSS & Trim	$post Cleanup
        $postEncode = $this->objSecurityForm_ -> encode_XssTrim( $post );	
        # Step 4.0 created regex pattern list
        $regexFieldRequired=['userName'=>$pregMatch['text'], 'userFirstName'=>$pregMatch['text'], 'userEmail'=>$pregMatch['email'], 'identifiant'=>$pregMatch['identifiant'], 'password'=>$pregMatch['password'] ];  
        # Step 5.0 created setting array                         
        $setting = ['method'=>'POST', 'post'=>$postEncode, 'regexFieldRequired'=> $regexFieldRequired ]; 
        # Step 6.0 We call the function SecurityForm( $setting )
        $responseSecurityForm = $this->objSecurityForm_ -> SecurityForm( $setting, 'user-account' ); 
        # Step 7.0 procees if no error else error
        if( ! $responseSecurityForm['bitErrorSecurityForm']){
            /* ▂ ▅ ▆ █ Code following function █ ▆ ▅ ▂ */
                # Step 8.0 We cretate code recovery 
                $postEncode['userRecoveryCode'] = '';
                for ($i=0; $i < 5 ; $i++) { 
                    $postEncode['userRecoveryCode'] .= rand(0,9);
                };
                $postEncode['userAccess'] = 1;
                $postEncode['password'] = password_hash($postEncode['password'], PASSWORD_BCRYPT);
                # Step 9.0 We verify if the email exist in database  
                # @ duplicateCheck( string $table, string $ColumnName, $Value ) return true if duplicate exist, false if no duplicate, exception if error PDO
                $emailExist = ( $this->objDatabaseModel_ -> duplicateCheck('useraccount', 'userEmail', $postEncode['userEmail'] ) );
                if ( gettype($emailExist) == "boolean" ) {
                    # Step 9.1 not error PDO and verify if email exist
                    if($emailExist === false ){
                       # Step 10.0 We verify if the identifiant exist in database
                       # @ duplicateCheck( string $table, string $ColumnName, $Value ) return true if duplicate exist, false if no duplicate, exception if error PDO
                        $identifiantExist = ( $this->objDatabaseModel_ -> duplicateCheck('loginaccount', 'identifiant', $postEncode['identifiant'] ) );

                        if( gettype($identifiantExist) == "boolean" ){

                            if($identifiantExist === false ){
                                # Step 11.0 We add the account in database
                                $this->objUser_ -> hydrate( $postEncode );
                                $addAccount = $this->objUserModel_ -> createJoint( $this->objUser_ );
                                if( gettype($addAccount) == "boolean" ){

                                    if ( $addAccount === true ) {
                                        # Step 11.1 if add account is ok we set $errorProcess = 'success' and $messageProcess with the message of success
                                        $errorProcess = 'success';
                                        $messageProcess = "Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.";
                                        goto endProcess;
                                    } else {
                                        # Step 11.2 if add account is not ok we set $errorProcess = 'danger' and $messageProcess with the message of error
                                        $errorProcess = 'danger';
                                        $messageProcess = "Une erreur est survenue lors de la création de votre compte. Veuillez réessayer plus tard.";
                                        goto endProcess;
                                    };
                                }else{
                                    # error PDO
                                    $errorProcess = '';
                                    $messageProcess = "Error PDO in addAccount ". "\n" . $addAccount -> errorText;
                                    goto endProcess;
                                };

                            }else{
                                # identifiant exist
                                $errorProcess = 'danger';
                                $messageProcess = "L'identifiant existe déjà. Veuillez choisir un identifiant différent.";
                                goto endProcess;
                            };

                        }else{
                            # error PDO
                            $errorProcess = '';
                            $messageProcess = "Error PDO in duplicateCheck identifiant ". "\n" . $identifiantExist -> errorText;
                            goto endProcess;

                        }; 

                    }else{
                        # email exist
                        $errorProcess = 'danger';
                        $messageProcess = "L'email existe déjà. Veuillez utiliser une adresse email différente.";
                        goto endProcess;
                    };
                    
                }else{
                    # error PDO
                    $errorProcess = '';
                    $messageProcess = "Error PDO in duplicateCheck email ". "\n" . $emailExist -> errorText;
                    goto endProcess;

                }; 
            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

        }else{
            # Step 7.1 if error we set $errorProcess = 1 and $messageProcess with the message of the error
            $errorProcess = 'danger';
            $messageProcess = $responseSecurityForm['msgErrorSecurityForm'];
            /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
            //$status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
        };

        /* ▂ ▅ ▆ █  END PROCESS  █ ▆ ▅ ▂ */
        endProcess:
        switch ($errorProcess) {
            case 'primary':
                # code if primary #031633 
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getPrimary( $messageProcess);
                break;
            case 'secondary':
                # code if secondary #161719
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getSecondary( $messageProcess );
                break;
            case 'danger':
                # code if danger #2c0b0e
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                break;
            case 'warning':
                # code if warning #332701
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getWarning( $messageProcess );
                break;
            case 'info':
                # code if info #0dcaf0
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getInfo( $messageProcess );
                break;
            case 'light':
                # code if light #f8f9fa
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getLight( $messageProcess );
                break;
            case 'dark':
                # code if dark #212529
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getDark( $messageProcess );
                break;
            case 'success':
                # code if success
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
                $status= true; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getSuccess( $messageProcess );
                break;
            default:
                # code if errorProcess is exceptionPDO
                /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/
                $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                break;
        }   

        $responseFetch = [ "status"=>$status, "div"=>$divMsgUser, "msg"=>$messageProcess, "data"=>$data, "redirect"=>$redirect ];
        echo ($this->objResponseJson_ -> responseFetch( $responseFetch ));        
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 
    }

   /* ▂ ▅ ▆ █  userShowAccount( )  █ ▆ ▅ ▂ */
    public function userShowAccount( $id ){
        $form = $this->constructFormUserAccount( 'update', $id );
        # Step 3.0: We render the view user/form with the data of head and footer and form
        $this -> objRenderData_->hydrate([
            'forms_' => $form,
            'ongletText_' => "Account - Chichoune Api",
            'sheetCss_' => "App/Css/formLoginAccount.css",
            'scriptJs_' => "App/Js/scriptPage/form-V3.js",
            'other_' => "",
        ]);
        # Step 4.0 We render the view
        $this -> render('user/form', ['HeadData' => $this->objHeadData_, 'RenderData' => $this->objRenderData_, 'FooterData' => $this->objFooterData_] ); 
    }

    /* ▂ ▅ ▆ █  userUpdateAccount( )  █ ▆ ▅ ▂ */
    public function userUpdateAccount( $id ){
        /* MEMO: - Step 1.0 We define variables
                - Step 2.0 We retrieve the $POST values ​​from the request
                - Step 3.0 We encode XSS & Trim	$post Cleanup
                - Step 4.0 created regex pattern list
                - Step 5.0 created setting array                         
                - Step 6.0 We call the function SecurityForm( $setting )
                - Step 7.0 procees if no error else error
                    - Step 8.0 We update the account in database
                        - if update account is ok we set $errorProcess = 'success' and $messageProcess with the message of success
                        - if update account is not ok we set $errorProcess = 'danger' and $messageProcess with the message of error
                    - if error we set $errorProcess = 'danger' and $messageProcess with the message of error SecurityForm
                - END PROCESS: switch ($errorProcess) to set status, divMsgUser, messageProcess for response json
        */
        # Step 1.0 We define variables
        /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
        $status= false; $divMsgUser = "Msg-form"; $messageProcess = ""; $data = []; $redirect = ""; 
        $errorProcess = '';
        
		$pregMatch = $this->objRegex_ -> readPregMatch() -> getReadPregMatch();
        # Step 2.0 We retrieve the $POST values ​​from the request
        $post=json_decode(file_get_contents('php://input'), true);
        # Step 3.0 We encode XSS & Trim	$post Cleanup
        $postEncode = $this->objSecurityForm_ -> encode_XssTrim( $post );	
        # Step 4.0 created regex pattern list
        $regexFieldRequired=['userName'=>$pregMatch['text'], 'userFirstName'=>$pregMatch['text'], 'userEmail'=>$pregMatch['email']];  
        # Step 5.0 created setting array                         
        $setting = ['method'=>'POST', 'post'=>$postEncode, 'regexFieldRequired'=> $regexFieldRequired ]; 
        # Step 6.0 We call the function SecurityForm( $setting )
        $responseSecurityForm = $this->objSecurityForm_ -> SecurityForm( $setting, "user-account-".$id ); 
        # Step 7.0 procees if no error else error
        if( ! $responseSecurityForm['bitErrorSecurityForm']){
            /* ▂ ▅ ▆ █ Code following function █ ▆ ▅ ▂ */
                # Step 8.0 We update the account in database
                $this->objUser_ -> hydrate( $postEncode );
                $updateAccount = $this->objUserModel_ -> update( $this->objUser_, $id );
                # Step 8.1 
                if ( gettype($updateAccount) == "boolean" ) {
                    if ( $updateAccount === true ) {
                        # Step 8.1 if update account is ok we set $errorProcess = 'success' and $messageProcess with the message of success
                        $errorProcess = 'success';
                        $messageProcess = "Votre compte a été mis à jour avec succès.";
                        goto endProcess;
                    } else {
                        # Step 8.2 if update account is not ok we set $errorProcess = 'danger' and $messageProcess with the message of error
                        $errorProcess = 'danger';
                        $messageProcess = "Une erreur est survenue lors de la mise à jour de votre compte. Veuillez réessayer plus tard.";
                        goto endProcess;
                    };

                }else{
                    # error PDO
                    $errorProcess = '';
                    $messageProcess = "Error PDO in updateJoint user account ". "\n" . $updateAccount -> errorText;
                    goto endProcess;
                };
 
            /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

        }else{
            # Step 7.1 if error we set $errorProcess = 1 and $messageProcess with the message of the error
            $errorProcess = 'danger';
            $messageProcess = $responseSecurityForm['msgErrorSecurityForm'];
            /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
            //$status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
        };

        /* ▂ ▅ ▆ █  END PROCESS  █ ▆ ▅ ▂ */
            endProcess:
            switch ($errorProcess) {
                case 'primary':
                    # code if primary #031633 
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getPrimary( $messageProcess);
                    break;
                case 'secondary':
                    # code if secondary #161719
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getSecondary( $messageProcess );
                    break;
                case 'danger':
                    # code if danger #2c0b0e
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                    break;
                case 'warning':
                    # code if warning #332701
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getWarning( $messageProcess );
                    break;
                case 'info':
                    # code if info #0dcaf0
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getInfo( $messageProcess );
                    break;
                case 'light':
                    # code if light #f8f9fa
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getLight( $messageProcess );
                    break;
                case 'dark':
                    # code if dark #212529
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDark( $messageProcess );
                    break;
                case 'success':
                    # code if success
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
                    $status= true; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getSuccess( $messageProcess );
                    break;
                default:
                    # code if errorProcess is exceptionPDO
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                    break;
            }   

            $responseFetch = [ "status"=>$status, "div"=>$divMsgUser, "msg"=>$messageProcess, "data"=>$data, "redirect"=>$redirect ];
            echo ($this->objResponseJson_ -> responseFetch( $responseFetch ));        
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 
    }

    /* ▂ ▅ ▆ █  userDeleteAccount( $id)  █ ▆ ▅ ▂ */
    public function userDeleteAccount( $id ){
        /* MEMO: 
        */
        # Step 1.0 We define variables
        /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
        $status= false; $divMsgUser = "Msg-form"; $messageProcess = ""; $data = []; $redirect = ""; 
        $errorProcess = '';
        # Step 2.0 We delete the account in database
        $deleteAccount = $this->objUserModel_ -> delete( $id );
        # Step 2.1 We verify if delete account is ok
        if ( gettype($deleteAccount) == "boolean" ) {
            if ( $deleteAccount === true ) {
                # Step 2.1.1 if delete account is ok we set $errorProcess = 'success' and $messageProcess with the message of success
                $errorProcess = 'success';
                $messageProcess = "Votre compte a été supprimé avec succès. Vous allez être déconnecté.";
                # Step 1.0 We start the session management
                $objSession = new Session();
                $objSession -> sessionDestroy();
                goto endProcess;
            } else {
                # Step 2.1.2 if delete account is not ok we set $errorProcess = 'danger' and $messageProcess with the message of error
                $errorProcess = 'danger';
                $messageProcess = "Une erreur est survenue lors de la suppression de votre compte. Veuillez réessayer plus tard.";    
                goto endProcess;
            };
        }else{
            # error PDO
            $errorProcess = '';
            $messageProcess = "Error PDO in delete user account ". "\n" . $deleteAccount -> errorText;
            goto endProcess;
        };
        /* ▂ ▅ ▆ █  END PROCESS  █ ▆ ▅ ▂ */
            endProcess:
            switch ($errorProcess) {
                case 'primary':
                    # code if primary #031633 
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getPrimary( $messageProcess);
                    break;
                case 'secondary':
                    # code if secondary #161719
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getSecondary( $messageProcess );
                    break;
                case 'danger':
                    # code if danger #2c0b0e
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                    break;
                case 'warning':
                    # code if warning #332701
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getWarning( $messageProcess );
                    break;
                case 'info':
                    # code if info #0dcaf0
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getInfo( $messageProcess );
                    break;
                case 'light':
                    # code if light #f8f9fa
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getLight( $messageProcess );
                    break;
                case 'dark':
                    # code if dark #212529
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/  
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDark( $messageProcess );
                    break;
                case 'success':
                    # code if success
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/            
                    $status= true; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "home";
                    $messageProcess = $this->objCreateDivInformation_ -> getSuccess( $messageProcess );
                    break;
                default:
                    # code if errorProcess is exceptionPDO
                    /* Variable for response json $divMsgUser = "Msg-form" or Msg-body*/
                    $status= false; $divMsgUser = "Msg-form"; $messageProcess = $messageProcess; $data = []; $redirect = "";
                    $messageProcess = $this->objCreateDivInformation_ -> getDanger( $messageProcess );
                    break;
            }   

            $responseFetch = [ "status"=>$status, "div"=>$divMsgUser, "msg"=>$messageProcess, "data"=>$data, "redirect"=>$redirect ];
            echo ($this->objResponseJson_ -> responseFetch( $responseFetch ));        
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂  */ 
    }

    /* ▂ ▅ ▆ █ construct Form User Login (  ) █ ▆ ▅ ▂ */
    private function constructFormUserLogin( ){
        # Step 1.0: We instantiate new object
        $form = $this->objForm_;

        /* ▂ ▅ ▆ █  Variables  █ ▆ ▅ ▂ */
            /* ▂   Regex   ▂ */
                $regex = $this->objRegex_ -> readRegex() -> getReadRegex();
            /* ▂   Tooltip   ▂ */
                $tooltip = $this->objRegex_ -> readTooltip() -> getReadTooltip();
            /* ▂   Pattern   ▂ */
                $pattern = $this->objRegex_ -> readPattern() -> getReadPattern();
            # Declaration of variables
            $action = 'App/Public/index.php?controller=User|User&action=userConnect';
            $method = 'POST';
            $idForm = 'formLogin';
            $textBtnSubmit = 'Connection <i class="fa-solid fa-paper-plane"></i>';
            $textBtnBack = '<i class="fa-solid fa-house"></i>';
            $idLoginAccountValue = "";
            $identifiantValue =''; #"yannocH17";
            $passwordValue =''; #"455501991Ym@";
            //$x= password_hash($passwordValue, PASSWORD_BCRYPT);	
            $idUserAccountValue = "";
        
            # Declaration of array input
            $arrayInputidentifiant=['minLength'=>'8', 'maxLength'=>'10', 'required'=>'required', 'tooltip'=>$tooltip['identifiant'], 'pattern'=>$pattern['identifiant'], 'regex'=>$regex['identifiant'], 'label'=>'Votre identifiant', 'value'=>$identifiantValue ];
            $arrayInputpassword=['minLength'=>'10', 'maxLength'=>'12', 'required'=>'required', 'tooltip'=>$tooltip['password'], 'pattern'=>$pattern['password'], 'regex'=>$regex['password'], 'label'=>'Votre mot de passe', 'value'=>$passwordValue ];
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/

        /* ▂ ▅ ▆ █  FORM  █ ▆ ▅ ▂ */
            # Step 2.0: We build the form
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

                /* ▂ ▅ ▆ █  Ancre :  user-create-account █ ▆ ▅ ▂ */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-4'] );
                        /* @addAncre( 'comment', 'text de l'ancre',  [ list of attributs ] ) */
                        $form -> addAncre('', 'Créer un compte', ['href'=>'user-create-account', 'class'=>'link-secondary  link-offset-2 link-offset-5-hover link-opacity-80 link-opacity-100-hover link-underline-danger link-underline-opacity-0 link-underline-opacity-100-hover fst-italic'] ); 
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
                            $form -> addBtn( '', $textBtnSubmit, [ 'type'=>'submit', 'name'=>'submit', 'id'=>'submit','value'=>'submit', 'class'=>'btn btn-success ' ] );
                            /* @addBtn( 'comment', 'textBtn',[ list of attributs ] ) */
                            $form -> addBtn( '', $textBtnBack, [ 'type'=>'button', 'name'=>'back', 'id'=>'back', 'data-url'=>'home', 'value'=>'back', 'class'=>'btn btn-primary rounded-circle' ] );
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
                    return $form;
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
        /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    }

    /* ▂ ▅ ▆ █ construct Form User Account ( $mode ) █ ▆ ▅ ▂ */
    private function constructFormUserAccount( $mode, $id = null ){
        # Step 1.0 We instantiate new object
        $form = $this->objForm_;

        /* ▂ ▅ ▆ █  Variables  █ ▆ ▅ ▂ */
            /* ▂   Regex   ▂ */
            $regex = $this->objRegex_ -> readRegex() -> getReadRegex();
            /* ▂   Tooltip   ▂ */
            $tooltip = $this->objRegex_ -> readTooltip() -> getReadTooltip();
            /* ▂   Pattern   ▂ */
            $pattern = $this->objRegex_ -> readPattern() -> getReadPattern();
            $method = 'POST';
            $idForm = 'formAccount';   
            $textBtnBack = 'Home <i class="fa-solid fa-house"></i>';
            $textBtnDelete = ' Supprimer votre compte<i class="fa-solid fa-trash"></i>';    

            # Step 2.0 We build the form
            switch($mode){
                case 'create':
                    # code for create form
                    $action = 'App/Public/index.php?controller=User|User&action=userAddAccount';
                    $titleForm = 'Créer votre compte';
                    $textBtnSubmit = 'Créer compte <i class="fa-solid fa-paper-plane"></i>';
                break;
                case 'update':
                    # code for update form
                    $action = 'App/Public/index.php?controller=User|User&action=userUpdateAccount&id='.$id;
                    $titleForm = 'Modifier votre compte';
                    $textBtnSubmit = 'Modifier compte <i class="fa-solid fa-pen-fancy"></i>';
                    $userAccountData = $this->objUserModel_ -> findById( $id ); 
                    $hrefDelete="user-delete-account-".$id;#App/Public/index.php?controller=User|User&action=userDeleteAccount&id=".$id;
                break;
                case 'dev':
                    # code for development form
                    $action = 'App/Public/index.php?controller=User|User&action=userAddAccount';
                    $titleForm = 'Créer votre compte';
                    $textBtnSubmit = 'Créer compte <i class="fa-solid fa-paper-plane"></i>';
                    //$hrefDelete="App/Public/index.php?controller=User|User&action=userDeleteAccount&id=".$_SESSION['UserInformation']['idUserAccount'];
                break;
            };

            # We set the value of variables with the database if exist 
            if(isset($userAccountData)){
                $idLoginAccountValue = '';
                $idUserAccountValue = $userAccountData -> idUserAccount;
                $identifiantValue = '';

                $userNameValue = $userAccountData -> userName;
                $userFirstNameValue = $userAccountData -> userFirstName;
                $userEmailValue = $userAccountData -> userEmail;
                $userRecoveryCodeValue = $userAccountData -> userRecoveryCode;
                $userAccessValue = $userAccountData -> userAccess;

                $passwordValue = '';
                $passwordVerifyValue = '';
            }else{
                $idUserAccountValue = "";
                $userNameValue = "";
                $userFirstNameValue = "";
                $userEmailValue = "";
                $userRecoveryCodeValue = "";
                $userAccessValue = "";
                $idLoginAccountValue = "";
                $identifiantValue = "";
                $passwordValue = "";
                $passwordVerifyValue = "";
                $idUserAccountValue = "";
            };

            if($mode === 'dev'){
                $idUserAccountValue = "";
                $userNameValue = "Martin";
                $userFirstNameValue = "Yann";
                $userEmailValue = "martin.yann@example.com";
                $userRecoveryCodeValue = "";
                $userAccessValue = "5";
                $idLoginAccountValue = "";
                $identifiantValue = "yannocH17";
                $passwordValue = "455501991Ym@";
                $passwordVerifyValue = "455501991Ym@";
                $idUserAccountValue = "";
            };


            # We Declaration of array input
                $arrayInputuserName=['minLength'=>'2', 'maxLength'=>'50', 'required'=>'required', 'tooltip'=>$tooltip['text'], 'pattern'=>$pattern['text'], 'regex'=>$regex['text'], 'label'=>'Votre nom', 'value'=>$userNameValue ];
                $arrayInputuserFirstName=['minLength'=>'2', 'maxLength'=>'50', 'required'=>'required', 'tooltip'=>$tooltip['text'], 'pattern'=>$pattern['text'], 'regex'=>$regex['text'], 'label'=>'Votre Prénom', 'value'=>$userFirstNameValue ];
                $arrayInputuserEmail=['minLength'=>'2', 'maxLength'=>'50', 'required'=>'required', 'tooltip'=>$tooltip['email'], 'pattern'=>$pattern['email'], 'regex'=>$regex['email'], 'label'=>'Votre adresse email', 'value'=>$userEmailValue ];
                $arrayInputuserRecoveryCode=['minLength'=>'1', 'maxLength'=>'50', 'required'=>'required', 'tooltip'=>$tooltip['text'], 'pattern'=>$pattern['text'], 'regex'=>$regex['text'], 'label'=>'Votre code de récupération', 'value'=>$userRecoveryCodeValue ];
                $arrayInputidentifiant=['minLength'=>'8', 'maxLength'=>'10', 'required'=>'required', 'tooltip'=>$tooltip['identifiant'], 'pattern'=>$pattern['identifiant'], 'regex'=>$regex['identifiant'], 'label'=>'Votre identifiant', 'value'=>$identifiantValue ];
                $arrayInputpassword=['minLength'=>'10', 'maxLength'=>'12', 'required'=>'required', 'tooltip'=>$tooltip['password'], 'pattern'=>$pattern['password'], 'regex'=>$regex['password'], 'label'=>'Votre mot de passe', 'value'=>$passwordValue ];
                $arrayInputpasswordVerify=['minLength'=>'10', 'maxLength'=>'12', 'required'=>'required', 'tooltip'=>$tooltip['password'], 'pattern'=>$pattern['password'], 'regex'=>$regex['password'], 'label'=>'Vérification mot de passe', 'value'=>$passwordVerifyValue ];
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/

        # We build the form
        /* ▂ ▅ ▆ █  Header form  █ ▆ ▅ ▂ */
            $form -> addDivContainerFormOpen( [ 'name'=>'divForm-LoginaccountForm', 'id'=>'divForm-LoginaccountForm', 'class'=>'col-10 col-sm-5 col-lg-3 mb-3 py-3 text-center container-form-login' ] );
            /* @startForm( 'comment', [list of attributs] ) */
            $form -> startForm( 'startForm', [ 'name'=>'LoginaccountForm', 'id'=>$idForm, 'action'=>$action, 'method'=>$method, 'enctype'=>'multipart/form-data', 'class'=>'justify-content-center row validate', ] );        
            /* @addDivOpen( 'comment', [ list of attributs ] ) */
            $form -> addDivOpen( '',  ['class'=>''] );
                /* @addImageForm('comment', 'balise', 'text title, [list of attributs]) */
                $form -> addImageForm( '', '', [ 'name'=>'', 'id'=>'', 'src'=>'App/Images/LogoChichoune.png','class'=>'imageForm' ] );
            /* @addTitleForm('comment', 'balise', 'text title, [list of attributs]) */
            $form -> addTitleForm( 'Title Form', 'h4', $titleForm, [ 'name'=>'', 'id'=>'', 'class'=>'titleForm fst-italic my-4' ] );
            /* @addDivClose( 'comment' ) */
            $form -> addDivClose( '' );
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/

        /* ▂ ▅ ▆ █  Div information user  █ ▆ ▅ ▂ */
            /* @addDivOpen( 'comment', [ list of attributs ] ) */
            $form -> addDivOpen( '',  ['id'=>'Msg-form', 'class'=>''] );

            /* @addDivClose( 'comment' ) */
            $form -> addDivClose( '' );
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/ 

        /* ▂ ▅ ▆ █  Input group : - userName -  █ ▆ ▅ ▂ */
            /* @addDivOpen( 'comment', [ list of attributs ] ) */
            $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-2'] );
                /* @addDivInputGroupFormFloatingOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivInputGroupFormFloatingOpen( '',  ['class'=>'input-group align-content-center has-validation'] );
                    ///*-------- Picto input ----------- */
                    ///* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                    //$form -> addSpan( '', '', [ 'id'=>'pictoInput-userName', 'href'=>'#', 'class'=>'input-group-text' ]);
                    ///*---------------------------- */
                    /*-------- input ----------- */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['class'=>'form-floating is-invalid'] );
                        /* @addInput( 'comment', [ list of attributs ] ) */
                        $form -> addInput('', [ 'type'=>'text', 'name'=>'userName', 'id'=>'userName', 'placeholder'=>'', 'minLength'=>$arrayInputuserName['minLength'], 'maxLength'=>$arrayInputuserName['maxLength'], 'required'=>$arrayInputuserName['required'], 'pattern'=>$arrayInputuserName['pattern'], 'regex'=>$arrayInputuserName['regex'], 'value'=>$arrayInputuserName['value'], 'class'=>'form-control']);
                        /* @addLabel( 'comment', 'text', [ list of attributs ] ) */
                        $form -> addLabel( '', $arrayInputuserName['label'], [ 'id'=>'inputLabel-userName', 'for'=>'userName', 'class'=>'' ]);
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose( '' );
                    /*---------------------------- */
                    /*-------- FeedBack ----------- */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['id'=>'feedback-userName', 'class'=>'invalid-feedback'] );
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose( '' );
                    /*---------------------------- */
                /* @addDivInputGroupFormFloatingClose( 'comment' ) */
                $form -> addDivInputGroupFormFloatingClose( '' );
                /*-------- Tooltip ----------- */
                /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                $form -> addSpan( '', '<i class="fa-solid fa-circle-info"></i>', [ 'id'=>'addon-userName', 'href'=>'#', 'class'=>'pictoInfo', 'data-bs-toggle'=>'tooltip', 'data-bs-placement'=>'left', 'data-bs-html'=>'true', 'data-bs-custom-class'=>'custom-tooltip', 'data-bs-title'=>$arrayInputuserName['tooltip'] ]);
                /*---------------------------- */
            /* @addDivClose( 'comment' ) */
            $form -> addDivClose( '' );
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/

        /* ▂ ▅ ▆ █  Input group : - userFirstName -  █ ▆ ▅ ▂ */
            /* @addDivOpen( 'comment', [ list of attributs ] ) */
            $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-2'] );
                /* @addDivInputGroupFormFloatingOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivInputGroupFormFloatingOpen( '',  ['class'=>'input-group align-content-center has-validation'] );
                    ///*-------- Picto input ----------- */
                    ///* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                    //$form -> addSpan( '', '', [ 'id'=>'pictoInput-userFirstName', 'href'=>'#', 'class'=>'input-group-text' ]);
                    ///*---------------------------- */
                    /*-------- input ----------- */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['class'=>'form-floating is-invalid'] );
                        /* @addInput( 'comment', [ list of attributs ] ) */
                        $form -> addInput('', [ 'type'=>'text', 'name'=>'userFirstName', 'id'=>'userFirstName', 'placeholder'=>'', 'minLength'=>$arrayInputuserFirstName['minLength'], 'maxLength'=>$arrayInputuserFirstName['maxLength'], 'required'=>$arrayInputuserFirstName['required'], 'pattern'=>$arrayInputuserFirstName['pattern'], 'regex'=>$arrayInputuserFirstName['regex'], 'value'=>$arrayInputuserFirstName['value'], 'class'=>'form-control']);
                        /* @addLabel( 'comment', 'text', [ list of attributs ] ) */
                        $form -> addLabel( '', $arrayInputuserFirstName['label'], [ 'id'=>'inputLabel-userFirstName', 'for'=>'userFirstName', 'class'=>'' ]);
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose( '' );
                    /*---------------------------- */
                    /*-------- FeedBack ----------- */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['id'=>'feedback-userFirstName', 'class'=>'invalid-feedback'] );
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose( '' );
                    /*---------------------------- */
                /* @addDivInputGroupFormFloatingClose( 'comment' ) */
                $form -> addDivInputGroupFormFloatingClose( '' );
                /*-------- Tooltip ----------- */
                /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                $form -> addSpan( '', '<i class="fa-solid fa-circle-info"></i>', [ 'id'=>'addon-userFirstName', 'href'=>'#', 'class'=>'pictoInfo', 'data-bs-toggle'=>'tooltip', 'data-bs-placement'=>'left', 'data-bs-html'=>'true', 'data-bs-custom-class'=>'custom-tooltip', 'data-bs-title'=>$arrayInputuserFirstName['tooltip'] ]);
                /*---------------------------- */
            /* @addDivClose( 'comment' ) */
            $form -> addDivClose( '' );
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/

        /* ▂ ▅ ▆ █  Input group : - userEmail -  █ ▆ ▅ ▂ */
            /* @addDivOpen( 'comment', [ list of attributs ] ) */
            $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-2'] );
                /* @addDivInputGroupFormFloatingOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivInputGroupFormFloatingOpen( '',  ['class'=>'input-group align-content-center has-validation'] );
                    ///*-------- Picto input ----------- */
                    ///* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                    //$form -> addSpan( '', '', [ 'id'=>'pictoInput-userEmail', 'href'=>'#', 'class'=>'input-group-text' ]);
                    ///*---------------------------- */
                    /*-------- input ----------- */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['class'=>'form-floating is-invalid'] );
                        /* @addInput( 'comment', [ list of attributs ] ) */
                        $form -> addInput('', [ 'type'=>'text', 'name'=>'userEmail', 'id'=>'userEmail', 'placeholder'=>'', 'minLength'=>$arrayInputuserEmail['minLength'], 'maxLength'=>$arrayInputuserEmail['maxLength'], 'required'=>$arrayInputuserEmail['required'], 'pattern'=>$arrayInputuserEmail['pattern'], 'regex'=>$arrayInputuserEmail['regex'], 'value'=>$arrayInputuserEmail['value'], 'class'=>'form-control']);
                        /* @addLabel( 'comment', 'text', [ list of attributs ] ) */
                        $form -> addLabel( '', $arrayInputuserEmail['label'], [ 'id'=>'inputLabel-userEmail', 'for'=>'userEmail', 'class'=>'' ]);
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose( '' );
                    /*---------------------------- */
                    /*-------- FeedBack ----------- */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['id'=>'feedback-userEmail', 'class'=>'invalid-feedback'] );
                    /* @addDivClose( 'comment' ) */
                    $form -> addDivClose( '' );
                    /*---------------------------- */
                /* @addDivInputGroupFormFloatingClose( 'comment' ) */
                $form -> addDivInputGroupFormFloatingClose( '' );
                /*-------- Tooltip ----------- */
                /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                $form -> addSpan( '', '<i class="fa-solid fa-circle-info"></i>', [ 'id'=>'addon-userEmail', 'href'=>'#', 'class'=>'pictoInfo', 'data-bs-toggle'=>'tooltip', 'data-bs-placement'=>'left', 'data-bs-html'=>'true', 'data-bs-custom-class'=>'custom-tooltip', 'data-bs-title'=>$arrayInputuserEmail['tooltip'] ]);
                /*---------------------------- */
            /* @addDivClose( 'comment' ) */
            $form -> addDivClose( '' );
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/      

        /* ▂ ▂ ▂ ▂ ▂ Input HIdden in mode update ▂ ▂ ▂ ▂ ▂ ▂ ▂*/
            if( $mode != 'update' ){

                /* ▂ ▅ ▆ █  Input group : - identifiant -  █ ▆ ▅ ▂ */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-2'] );
                        /* @addDivInputGroupFormFloatingOpen( 'comment', [ list of attributs ] ) */
                        $form -> addDivInputGroupFormFloatingOpen( '',  ['class'=>'input-group align-content-center has-validation'] );
                            /*-------- Picto input ----------- */
                            /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                            # $form -> addSpan( '', '', [ 'id'=>'pictoInput-identifiant', 'href'=>'#', 'class'=>'input-group-text' ]);
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
                            ///*-------- Picto input ----------- */
                            ///* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                            //$form -> addSpan( '', '', [ 'id'=>'pictoInput-password', 'href'=>'#', 'class'=>'input-group-text' ]);
                            ///*---------------------------- */
                            /*-------- input ----------- */
                            /* @addDivOpen( 'comment', [ list of attributs ] ) */
                            $form -> addDivOpen( '',  ['class'=>'form-floating is-invalid'] );
                                /* @addInput( 'comment', [ list of attributs ] ) */
                                $form -> addInput('', [ 'type'=>'password', 'name'=>'password', 'id'=>'password', 'placeholder'=>'', 'minLength'=>$arrayInputpassword['minLength'], 'maxLength'=>$arrayInputpassword['maxLength'], 'required'=>$arrayInputpassword['required'], 'pattern'=>$arrayInputpassword['pattern'], 'regex'=>$arrayInputpassword['regex'], 'value'=>$arrayInputpassword['value'], 'class'=>'form-control' ]);
                                /* @addLabel( 'comment', 'text', [ list of attributs ] ) */
                                $form -> addLabel( '', $arrayInputpassword['label'], [ 'id'=>'inputLabel-password', 'for'=>'password', 'class'=>'' ]);
                            /* @addDivClose( 'comment' ) */
                            $form -> addDivClose( '' );
                            /*---------------------------- */
                            /*-------- Picto eye -----------*/
                            /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) </i> */
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

                /* ▂ ▅ ▆ █  Input group : - password vérification -  █ ▆ ▅ ▂ */
                    /* @addDivOpen( 'comment', [ list of attributs ] ) */
                    $form -> addDivOpen( '',  ['class'=>'d-flex flex-nowrap gap-2 align-items-center col-10 col-sm-10 col-lg-10 mb-2'] );
                        /* @addDivInputGroupFormFloatingOpen( 'comment', [ list of attributs ] ) */
                        $form -> addDivInputGroupFormFloatingOpen( '',  ['class'=>'input-group align-content-center has-validation'] );
                            // /*-------- Picto input ----------- */
                            // /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) */
                            // $form -> addSpan( '', '<i class="fa-solid fa-lock"></i>', [ 'id'=>'pictoInput-password-verification', 'href'=>'#', 'class'=>'input-group-text ' ]);
                            // /*---------------------------- */
                            /*-------- input ----------- */
                            /* @addDivOpen( 'comment', [ list of attributs ] ) */
                            $form -> addDivOpen( '',  ['class'=>'form-floating is-invalid'] );
                                /* @addInput( 'comment', [ list of attributs ] ) */
                                $form -> addInput('', [ 'type'=>'password', 'name'=>'confirmPassword', 'id'=>'confirmPassword', 'placeholder'=>'', 'minLength'=>$arrayInputpasswordVerify['minLength'], 'maxLength'=>$arrayInputpasswordVerify['maxLength'], 'required'=>'required', 'pattern'=>$arrayInputpasswordVerify['pattern'], 'regex'=>$arrayInputpasswordVerify['regex'], 'value'=>$arrayInputpasswordVerify['value'], 'class'=>'form-control ']);
                                /* @addLabel( 'comment', 'text', [ list of attributs ] ) */
                                $form -> addLabel( '', $arrayInputpasswordVerify['label'], [ 'id'=>'inputLabel-confirmPassword', 'for'=>'confirmPassword', 'class'=>'' ]);
                            /* @addDivClose( 'comment' ) */
                            $form -> addDivClose( '' );
                            /*---------------------------- */
                            /*-------- Picto eye -----------*/
                            /* @addSpan( 'comment', 'i or img', [ list of attributs ] ) </i> */
                            $form -> addSpan( '', '<i class="fa-solid fa-eye"></i>', [ 'id'=>'confirmPassword-eye', 'href'=>'#', 'class'=>'input-group-text pictoEye' ]);
                            /*---------------------------- */
                            /*-------- FeedBack ----------- */
                            /* @addDivOpen( 'comment', [ list of attributs ] ) */
                            $form -> addDivOpen( '',  ['id'=>'feedback-confirmPassword', 'class'=>'invalid-feedback'] );
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
            };
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/        

        /* ▂ ▅ ▆ █  Anti robot  █ ▆ ▅ ▂ */
            /* @addAntiRobot( 'value' ) */
            $form -> addAntiRobot( '' );
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

        /* ▂ ▅ ▆ █  Token  █ ▆ ▅ ▂ */
            $form -> addToken();
            # ├ Appel function Token::createdToken()
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

        /* ▂ ▅ ▆ █  Button  █ ▆ ▅ ▂ */
            /* @addDivOpen( 'comment', [ list of attributs ] ) */
            $form -> addDivOpen( '',  ['class'=>'container'] );
                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>'col d-flex justify-content-evenly mb-2'] );
                    /* @addBtn( 'comment', 'textBtn',[ list of attributs ] ) */
                    $form -> addBtn( '', $textBtnSubmit, [ 'type'=>'submit', 'name'=>'submit', 'id'=>'submit','value'=>'submit', 'class'=>'btn btn-warning rounded' ] );
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose();
                    
                /* ▂ ▂ ▂ ▂ ▂ Input HIdden in mode update ▂ ▂ ▂ ▂ ▂ ▂ ▂*/
                    if( $mode === 'update' ){
                        /* @addDivOpen( 'comment', [ list of attributs ] ) */
                        $form -> addDivOpen( '',  ['class'=>'col d-flex justify-content-evenly mb-2'] );
                            /* @addBtn( 'comment', 'textBtn',[ list of attributs ] ) */
                            $form -> addBtn( '', $textBtnDelete, [ 'type'=>'button', 'name'=>'delete', 'id'=>'delete', 'data-url'=>$hrefDelete, 'value'=>'back', 'class'=>'btn btn-danger rounded border-right-0' ] );
                        /* @addDivClose( 'comment' ) */
                        $form -> addDivClose();
                    };
                /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂*/  

                /* @addDivOpen( 'comment', [ list of attributs ] ) */
                $form -> addDivOpen( '',  ['class'=>'col d-flex justify-content-evenly mb-2'] );                                   
                    /* @addBtn( 'comment', 'textBtn',[ list of attributs ] ) */
                    $form -> addBtn( '', $textBtnBack, [ 'type'=>'button', 'name'=>'back', 'id'=>'back', 'data-url'=>'home', 'value'=>'back', 'class'=>'btn btn-primary rounded border-right-0' ] );
                /* @addDivClose( 'comment' ) */
                $form -> addDivClose(); 


            /* @addDivClose( 'comment' ) */
            $form -> addDivClose();
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */

        /* ▂ ▅ ▆ █  Footer Form  █ ▆ ▅ ▂ */
            /* @endForm( 'comment' ) */
            $form -> endForm( 'endForm' );
            /* @addDivContainerFormClose( 'comment' ) */   
            $form -> addDivContainerFormClose();
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */       


        /* ▂ ▅ ▆ █  Bloc return form  █ ▆ ▅ ▂ */
            $form = $form -> getFormElements();
            return $form;
        /* ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ ▂ */     

    }

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
}



     

?>