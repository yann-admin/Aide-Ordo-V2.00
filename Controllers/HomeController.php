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

/* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

    /* ▂ ▅  index()  ▅ ▂ */
    Public function index(){
        # Step 1.0 We instantiate new object
        $objHeadData = new HeadData();
        $objFooterData = new FooterData();
        $objRenderData = new RenderData(); 
        # Step 2.0 we test S_SESSION['connected'] exist and is true
        if ( (isset($_SESSION['connected'])) && ($_SESSION['connected'] == true) ){
            # if true we render the view home/index with the data of head and footer
            $objRenderData->hydrate([
                'ongletText_' => "Accueil - Chichoune Api",
                'other_' => "Bonjour et Bienvenue " . $_SESSION["UserInformation"]["userFirstName"], ]);
            
            $this->render('home/index', ['HeadData' => $objHeadData, 'RenderData' => $objRenderData, 'FooterData' => $objFooterData] );          
        }else{
            // # if false we redirect via .htaccess App/Public/index.php?controller=User|User&action=showLoginForm
            // # Step 1.0 We instantiate new object
            // $objUserController = new UserController();
            // $form = $objUserController->showLoginForm();
            // # Step 3.0: We render the view user/form with the data of head and footer and form
            // $objRenderData->hydrate([
            //     'forms_' => $form,
            //     'ongletText_' => "Login - Chichoune Api",
            //     'sheetCss_' => "App/Css/formLoginAccount.css",
            //     'scriptJs_' => "App/Js/scriptPage/form-V3.js",
            //     'other_' => "Bienvenue sur la plateforme d'aide pour l'ordonnancement. \n Veuillez vous connecter pour accéder à votre espace personnalisé ou créer un compte si vous n'en avez pas encore.",
            // ]);
            // # Step 4.0 We render the view
            // $this -> render('user/form', ['HeadData' => $objHeadData, 'RenderData' => $objRenderData, 'FooterData' => $objFooterData] ); 
                header('Location: user-login');
                exit();
        };




    }







/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 
};

?>