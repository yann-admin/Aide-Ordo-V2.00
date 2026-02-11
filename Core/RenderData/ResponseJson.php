<?php
/* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ NameSpace █ ▆ ▅ ▂ */
    namespace App\Core\RenderData;
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Inclusion █ ▆ ▅ ▂ */

/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */ 

/* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
class ResponseJson {
    /* ▂ ▅ Attributs ▅ ▂ */
        // private $status_;
        // private $div_ ;
        // private $msg_ ;
        // private $data_;
        // private $redirect_;
        // private $responseJson_;
    /* ▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █ Methodes █ ▆ ▅ ▂ */

    /* ▂ ▅ ▆ █ Bloc Response Fetch ( ) █ ▆ ▅ ▂ */
    public function responseFetch( $responseFetch ){
        # We check if the response is an array
        if( is_array($responseFetch) ){
            # We return the response in json format
            return json_encode($responseFetch, JSON_UNESCAPED_SLASHES);
        }else{
            # We return the response in string format
            return $responseFetch;
        }
    } 

};

?>
