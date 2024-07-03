<?php
    
    namespace App\Observers;
    
    use App\Events\BroadCastTransactionCreatedEvent;
    use App\Models\Transaction;
    use App\Notifications\TransactionCreateNotification;
    use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
    use Illuminate\Support\Facades\Log;
    
    class TransactionObserver implements ShouldDispatchAfterCommit {
        
        public function created ( Transaction $transaction ): void {
            Log ::info ( $transaction );
            $transaction -> user -> notify ( new TransactionCreateNotification( $transaction ) );
            BroadCastTransactionCreatedEvent ::dispatch ( $transaction );
        }
        
        public function updated ( Transaction $transaction ): void {
            //
        }
        
        public function deleted ( Transaction $transaction ): void {
            //
        }
    }
