@extends('layout')
@section('contenu')

<section class="section">
    <div class="container">
        <h2>Liste des groupes</h2>
        @if(session('succes'))
        <div id="notifMsg" class="alert alert-success">
            {{ session('succes') }}
        </div>
        @elseif(session('echec'))
        <div id="notifMsg" class="alert alert-danger">
            {{ session('echec') }}
        </div>
        @endif
        <a href="groupe/create" class="btn btn-primary">Créer un groupe</a>
        @if(!empty($groupes))
        <table class="table table-hover" data-toggle="table"
        data-search="true">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libelle</th>
                    <th>Voir individus</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
        </thead>
            <tbody>
                @foreach($groupes as $groupe)
                <tr>
                    <td>{{ $groupe->id_groupe }}</td>
                    <td>{{ $groupe->libelle }}</td>
                    <td><a href="/appartenir/{{$groupe->id_groupe}}" class="btn btn-info">Voir individus</a></td>
                    <td><a href="/groupe/modify/{{$groupe->id_groupe}}" class="btn btn-warning">Modifier</a></td>
                    <td><a href="/groupe/delete/{{$groupe->id_groupe}}" class="btn btn-danger">Supprimer</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center">
            <span>Aucun groupe n'a pu être trouvé.</span>
        </div>
        @endif
    </div>
</section>

@endsection