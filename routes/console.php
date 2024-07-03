<?php
    
    use Illuminate\Foundation\Inspiring;
    use Illuminate\Support\Facades\Artisan;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Schedule;
    
    Artisan ::command ( 'inspire', function () {
        $this -> comment ( Inspiring ::quote () );
    } ) -> purpose ( 'Display an inspiring quote' ) -> hourly ();
    
    Schedule ::call ( function () {
        Cache ::forget ( 'xml_rate' );
        Cache ::forget ( 'json_rate' );
        Cache ::forget ( 'csv_rate' );
    } ) -> everyFiveMinutes ();
