@extends('layout')
@section('contenu')
<div class="container">
  <div>
    <h2>Ajouter ou modifier des individu</h2>
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
  <a href="/appartenir/{{$groupe['id_groupe']}}" class="btn btn-primary">Retour liste </a>
  @if(!empty($individus))
<form action="/appartenir/gerer/{{$groupe['id_groupe']}}" method="post">
      
    {{ csrf_field() }}
    <div class="text-right">
    <button type="submit" class="btn btn-primary">Ajouter/modifier</button>
    </div>
    <table class="table table-striped" data-toggle="table"
        data-search="false">
            <thead>
                <tr>
                    <th data-sortable="false">Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Appartient au groupe</th>
                </tr>
        </thead>
            <tbody>
                @foreach($individus as $individu)
                <tr>
                    <td>{{ $individu->nom }}</td>
                    <td>{{ $individu->prenom }}</td>
                    <td>{{ $individu->email }}</td>
                    <td><div class="form-group">
                        <input type="checkbox" value="{{$individu->id_individu}}" id="{{$individu->id_individu}}" name="choisi[]" @if(!empty($appartenir->where('id_individu',$individu->id_individu)->first()))checked @endif>
                        <label for="{{$individu->id_individu}}">Appartient au groupe</label>
                    </div></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    <button type="submit" class="btn btn-primary">Ajouter/modifier</button>
   
  </form>
  @else
  <div class="text-center">
      <span>Aucun individu n'est dans ce groupe.</span>
  </div>
  @endif

</div>
@endsection