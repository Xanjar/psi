@extends('layout')
@section('contenu')
<div class="container">
  <div>
    <h2>Ajouter ou modifier un groupe</h2>
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
  <form action="/groupe/@if(!empty($groupe['id_groupe'])){{"modify/".$groupe['id_groupe']}}@else{{"create"}}@endif" 
      method="post">
      
      {{ csrf_field() }}
      <div class="form-group">
          <label for="libelle">Libellé</label>
          <input name="libelle" class="form-control" id="libelle" placeholder="Libellé du groupe" value="@if(!empty($groupe['libelle'])){{$groupe['libelle']}}@endif" required>
      </div>
  <button type="submit" class="btn btn-primary">Ajouter/modifier</button>
   
  </form>
</div>
@endsection