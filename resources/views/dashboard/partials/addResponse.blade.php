<div class="mt-4">
    <h3>Ajouter une question à une réponse existante</h3>
    <table id="myTable" class="col-12 table table-hover table-striped">
        <thead>
            <tr>
                <th>Réponse</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($answers as $answer)
            <tr>
                <td>{{ $answer->body }}</td>
                <td>
                    <a href="{{ route('answer', $answer->id) }}" class="btn btn-primary text-white"><i class="fas fa-pen"></i></a>
                </td>
            </tr>
        @empty
        <tr><td colspan="3">Aucune réponse en bdd</td></tr>
        @endforelse
        </tbody>
    </table>
</div>