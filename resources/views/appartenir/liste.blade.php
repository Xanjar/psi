@extends('layout')
@section('contenu')

<section class="section">
    <div class="container">
        <h2>Liste des individus du groupe {{$groupe['libelle']}}</h2>
        @if(session('succes'))
        <div id="notifMsg" class="alert alert-success">
            {{ session('succes') }}
        </div>
        @elseif(session('echec'))
        <div id="notifMsg" class="alert alert-danger">
            {{ session('echec') }}
        </div>
        @endif
        <a href="/appartenir/gerer/{{$groupe['id_groupe']}}" class="btn btn-primary">Gérer la liste</a>
        
        <div class="text-center">
            <div class="dropdown text-center">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  Exporter la liste
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenu1">
                    <li><a href="/export/xlsx/{{$groupe['id_groupe']}}" class="">XSLX</a></li>
                    <li><a href="/export/csv/{{$groupe['id_groupe']}}" class="">CSV</a></li>
                </ul>
              </div>
        </div>
        @if(!empty($individus))
        <table class="table table-striped" data-toggle="table"
        data-search="true" data-show-export="true">
            <thead>
                <tr>
                    <th data-sortable="true">Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Supprimer</th>
                </tr>
        </thead>
            <tbody>
                @foreach($individus as $individu)
                <tr>
                    <td>{{ $individu->nom }}</td>
                    <td>{{ $individu->prenom }}</td>
                    <td>{{ $individu->email }}</td>
                <td><a href="/appartenir/delete/{{$groupe['id_groupe']}}/{{$individu->id_individu}}" class="btn btn-danger">Supprimer du groupe</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center">
            <span>Aucun individu n'est dans ce groupe.</span>
        </div>
        @endif
    </div>
</section>

@endsection