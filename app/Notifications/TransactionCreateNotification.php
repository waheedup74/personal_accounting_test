<?php
    
    namespace App\Notifications;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;
    
    class TransactionCreateNotification extends Notification {
        use Queueable;
        
        public object $transaction;
        
        public function __construct ( $transaction ) {
            $this -> transaction = $transaction;
        }
        
        public function via ( object $notifiable ): array {
            return [ 'mail' ];
        }
        
        public function toMail ( object $notifiable ): MailMessage {
            return ( new MailMessage )
                -> subject ( 'Transaction# ' . $this -> transaction -> id . ' added by user: ' . $notifiable -> name )
                -> greeting ( 'Hello, ' . $notifiable -> name )
                -> line ( 'Your transaction has been added.' )
                -> line ( 'Transaction Type: ' . ucwords ( $this -> transaction -> type ) )
                -> line ( 'Transaction Amount: ' . number_format ( $this -> transaction -> amount, 5 ) )
                -> line ( 'Thank you for using our application!' );
        }
        
        public function toArray ( object $notifiable ): array {
            return [
                //
            ];
        }
    }
