<?php
namespace App\Http\Controllers;
use App\Exports\IndividuExport;
use App\Http\Controllers\Controller;

use App\Groupe;
use App\Individu;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    
    public function export($extension, $idGroup){
        $g = Groupe::where('id_groupe',$idGroup)->first();;
        $headings = [ 
            'nom', 
            'prenom',
            'email',
            'num',
            'id_annuaire',
            'id_statut',
        ];
        return (new IndividuExport($idGroup,$headings))->download($g->libelle.'.'.$extension);
    }

}