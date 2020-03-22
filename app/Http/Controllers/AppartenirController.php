<?php
namespace App\Http\Controllers;
use App\Exports\IndividuExport;
use App\Http\Controllers\Controller;
use App\Appartenir;
use App\Groupe;
use App\Individu;
use DB;
use Illuminate\Http\Request;

class AppartenirController extends Controller
{
    /** 
     * Liste des individus d'un groupe
     * 
     * @param
     * @return View
     */
    public function show($idGroup)
    {
        $data = array();
        $data['individus'] = Individu::join('appartenir', 'individu.id_individu', '=', 'appartenir.id_individu')->where('appartenir.id_groupe',$idGroup)->get();
        $data['groupe'] = Groupe::where('id_groupe',$idGroup)->first();
        return view('appartenir/liste', $data);
    }

    /** 
     * Affichage gestion liste
     *
     * @param
     * @return View
     */
    public function showGerer($idGroup)
    {
        $data = array();
        $data['individus'] = Individu::all();
        $data['appartenir'] = Appartenir::where('id_groupe',$idGroup)->get();
        $data['groupe'] = Groupe::where('id_groupe',$idGroup)->first();
        return view('appartenir/gerer', $data);
    }

    public function gerer(Request $req,$idGroup)
    {
        $data = array();
        $data['individus'] = Individu::all();
        $data['groupe'] = Groupe::where('id_groupe',$idGroup)->first();
        try{
            DB::transaction(function() use ($req,$idGroup){
               Appartenir::where('id_groupe', '=', $idGroup)->delete();
                foreach($req->input('choisi') as $idIndiv){
                    $appartenir = new Appartenir;
                    $appartenir->id_individu=$idIndiv;
                    $appartenir->id_groupe=$idGroup;
                    $appartenir->save();
                }
            });
        } catch(\Illuminate\Database\QueryException $e) {
            $data['appartenir'] = Appartenir::where('id_groupe',$idGroup)->get();
            $data['echec']= 'Echec dans l\'ajout des individus';
            return view('appartenir/gerer',$data);
        }
        
        $data['appartenir'] = Appartenir::where('id_groupe',$idGroup)->get();
        $data['succes']='Ajout des individus réussi';
        return view('appartenir/gerer',$data);
    }

    public function delete($idGroup, $idIndiv) {
        try{
            Appartenir::where('id_groupe', '=', $idGroup)->where('id_individu', '=', $idIndiv)->delete();
        }catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('appartenir', ['idGroup' => $idGroup])->with('echec', 'Echec dans la suppression de l\'individu');
        }
        return redirect()->route('appartenir',['idGroup' => $idGroup])->with('succes','L\'individu a été supprimé du goupe');
    }


    public function getXls($idGroup){
        $g = Groupe::where('id_groupe',$idGroup)->first();;
        $headings = [
            'id_individu', 
            'nom', 
            'prenom',
            'email',
            'num',
            'id_annuaire',
            'id_statut',
            'id_groupe', 
        ];
        return (new IndividuExport($idGroup,$headings))->download($g->libelle.'.xlsx');
    }

}