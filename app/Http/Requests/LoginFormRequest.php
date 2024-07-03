<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    
    class LoginFormRequest extends FormRequest {
        
        /**
         * ----------------------
         * @return bool
         *  ----------------------
         */
        
        public function authorize (): bool {
            return true;
        }
        
        /**
         * ----------------------
         * @return array[]
         * validates request
         *  ----------------------
         */
        
        public function rules (): array {
            return [
                'email'    => [ 'required', 'email' ],
                'password' => [ 'required', 'string' ],
            ];
        }
    }
