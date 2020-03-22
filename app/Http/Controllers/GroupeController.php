<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Groupe;
use App\Appartenir;
use Illuminate\Http\Request;
use DB;

class GroupeController extends Controller
{
    /**
     * Liste des groupes
     *
     * @param
     * @return View
     */
    public function show()
    {
        $data = array();
        $data['groupes'] = Groupe::all();
        return view('groupe/listeGroupe', $data);
    }

    /**
    * affichage groupe via get
    *
    * @param
    * @return View
    */
    public function showModify($idGroup){
        $data = array();
        
        $data['groupe']=Groupe::where('id_groupe',$idGroup)->first();
        return view('groupe/createModify',$data);
    }

    /**
     * Créer un groupe
     *
     * @param
     * @return View
     */
    public function create(Request $req) {
        try {
            $groupe = new Groupe;
            $groupe->libelle = $req->input('libelle');
            $groupe->save();
        } catch(\Illuminate\Database\QueryException $e) {
            return view('groupe/createModify',['echec' => 'Echec dans la création du groupe']);
        }
        return view('groupe/createModify',['succes' => 'Le groupe a été crée']);
    }

    /**
     * Modifier un groupe
     *
     * @param  int  $id
     * @return View
     */
    public function modify($idGroup, Request $req) {
        try {
            Groupe::where('id_groupe', $idGroup)
            ->update(['libelle' => $req->input('libelle')]);
            $data = array();
            $data['groupe']=Groupe::where('id_groupe',$idGroup)->first();
        } catch(\Illuminate\Database\QueryException $e) {
            $data['groupe']=Groupe::where('id_groupe',$idGroup)->first();
            $data['echec']='Echec dans la modification du groupe';
            return view('groupe/createModify',$data);
        }
        $data['succes']= 'Le groupe a été modifié';
        return view('groupe/createModify',$data);
    }

    /**
     * Supprimer un groupe
     *
     * @param  int  $id
     * @return redirect
     */
    public function delete($idGroup) {
        try{
            DB::transaction(function() use ($idGroup){
                Appartenir::where('id_groupe','=',$idGroup)->delete();
                Groupe::where('id_groupe', '=', $idGroup)->delete();
                
            });
        }catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('groupe')->with('echec', 'Echec dans la suppression du groupe');
        }
        return redirect()->route('groupe')->with('succes','Le groupe a été supprimé');
    }
}