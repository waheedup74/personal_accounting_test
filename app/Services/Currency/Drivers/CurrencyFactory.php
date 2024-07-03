<?php
    
    namespace App\Services\Currency\Drivers;
    
    class CurrencyFactory {
        
        /**
         * ----------------------
         * @param $driver
         * @return JSONDriver|CSVDriver|XMLDriver
         * @throws \Exception
         * matches the called/passed driver
         * returns the driver
         *  ----------------------
         */
        
        public static function make ( $driver ): JSONDriver|CSVDriver|XMLDriver {
            return match ( $driver ) {
                'xml'   => new XMLDriver(),
                'json'  => new JSONDriver(),
                'csv'   => new CSVDriver(),
                default => throw new \Exception( "Driver not supported" ),
            };
        }
    }
