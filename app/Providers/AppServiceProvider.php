<?php
    
    namespace App\Providers;
    
    use App\Services\Currency\Drivers\CurrencyFactory;
    use Illuminate\Support\ServiceProvider;
    
    class AppServiceProvider extends ServiceProvider {
        
        public function register (): void {
            //
        }
        
        public function boot (): void {
            $this -> app -> singleton ( 'currency', function ( $app ) {
                return CurrencyFactory ::make ( config ( 'app.currency.driver' ) );
            } );
        }
    }
