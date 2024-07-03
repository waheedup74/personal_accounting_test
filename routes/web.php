<?php
    
    use App\Http\Controllers\api\AuthController;
    use Illuminate\Support\Facades\Route;
    
    Route ::get ( '/', function () {
        return '<h1>Personal Accounting</h1>';
    } ) -> name ( 'login' );
