<fieldset>
    <legend>Associer une question à une réponse</legend>
    <form method="POST" action="{{ route('questions.store') }}">
        @csrf
        <div class="form-group">
            <label for="question" class="col-form-label-lg">La question</label>
            <input type="text" class="form-control form-control-lg" id="question" name="question" aria-describedby="questionlHelp" placeholder="Entrez votre question">
        </div>
        <div class="form-group">
            <label for="reponse" class="col-form-label-lg">La réponse</label>
            <input type="text" class="form-control form-control-lg" id="reponse" name="reponse" aria-describedby="reponselHelp" placeholder="Entrez votre réponse">
        </div>
        <button type="submit" class="btn btn-lg btn-primary">Ajouter</button>
    </form>
</fieldset>