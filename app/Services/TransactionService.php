<?php
    
    namespace App\Services;
    
    use App\Models\Transaction;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    
    class TransactionService {
        
        /**
         * ----------------------
         * @param $request
         * @return array
         * get transactions
         * applies filtration
         *  ----------------------
         */
        
        public function transactions ( $request ): array {
            $transactions = $request -> user () -> transactions () -> newQuery ();
            
            if ( $request -> filled ( 'type' ) )
                $transactions -> where ( [ 'type' => $request -> input ( 'type' ) ] );
            
            if ( $request -> filled ( 'start-date' ) && $request -> filled ( 'end-date' ) ) {
                $start_date = date ( 'Y-m-d', strtotime ( $request -> input ( 'start-date' ) ) );
                $end_date   = date ( 'Y-m-d', strtotime ( $request -> input ( 'end-date' ) ) );
                $transactions -> whereBetween ( DB ::raw ( 'DATE(created_at)' ), [ $start_date, $end_date ] );
            }
            
            if ( $request -> filled ( 'amount' ) ) {
                $amount = $request -> input ( 'amount' );
                $transactions -> whereBetween ( 'amount', [ $amount, $amount ] );
            }
            
            $totalAmount = $transactions -> sum ( 'amount' );
            
            return [
                'transactions' => $transactions -> get (),
                'totalAmount'  => $totalAmount
            ];
        }
        
        /**
         * ----------------------
         * @param $request
         * @return mixed
         * save transaction
         *  ----------------------
         */
        
        public function save ( $request ) {
            return Transaction ::create ( [
                                              'user_id' => $request -> user () -> id,
                                              'type'    => $request -> type,
                                              'amount'  => $request -> amount,
                                          ] );
        }
        
        /**
         * ----------------------
         * @param $request
         * @param $transaction
         * @return mixed
         * update transaction
         *  ----------------------
         */
        
        public function update ( $request, $transaction ): mixed {
            $transaction -> type   = $request -> input ( 'type' );
            $transaction -> amount = $request -> input ( 'amount' );
            $transaction -> update ();
            return $transaction;
        }
        
        /**
         * ----------------------
         * @param $transaction
         * @return void
         * delete transaction
         *  ----------------------
         */
        
        public function delete ( $transaction ): void {
            $transaction -> delete ();
        }
        
        /**
         * ----------------------
         * @return float|int
         * get user balance
         *  ----------------------
         */
        
        public function get_balance (): float|int {
            $balance = Auth ::user () -> transactions () -> sum ( 'amount' );
            return $balance * ( ( new Helper() ) -> currency_rate () );
        }
        
    }
