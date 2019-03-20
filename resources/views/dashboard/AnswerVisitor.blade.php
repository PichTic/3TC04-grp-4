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
                            <p>{{ $question->body }}
                            <div class="form-group">
                                <label for="reponse" class="col-form-label-lg">La réponse</label>
                                <input type="text" class="form-control form-control-lg" id="reponse" name="reponse" aria-describedby="reponselHelp" placeholder="Entrez votre réponse">
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary">Envoyer et ajouter la réponse</button>
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
