@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 pb-4">
            <div class="card">
                <div class="card-header">Dashboard - Répondre</div>
                <div class="card-body">
                    <fieldset>
                        <legend>Répondre à {{ $question->visitor->email }}</legend>
                        <form method="post" action="{{ route('question.edit', $question->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="question" class="col-form-label-lg">Question:</label>
                                <textarea type="text" class="form-control form-control-lg" id="question" name="question">{{ $question->body }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Mettre à jour la question</button>
                                <a href="{{route('home')}}" class="btn btn-lg btn-outline-secondary float-right">Retour au Dashboard</a>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- Add a new answer -->
        <div class="col-md-12 pb-4">
            <div class="card">
                <div class="card-header">Rédiger une nouvelle réponse</div>
                <div class="card-body">
                    <form action="{{ route('answer.store', $question->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="reponse" class="col-form-label-lg">La nouvelle réponse :</label>
                            <textarea class="form-control form-control-lg" id="reponse" name="reponse" aria-describedby="reponselHelp" placeholder="Saisissez votre réponse" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Envoyer et ajouter la réponse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Associate to an existing answer -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Associer à une réponse existante</div>
                <div class="card-body">
                    <form action="{{ route('question.associate', $question->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
                        @forelse($answers as $answer)
                            <div class="form-check">
                                <input type="radio" id="reponseExistante_{{$answer->id}}" name="reponseExistante" value="{{ $answer->id }}">
                                <label for="reponseExistante_{{$answer->id}}">{{ $answer->body }}</label>
                            </div>
                        @empty
                        <p>Aucune réponse en bdd</p>
                        @endforelse
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary">Envoyer et associer la réponse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pageJS')

@endsection
