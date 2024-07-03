<?php
    
    use App\Http\Controllers\api\AuthController;
    use App\Http\Controllers\api\TransactionController;
    use Illuminate\Support\Facades\Route;
    
    Route ::post ( '/login', [ AuthController::class, 'login' ] );
    
    Route ::middleware ( [ 'auth:sanctum', 'lastSeen' ] ) -> group ( function () {
        Route ::apiResource ( 'transactions', TransactionController::class );
        Route ::get ( '/user/balance', [ TransactionController::class, 'balance' ] );
        Route ::post ( '/logout', [ AuthController::class, 'logout' ] );
    } );