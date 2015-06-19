<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rdv extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rdvs';

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
    protected $fillable = ['admin_id', 'guest_id', 'start_at', 'end_at', 'duration', 'name', 'email', 'tel', 'body', 'color', 'created_by', 'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
