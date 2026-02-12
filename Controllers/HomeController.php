<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Controllers;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    # Class Form

    # Class Controller & Entity & Models UserAccount
    use App\Controllers\User\UserController;
    // use App\Entities\User\UserAccount;
    // use App\Models\User\UserAccountModel;

    #  Class RenderData & ResponseJson & CreateDivInformation
    use App\Core\RenderData\RenderData;
    use App\Core\RenderData\ResponseJson;
    use App\Core\RenderData\CreateDivInformation;

    # Class other
    use App\Core\Other\Session;
    use App\Core\Other\HeadData;
    use App\Core\Other\FooterData;

    error_reporting(E_ALL);
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Grafcet █ ▆ ▅ ▂ */
    /*

    */
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class HomeController extends Controller{
 /* ▂ ▅ Attributs ▅ ▂ */
    private $objHeadData;
    private $objFooterData;
    private $objRenderData;

/* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

/* ▂ ▅ ▆ █ __construct() █ ▆ ▅ ▂ */
    public function __construct( ){;
        $this -> objHeadData = new HeadData();
        $this -> objFooterData = new FooterData(); 
        $this -> objRenderData = new RenderData();
    }

    /* ▂ ▅  index()  ▅ ▂ */
    Public function index(){
        // # Step 1.0 We instantiate new object
        // $objHeadData = $this -> objHeadData;
        // $objFooterData = $this -> objFooterData;
        // $objRenderData = $this -> objRenderData; 
        # Step 2.0 We verify cookies remember exist and is valid 
        if( isset($_COOKIE['rememberMe']) ){ 
            $cookieRemember = $_COOKIE['rememberMe']; 
            # Step 2.1 We instancie new object UserController()
            $objUserController = new UserController();
            $checkCookieRemember = $objUserController -> checkCookieRemember( $cookieRemember ); 
            if ( $checkCookieRemember == true ) { 
                $this->objRenderData -> hydrate([
                    'ongletText_' => "Accueil - Chichoune Api",
                    'other_' => "Bonjour " . $_SESSION["UserInformation"]["userFirstName"] . " ravi de vous revoir", ]);
                $this->render('home/index', ['HeadData' => $this->objHeadData, 'RenderData' => $this->objRenderData, 'FooterData' => $this->objFooterData] );  
            }else{ 
                $this -> connect();
            };
        }else{
            $this -> connect();
        };
    }

    private function connect(){
        # Step 3.0 we test S_SESSION['connected'] exist and is true
        if ( (isset($_SESSION['connected'])) && ($_SESSION['connected'] == true) ){
            # if true we render the view home/index with the data of head and footer
            $this->objRenderData -> hydrate([
                'ongletText_' => "Accueil - Chichoune Api",
                'other_' => "Bonjour et Bienvenue " . $_SESSION["UserInformation"]["userFirstName"], ]);
            
            $this->render('home/index', ['HeadData' => $this->objHeadData, 'RenderData' => $this->objRenderData, 'FooterData' => $this->objFooterData] );          
        }else{
            header('Location: user-login');
            exit();
        };

    }






/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
};

?>