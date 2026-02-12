<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    /* Fichier controller database: api_chichoune - table: useraccount via constructor_Array_DataBase_SQL.php VERSION: 3.0.0*/ 
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Controllers\CookiesRemember;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */

    //use App\Core\Other\Session;

    # Class Controller
    //use App\Controllers\Controller;

    # Class Form
    // use App\Core\Form\Form;
    // use App\Core\Form\Regex;
    // use App\Core\Form\Token;
    // use App\Core\Form\SecurityForm;

    # Class Entity & Models UserAccount
    // use App\Models\Database\DatabaseModel;
    // use App\Entities\User\User;
    // use App\Models\User\UserModel;

    # Class Controllers & Entity & Models CookiesRemember
    // use App\Controllers\CookiesRemember\CookiesRememberController;
    use App\Entities\CookiesRemember\CookiesRemember;
    use App\Models\CookiesRemember\CookiesRememberModel;

    // #  Class RenderData & ResponseJson & CreateDivInformation
    // use App\Core\RenderData\RenderData;
    // use App\Core\RenderData\ResponseJson;
    // use App\Core\RenderData\CreateDivInformation;

    // # Class other
    // use App\Core\Other\HeadData;
    // use App\Core\Other\FooterData;

    # Class Crypto & Key
    use \Defuse\Crypto\Crypto;
    use \Defuse\Crypto\Key;
    require '../vendor/autoload.php';

    error_reporting(E_ALL);
    
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class CookiesRememberController {
    /* ▂ ▅ ▆ █ Attributs █ ▆ ▅ ▂ */ 
    protected $objCookiesRememberModel_;
    protected $objCookiesRemember_;

/* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

    /* ▂ ▅ ▆ █ __construct() █ ▆ ▅ ▂ */
    public function __construct( $cookies ){;
        # Step 1: We create a new object CookiesRemember and CookiesRememberModel
        $this -> objCookiesRemember_ = new CookiesRemember( $cookies );
        $this -> objCookiesRememberModel_ = new CookiesRememberModel();
    }

/* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */


};
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>