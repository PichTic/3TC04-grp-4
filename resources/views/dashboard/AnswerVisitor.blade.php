@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard - Répondre</div>
                <div class="card-body">
                    <fieldset>
                        <legend>Répondre à {{ $question->visitor->email }}</legend>
                        <form method="POST" action="{{route('answer.store', $question->id)}}">
                            @csrf
                            <label for="question" class="col-form-label-lg">Question:</label> <input type="text" class="form-control form-control-lg" id="question" name="question" aria-describedby="question-" placeholder="Entrez votre réponse" value="{{ $question->body }}">
                            <br/><br/>
                            <div class="form-group">
                                <legend>Entrez la réponse ou ajouter une réponse déjà existante</legend>
                                <label for="reponse" class="col-form-label-lg">Réponse manuelle:</label>
                                <input type="text" class="form-control form-control-lg" id="reponse" name="reponse" aria-describedby="reponselHelp" placeholder="Entrez votre réponse">

                                <label for="reponse" class="col-form-label-lg">Réponse(s) existant(s):</label>
                                @forelse($answers as $answer)
                                    <div class="form-check">
                                        <input type="radio" id="$answer->id" name="answer" value="$answer->id">
                                        <label for="$answer->id">{{ $answer->body }}</label>
                                    </div>
                                @empty
                                <tr><td colspan="3">Aucune réponse en bdd</td></tr>
                                @endforelse
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary">Envoyer et ajouter la réponse</button>
                            <a href="{{route('home')}}" class="btn btn-lg btn-outline-secondary float-right">Retour au Dashboard</a>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageJS')

@endsection
