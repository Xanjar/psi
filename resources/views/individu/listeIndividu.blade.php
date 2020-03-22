@extends('layout')
@section('contenu')

<section class="section">
    <div class="container">
        <h2>Liste des individus</h2>
        @if(session('succes'))
        <div id="notifMsg" class="alert alert-success">
            {{ session('succes') }}
        </div>
        @elseif(session('echec'))
        <div id="notifMsg" class="alert alert-danger">
            {{ session('echec') }}
        </div>
        @endif

        <form action="/individu" method="post" enctype='multipart/form-data'>
      
            {{ csrf_field() }}
            <div class="form-group">
                <label for="fichier">Inserer des individus de puis un csv ou un excel</label>
                <input name="fichier" type="file" class="form-control" id="fichier" placeholder="Ajouter un fichier" required>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>

        <a href="individu/create" class="btn btn-primary">Créer un individu</a>
        @if(!empty($individus))
        <table class="table table-striped" data-toggle="table"
        data-search="true">
            <thead>
                <tr>
                    <th data-sortable="true">Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
        </thead>
            <tbody>
                @foreach($individus as $individu)
                <tr>
                    <td>{{ $individu->nom }}</td>
                    <td>{{ $individu->prenom }}</td>
                    <td>{{ $individu->email }}</td>
                    <td><a href="/individu/modify/{{$individu->id_individu}}" class="btn btn-warning">Modifier</a></td>
                    <td><a href="/individu/delete/{{$individu->id_individu}}" class="btn btn-danger">Supprimer</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="text-center">
            <span>Aucun individu n'a pu être trouvé.</span>
        </div>
        @endif
    </div>
</section>

@endsection