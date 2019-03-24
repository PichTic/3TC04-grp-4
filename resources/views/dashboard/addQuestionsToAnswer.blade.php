@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard - Associer des questions</div>
                <div class="card-body">
                    <fieldset>
                        <legend>La réponse :  {{ $answer->body }}</legend>
                        <p>liste des questions associées :</p>
                        <ul>
                            @foreach($answer->questions as $response)
                            <li>{{ $response->body }}</li>
                            @endforeach
                        </ul>
                        <form method="POST" action="{{route('questions.add', $answer->id)}}">
                        @csrf
                            <div class="form-group">
                                <label for="question" class="col-form-label-lg">Ajouter une question</label>
                                <input type="text" class="form-control form-control-lg" id="question" name="question" aria-describedby="questionlHelp" placeholder="Entrez votre question">
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary">Ajouter la question</button>
                            <a href="{{route('home')}}" class="btn btn-lg float-right">Retour au Dashboard</a>
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
