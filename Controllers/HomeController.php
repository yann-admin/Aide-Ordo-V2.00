<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Controllers;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    # Class Form

    # Class Controller & Entity & Models UserAccount
    use App\Controllers\User\UserAccountController;
    use App\Entities\User\UserAccount;
    use App\Models\User\UserAccountModel;

    #  Class RenderData & ResponseJson & CreateDivInformation
    use App\Core\RenderData\RenderData;
    use App\Core\RenderData\ResponseJson;
    use App\Core\RenderData\CreateDivInformation;

    # Class other
    use App\Core\Other\Session;
    use App\Core\Other\HeadData;
    use App\Core\Other\FooterData;

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Grafcet █ ▆ ▅ ▂ */
    /*

    */
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
    class HomeController extends Controller{
        /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

        /* ▂ ▅  index()  ▅ ▂ */
        Public function index(){
            # Step 1.0 We instantiate new object
            $objHeadData = new HeadData();
            $objFooterData = new FooterData();
            $objRenderData = new RenderData(); 
            # Step 2.0 We test if cookie exist and match with database
            if ( ! $this -> testRememberMe() ){
                # Step 3.0 We test S-SESSION['connected'] exist and true
                if ( (isset($_SESSION['connected'])) && ($_SESSION['connected'] == true) ){
                    $objRenderData->hydrate([
                        'ongletText_' => "Accueil - Chichoune Api",
                        'other_' => "Bonjour et Bienvenue " . $_SESSION["UserInformation"]["userFirstName"] . " ",
                    ]);
                    $this->render('home/index', ['HeadData' => $objHeadData, 'RenderData' => $objRenderData, 'FooterData' => $objFooterData] );
                }else{
                    # Step 4.0 else S-SESSION['connected'] not exist or false, we redirect to login page
                    header('location:login');
                    exit();                    
                };

            }else{ 
                # Step 2.0 else if cookie exist and match, we redict to home page and set the session
                $objRenderData->hydrate([
                    'ongletText_' => "Accueil - Chichoune Api",
                    'other_' => "Bonjour et Bienvenue " . $_SESSION["UserInformation"]["userFirstName"] . " ",
                ]);
                $this->render('home/index', ['HeadData' => $objHeadData, 'RenderData' => $objRenderData, 'FooterData' => $objFooterData] );
            };


            // # Step 2.1 else cookie exist and match, we set the session and render the view
            // $objRenderData->hydrate([
            //     'ongletText_' => "Accueil - Chichoune Api",
            //     'other_' => "Bonjour et Bienvenue " . $_SESSION["UserInformation"]["userFirstName"] . " ",
            // ]);
            // # Step 3.2 We render the view
            // $this->render('home/index', ['HeadData' => $objHeadData, 'RenderData' => $objRenderData, 'FooterData' => $objFooterData] );




        }

        /* ▂ ▅  test Remember Me()  ▅ ▂ */
        private function testRememberMe(){
            $cookieMatch =false;
            if((isset($_COOKIE['rememberMe'])) && (!empty($_COOKIE['rememberMe'])) ){
            # Step 1.0 We instantiate new object
            $objUserAccount = new UserAccountController();
            # Step 2.0 call $objLoginaccount->verifyCookieRememberMe( string $cookieCrypted )
            $cookieMatch = $objUserAccount -> verifyCookieRememberMe( $_COOKIE['rememberMe'] );
            return $cookieMatch;
            }else{
                # Step 3.0 else cookie not exist or empty 
                $cookieMatch = false;    
                return $cookieMatch;
            };
        }

    /* ▂ ▅  disconnect()  ▅ ▂ */
    Public function disconnect(){
        # Step 1.0 We start the session management
        $objSession = new Session();
        $objSession -> sessionDestroy();        
        # Step 2.0 we redirect to login page
        header('location:login');
        exit();
    }
    };
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
?>