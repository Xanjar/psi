<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Individu;
use App\Annuaire;
use App\Statut;
use App\Appartenir;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IndividuImport;

class IndividuController extends Controller
{
    /**
     * Liste des individus
     *
     * @param
     * @return View
     */
    public function show()
    {
        $data = array();
        $data['individus'] = Individu::all();
        return view('individu/listeIndividu', $data);
    }

    /**
    * affichage de create via get
    *
    * @param
    * @return View
    */
    public function showCreate(){
        $data = array();
        $data['statut']=Statut::all();
        $data['annuaire']=Annuaire::all();
        return view('individu/createModify',$data);
    }

    /**
    * affichage de l'individu via get
    *
    * @param
    * @return View
    */
    public function showModify($idIndividu){
        $data = array();
        
        $data['individu']=Individu::where('id_individu',$idIndividu)->first();
        $data['statut']=Statut::all();
        $data['annuaire']=Annuaire::all();
        return view('individu/createModify',$data);
    }

    /**
     * Créer un individu
     *
     * @param
     * @return View
     */
    public function create(Request $req) {
        $data = array();
        $data['statut']=Statut::all();
        $data['annuaire']=Annuaire::all();
        try {
            if(Individu::where('num',$req->input('num'))->count()){
                $data['echec']='L\'individu n°'.$req->input('num').' existe déjà';
                return view('individu/createModify',$data);
            }
            $individu = new Individu;
            $individu->nom=$req->input('nom');
            $individu->prenom=$req->input('prenom');
            $individu->email=$req->input('email');
            $individu->num=$req->input('num');
            $individu->id_statut=$req->input('id_statut');
            $individu->id_annuaire=$req->input('id_annuaire');
            $individu->save();
        } catch(\Illuminate\Database\QueryException $e) {
            $data['echec']='Echec dans la création de l\'individu';
            return view('individu/createModify',$data);
        }
        $data['succes']='L\'individu a été crée';
        return view('individu/createModify',$data);
    }

    /**
     * Modifier un individu
     *
     * @param  int  $id
     * @return View
     */
    public function modify($idIndividu, Request $req) {
        $data = array();
        $data['statut']=Statut::all();
        $data['annuaire']=Annuaire::all();
        try {
            if(Individu::where('num',$req->input('num'))->where('id_individu','!=',$idIndividu)->count()){
                $data['echec']='L\'individu n°'.$req->input('num').' existe déjà';
                $data['individu']=Individu::where('id_individu',$idIndividu)->first();
                return view('individu/createModify',$data);
            }
            $individu = array();
            $individu['nom']=$req->input('nom');
            $individu['prenom']=$req->input('prenom');
            $individu['email']=$req->input('email');
            $individu['num']=$req->input('num');
            $individu['id_statut']=$req->input('id_statut');
            $individu['id_annuaire']=$req->input('id_annuaire');

            Individu::where('id_individu', $idIndividu)
            ->update($individu);
            $data['individu']=Individu::where('id_individu',$idIndividu)->first();
        } catch(\Illuminate\Database\QueryException $e) {
            $data['echec']='Echec dans la modification de l\'individu';
            $data['individu']=Individu::where('id_individu',$idIndividu)->first();
            return view('individu/createModify',$data);
        }
        $data['succes']='L\'individu a été modifié';
        return view('individu/createModify',$data);
    }

    /**
     * Supprimer un individu
     *
     * @param  int  $id
     * @return redirect
     */
    public function delete($idIndividu) {
        try{
            DB::transaction(function() use ($idIndividu){
                Appartenir::where('id_individu','=',$idIndividu)->delete();
                Individu::where('id_individu', '=', $idIndividu)->delete();
            });
        }catch(\Illuminate\Database\QueryException $e) {
            return redirect()->route('individu')->with('echec', 'Echec dans la suppression de l\'individu');
        }
        return redirect()->route('individu')->with('succes','L\'individu a été supprimé');
    }

    public function importer(Request $request){
        $data=array();
        if(!empty($request->all()) && $request->hasFile('fichier')){
            $nom = $request->fichier->getClientOriginalName();
            $path = $request->fichier->storeAs('storage',$nom);
            try{
                Excel::import(new IndividuImport,$path);
            } catch(\Illuminate\Database\QueryException $e){
                return redirect()->route('individu')->with('echec', 'Echec dans l\'ajout des individu');
            }
            return redirect()->route('individu')->with('succes','Les individus ont été ajoutés');
        }
        return redirect()->route('individu')->with('echec', 'Aucun fichier envoyé');
    }

}