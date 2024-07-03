<?php
    
    namespace App\Services;
    
    class Helper {
        
        /**
         * ----------------------
         * @return mixed
         * gets app binding
         * calls the default driver rate
         *  ----------------------
         */
        
        function currency_rate () {
            return app ( 'currency' ) -> getRate ();
        }
    }
