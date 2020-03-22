<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Individu extends Model
{
    public $table = "individu";
    public $timestamps = false;
    protected $fillable = ['nom', 'prenom', 'email','num','id_annuaire','id_statut'];
}
