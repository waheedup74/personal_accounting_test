<?php
    
    namespace App\Events;
    
    use Illuminate\Broadcasting\Channel;
    use Illuminate\Broadcasting\InteractsWithSockets;
    use Illuminate\Broadcasting\PresenceChannel;
    use Illuminate\Broadcasting\PrivateChannel;
    use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
    use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
    use Illuminate\Foundation\Events\Dispatchable;
    use Illuminate\Queue\SerializesModels;
    
    class BroadCastTransactionCreatedEvent implements ShouldDispatchAfterCommit {
        use Dispatchable, InteractsWithSockets, SerializesModels;
        
        public object $transaction;
        
        public function __construct ( $transaction ) {
            $this -> transaction = $transaction;
        }
        
        public function broadcastOn (): array {
            return [
                new PrivateChannel( 'channel-name' ),
            ];
        }
    }
