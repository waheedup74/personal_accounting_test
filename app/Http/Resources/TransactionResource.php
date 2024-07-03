<?php
    
    namespace App\Http\Resources;
    
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
    
    class TransactionResource extends JsonResource {
        
        /**
         * ----------------------
         * @param Request $request
         * @return array
         * transforms the collections | instance
         *   ----------------------
         */
        
        public function toArray ( Request $request ): array {
            return [
                'id'     => $this -> id,
                'type'   => $this -> type,
                'amount' => $this -> amount
            ];
        }
    }
