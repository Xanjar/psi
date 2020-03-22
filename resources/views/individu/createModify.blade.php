@extends('layout')
@section('contenu')
<div class="container">
  <div>
    <h2>Ajouter ou modifier un individu</h2>
  </div>
  @if(!empty($succes))
  <div id="notifMsg" class="alert alert-success">
      {{ $succes }}
  </div>
  @elseif(!empty($echec))
  <div id="notifMsg" class="alert alert-danger">
      {{ $echec }}
  </div>
  @endif
  <form action="/individu/@if(!empty($individu['id_individu'])){{"modify/".$individu['id_individu']}}@else{{"create"}}@endif" 
      method="post">
      
    {{ csrf_field() }}
    <div class="form-group">
        <label for="nom">Nom</label>
        <input required name="nom" class="form-control" id="nom" placeholder="Nom" value="@if(!empty($individu['nom'])){{$individu['nom']}}@endif" required>
    </div>
    <div class="form-group">
        <label for="prenom">Prénom</label>
        <input required name="prenom" class="form-control" id="prenom" placeholder="Prénom" value="@if(!empty($individu['prenom'])){{$individu['prenom']}}@endif" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input required type="email" name="email" class="form-control" id="email" placeholder="xyz@example.com" value="@if(!empty($individu['email'])){{$individu['email']}}@endif" required>
    </div>
    <div class="form-group">
        <label for="num">Num</label>
        <input required name="num" class="form-control" id="num" placeholder="Num" value="@if(!empty($individu['num'])){{$individu['num']}}@endif" required>
    </div>
    <div class="form-group">
        <label for="id_statut">Statut</label>
        <select name="id_statut" id="id_statut" class="form-control">
            @foreach ($statut as $s)
                <option value="{{$s->id_statut}}" @if(!empty($individu['id_statut']))@if($individu['id_statut']===$s->id_statut) selected @endif @endif>
                    {{$s->libelle}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="id_annuaire">Annuaire</label>
        <select name="id_annuaire" id="id_annuaire" class="form-control">
            @foreach ($annuaire as $a)
                <option value="{{$a->id_annuaire}}" @if(!empty($individu['id_annuaire']))@if($individu['id_annuaire']===$a->id_annuaire) selected @endif @endif>
                    {{$a->libelle}}
                </option>
            @endforeach
        </select>
    </div>
  <button type="submit" class="btn btn-primary">Ajouter/modifier</button>
   
  </form>
</div>
@endsection