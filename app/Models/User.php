<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks() : HasMany {
        return $this->hasMany(Task::class, 'user_id', 'id' );
        
    }

   /**
    * The roles thashareTaskong to the Usey
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function sharedTasks(): BelongsToMany
   {
       return $this->belongsToMany(Task::class, 'task_user')->withPivot('permision');
       // la instrucción anterior busca en la tabla Task que es donde se encontraran todas las tareas, a continuación 
       //debemos hacer referencia a la tabla pivote que en este caso es task_user y a continuacion podemos indicar de esa 
       // table pivote que campo de la misma que queremos traernos.
   }


    
}
