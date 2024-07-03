<?php
    
    namespace App\Services\Currency\Drivers;
    
    use Illuminate\Support\Facades\Cache;
    
    class CSVDriver {
        
        /**
         * ----------------------
         * @return float
         * csv driver
         * loads rates from file
         * saves in cache for 5 mins
         *  ----------------------
         */
        
        public function getRate (): float {
            return Cache ::remember ( 'csv_rate', 300, function () {
                $csv = array_map ( 'str_getcsv', file ( storage_path ( 'app/public/rates.csv' ) ) );
                return (float) $csv[ 1 ][ 1 ];
            } );
        }
    }
