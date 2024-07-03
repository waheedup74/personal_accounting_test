<?php
    
    namespace App\Http\Controllers\api;
    
    use App\Http\Controllers\Controller;
    use App\Http\Requests\LoginFormRequest;
    use App\traits\ApiResponse;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    
    class AuthController extends Controller {
        
        use ApiResponse;
        
        /**
         * ----------------------
         * @param LoginFormRequest $request
         * @return JsonResponse
         * handles the login functionality & returns the json response
         *  ----------------------
         */
        
        public function login ( LoginFormRequest $request ): JsonResponse {
            $email      = $request -> input ( 'email' );
            $password   = $request -> input ( 'password' );
            $rememberMe = $request -> input ( 'remember' );
            
            try {
                if ( Auth ::attempt ( [ 'email' => $email, 'password' => $password ], $rememberMe ) ) {
                    $user  = Auth ::user ();
                    $token = $user -> createToken ( 'auth_token' ) -> plainTextToken;
                    return $this -> sendResponse ( [
                                                       'user'  => $user,
                                                       'token' => $token
                                                   ] );
                }
                return $this -> sendError ( 'Invalid username or password' );
            }
            catch ( \Exception $exception ) {
                return $this -> sendError ( $exception -> getMessage () );
            }
        }
        
        /**
         * ----------------------
         * @param Request $request
         * @return void
         * invalidates all user tokens & logs out
         *  ----------------------
         */
        
        public function logout ( Request $request ): void {
            $request -> user () -> tokens () -> delete ();
        }
    }
