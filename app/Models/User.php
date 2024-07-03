<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Laravel\Sanctum\HasApiTokens;
    
    class User extends Authenticatable {
        use HasFactory, Notifiable, HasApiTokens;
        
        protected $guarded = [];
        protected $hidden  = [ 'password', 'remember_token' ];
        
        protected function casts (): array {
            return [
                'email_verified_at' => 'datetime',
                'password'          => 'hashed',
            ];
        }
        
        public function transactions (): HasMany {
            return $this -> hasMany ( Transaction::class );
        }
    }
