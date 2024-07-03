<?php
    
    namespace App\Http\Controllers\api;
    
    use App\Http\Controllers\Controller;
    use App\Http\Requests\TransactionFormRequest;
    use App\Http\Resources\TransactionResource;
    use App\Models\Transaction;
    use App\Services\TransactionService;
    use App\traits\ApiResponse;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    
    class TransactionController extends Controller {
        
        use ApiResponse;
        
        protected object $service;
        
        /**
         * ----------------------
         * @param TransactionService $service
         * constructor method to call services
         *  ----------------------
         */
        
        public function __construct ( TransactionService $service ) {
            $this -> service = $service;
        }
        
        /**
         * ----------------------
         * @param Request $request
         * @return JsonResponse
         * get all transactions | filtered one's
         * returns data in json format
         * uses resources to transform data
         *  ----------------------
         */
        
        public function index ( Request $request ): JsonResponse {
            try {
                $data         = $this -> service -> transactions ( $request );
                $transactions = TransactionResource ::collection ( $data[ 'transactions' ] );
                $totalAmount  = $data[ 'totalAmount' ];
                $response     = [
                    'transactions' => $transactions,
                    'totalAmount'  => $totalAmount
                ];
                return $this -> sendResponse ( $response );
            }
            catch ( QueryException|\Exception $exception ) {
                DB ::rollBack ();
                return $this -> sendError ( $exception -> getMessage () );
            }
        }
        
        /**
         * ----------------------
         * @param TransactionFormRequest $request
         * @return JsonResponse
         * stores data into database
         * returns transaction
         * sends email, observer is used in model
         *  ----------------------
         */
        
        public function store ( TransactionFormRequest $request ): JsonResponse {
            try {
                DB ::beginTransaction ();
                $transaction = $this -> service -> save ( $request );
                DB ::commit ();
                return $this -> sendResponse ( new TransactionResource( $transaction ) );
            }
            catch ( QueryException|\Exception $exception ) {
                DB ::rollBack ();
                return $this -> sendError ( $exception -> getMessage () );
            }
        }
        
        /**
         * ----------------------
         * @param Transaction $transaction
         * @return JsonResponse
         * returns single transaction after transformation
         *  ----------------------
         */
        
        public function show ( Transaction $transaction ): JsonResponse {
            try {
                return $this -> sendResponse ( new TransactionResource ( $transaction ) );
            }
            catch ( QueryException|\Exception $exception ) {
                DB ::rollBack ();
                return $this -> sendError ( $exception -> getMessage () );
            }
        }
        
        /**
         * ----------------------
         * @param TransactionFormRequest $request
         * @param Transaction $transaction
         * @return JsonResponse
         * updates transaction
         *  ----------------------
         */
        
        public function update ( TransactionFormRequest $request, Transaction $transaction ): JsonResponse {
            try {
                DB ::beginTransaction ();
                $transaction = $this -> service -> update ( $request, $transaction );
                DB ::commit ();
                return $this -> sendResponse ( new TransactionResource( $transaction ) );
            }
            catch ( QueryException|\Exception $exception ) {
                DB ::rollBack ();
                return $this -> sendError ( $exception -> getMessage () );
            }
        }
        
        /**
         * ----------------------
         * @param Transaction $transaction
         * @return JsonResponse
         * deletes transactions
         * uses soft deletes
         *  ----------------------
         */
        
        public function destroy ( Transaction $transaction ): JsonResponse {
            try {
                DB ::beginTransaction ();
                $this -> service -> delete ( $transaction );
                DB ::commit ();
                return $this -> sendResponse ( '' );
            }
            catch ( QueryException|\Exception $exception ) {
                DB ::rollBack ();
                return $this -> sendError ( $exception -> getMessage () );
            }
        }
        
        /**
         * ----------------------
         * @return JsonResponse
         * gets user current balance
         * converts it into currency rate $$
         *  ----------------------
         */
        
        public function balance (): JsonResponse {
            try {
                $balance = $this -> service -> get_balance ();
                return $this -> sendResponse ( [ 'balance' => $balance ] );
            }
            catch ( \Exception $exception ) {
                DB ::rollBack ();
                return $this -> sendError ( $exception -> getMessage () );
            }
        }
    }
