<?php
    
    namespace App\Services\Currency\Drivers;
    
    use Illuminate\Support\Facades\Cache;
    
    class JSONDriver {
        
        /**
         * ----------------------
         * @return float
         * json driver
         * loads rates from file
         * saves in cache for 5 mins
         *  ----------------------
         */
        
        public function getRate (): float {
            return Cache ::remember ( 'json_rate', 300, function () {
                $json = json_decode ( file_get_contents ( storage_path ( 'app/public/rates.json' ) ), true );
                return (float) $json[ 'rate' ];
            } );
        }
    }
