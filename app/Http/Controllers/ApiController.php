<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Groupe;
use App\Appartenir;
use App\Individu;
use Illuminate\Http\Request;
use DB;

class ApiController extends Controller
{
    public function showJson($idGroup)
    {
        $data = array();
        return response()->json(Individu::join('appartenir', 'individu.id_individu', '=', 'appartenir.id_individu')->where('appartenir.id_groupe',$idGroup)->get());
    }
}