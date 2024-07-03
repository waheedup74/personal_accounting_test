<?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Log;
    
    class TransactionFormRequest extends FormRequest {
        
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
                'amount' => [ 'required', 'numeric' ],
                'type'   => [ 'required', 'string', 'in:receipt,expense' ],
            ];
        }
    }
