<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Enable/disable the timestamps field.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['login', 'role', 'first_name', 'last_name', 'email', 'tel', 'remember_token', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token', 'password'];

    /**
     * Doctor user IDs.
     *
     * @var array
     */
    public static $doctorIds = [1, 2, 3];

    /**
     * Return doctor users collection.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function doctors()
    {
        return static::whereIn('id', static::$doctorIds)->orderBy('id')->get();
    }

}
