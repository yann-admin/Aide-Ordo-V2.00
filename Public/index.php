<?php
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
    # ?XDEBUG_SESSION_START=1
            
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    /* ▂ ▅ ▆ █ session_start █ ▆ ▅ ▂ */
        # Reco via https://www.php.net/manual/en/session.security.ini.php:
        # Il est recommandé de changer le nom $_SESSION['PHPSESSID'] pour une application réelle
        ini_set('session.name', 'AideHordo');

        # 0 possède une signification particulière. Il informe les navigateurs de ne pas stocker le cookie en stockage permanent. Par conséquent, lorsque le navigateur est terminé, le cookie d’ID de session est immédiatement supprimé. Si les développeurs définissent cela autrement que 0, cela peut permettre à d’autres utilisateurs d’utiliser l’ID de session. La plupart des applications devraient utiliser « » pour cela. 0 est approprié pour les applications très sensibles à la sécurité.
        ini_set('session.cookie_lifetime', 0);

        # Session.use_cookies précise si le Le module utilisera des cookies pour stocker l’identifiant de session sur le client Side. Par défaut à 1 (activé)
        ini_set('session.use_cookies', 1);

        # Session.use_only_cookies précise si Le module n’utilisera que Des cookies pour stocker l’identifiant de session côté client. Activer ce paramètre empêche les attaques impliquant de passer une session Les identifiants dans les URL. Par défaut à 1 (activé). 
        ini_set('session.use_only_cookies', 1);

        # Session.use_strict_mode précise si le Le module utilisera un mode d’identification de session strict. Si ce mode est activé, le module n’accepte pas d’identifiants de session non initialisés. Si un non initialisé l’identifiant de session est envoyé depuis le navigateur, un nouvel identifiant de session est envoyé au navigateur. Les applications sont protégées contre la fixation de session via l’adoption de session avec un mode strict. Par défaut à 0 (désactivé).
        ini_set('session.use_strict_mode', 1);

        # Marque le cookie pour qu'il ne soit accessible que via le protocole HTTP. Cela signifie que le cookie ne sera pas accessible par les langage de script, comme Javascript. Cette configuration permet de limiter les attaques comme les attaques XSS (bien qu'elle n'est pas supporté par tous les navigateurs).
        ini_set('session.cookie_httponly', 1);

        # Session.cookie_secure précise si Les cookies ne doivent être envoyés que via des connexions sécurisées. Avec cet ensemble d’options pour les sessions ne fonctionnent qu’avec des connexions HTTPS. Si c’est désactivé, alors les sessions fonctionnent à la fois avec HTTP et Connexions HTTPS. Par défaut, c’est désactivé. Voir aussi session_get_cookie_params() et session_set_cookie_params().
        ini_set('session.cookie_secure', 1);

        # Permet aux serveurs d’affirmer qu’un cookie ne doit pas être envoyé avec Demandes inter-sites. Cette affirmation permet aux agents utilisateurs d’atténuer le risque de fuite d’informations à origine croisée, et offre une certaine protection contre Attaques de falsification par demande inter-site. Notez que cela n’est pas pris en charge par tous navigateurs. Une valeur vide signifie qu’aucun attribut de cookie SameSite ne sera défini. Laxiste et Strict signifient que le cookie ne sera pas envoyé en cross-domaine pour les requêtes POST ; Lax enverra le cookie pour les requêtes GET inter-domaine, tandis que Strict ne le fera pas.
        ini_set('session.cookie_samesite', 'Strict');

        # Session.cookie_path spécifie chemin vers ensemble dans le cookie de session. Par défaut /. Voir aussi session_get_cookie_params() et session_set_cookie_params().
        ini_set('session.cookie_path', '/');

        session_start();
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */    


    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
        use App\Core\Session\Session;
        use App\Autoloader;
        use App\Core\Router\Router;  
        use Dotenv\Dotenv;
        // 
        require '../vendor/autoload.php';
        include '../Autoloader.php';  
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Call  █ ▆ ▅ ▂ */
        Autoloader::register();
        # We start the session management
        $objSession = new Session();
        $objSession -> sessionStartTimer();     
        
        # We load the .env file
        $dotenv = Dotenv::createImmutable(__DIR__, '../.env.' . 'development');
        //$dotenv = Dotenv::createImmutable(__DIR__, '../.env.' . 'production');
        $dotenv->load();

        # On instancie le routeur :
        $route = new Router();
        # On lance l'application :
        $route->routes();
        

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


?>                        
                        
