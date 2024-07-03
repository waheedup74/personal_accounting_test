<?php
    
    namespace App\Services\Currency\Drivers;
    
    use Illuminate\Support\Facades\Cache;
    
    class XMLDriver {
        
        /**
         * ----------------------
         * @return float
         * xml driver
         * loads rates from file
         * saves in cache for 5 mins
         *  ----------------------
         */
        
        public function getRate (): float {
            return Cache ::remember ( 'xml_rate', 300, function () {
                $xml = simplexml_load_file ( storage_path ( 'app/public/rates.xml' ) );
                return (float) $xml -> currency ?-> rate;
            } );
        }
    }
