<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Encadreur extends Model
{
    protected $fillable = ['user_id', 'specialite', 'departement', 'telephone'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function stages() {
        return $this->hasMany(Stage::class);
    }
}
