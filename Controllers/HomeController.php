<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Controllers;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */
    # Class Form

    # Class Controller & Entity & Models 


    #  Class Data 
    use App\Core\Render\Data\HeadData;
    use App\Core\Render\Data\MainData;
    use App\Core\Render\Data\FooterData;

    # Class Session
    use App\Core\Session\Session;


    error_reporting(E_ALL);
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Grafcet █ ▆ ▅ ▂ */
    /*
    functon home
        ╚ if user is connected
        ║   ╚ set data for the view home/index.php
        ║   ╚ render the view home/index.php
        ║    
        ╚ else
            ╚ redirect to root()

    function root
        ╚ if cookie remember exist
        ║   ╚ do nothing
        ║    
        ╚ else
            ╚ redirect to user-login

    */
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class HomeController extends Controller{
 /* ▂ ▅ Attributs ▅ ▂ */
    private $objHeadData_;
    private $objMainData_;
    private $objFooterData_;
    

    /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

    /* ▂ ▅ ▆ █ __construct() █ ▆ ▅ ▂ */
    public function __construct( ){;
        $this -> objHeadData_ = new HeadData();
        $this -> objMainData_ = new MainData();
        $this -> objFooterData_ = new FooterData(); 
    }

    /* ▂ ▅  home()  ▅ ▂ */
    Public function home(){
        # We check if the user is connected
        if( (isset($_SESSION["User"]["userConnected"])) && ($_SESSION["User"]["userConnected"] == true) ){
            # The user is connected
            # We set the data for the view home/index.php
            $this->objHeadData_ -> setTextOnglet("Aide-Ordo - Accueil");
            $this -> render('home/index', ['objHeadData' => $this->objHeadData_, 'objMainData' => $this->objMainData_, 'objFooterData' => $this->objFooterData_] ); 
        }else{
            # The user is not connected
            //$this->root(); 
            // mode developement
            $this->objHeadData_ -> setTextOnglet("Aide-Ordo - Accueil");
            $this -> render('home/index', ['objHeadData' => $this->objHeadData_, 'objMainData' => $this->objMainData_, 'objFooterData' => $this->objFooterData_] ); 
        };
    }

    /* ▂ ▅  root()  ▅ ▂ */
    private function root(){
        # We check if cookies remember exist
        if( (isset($_COOKIE['remember']) ) && ($_COOKIE['remember'] == true) ){
            # The cookie remember exist


        }else{
            # The cookie remember does not exist
            header('Location: connection-login');
        };
    }


/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
};

?>