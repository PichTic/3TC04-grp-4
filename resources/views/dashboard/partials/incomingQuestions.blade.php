<div class="mt-4">
    <h3>Questions en attente</h3>
    <table id="myTable" class="col-12 table table-hover table-striped">
        <thead>
            <tr>
                <th>Email</th>
                <th>Question</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($questions as $question)
            <tr>
                <td>{{ $question->visitor->email }}</td>
                <td>{{ $question->body }}</td>
                <td>
                    <a href="{{ route('question.answer', $question->id) }}" class="btn btn-primary text-white"><i class="fas fa-pen"></i></a>
                    <form class="d-inline" method="POST" action="{{ route('answer.delete', $question->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                    </form>
                </td>
            </tr>
        @empty
        <tr><td colspan="3">Aucune question en attente</td></tr>
        @endforelse
        </tbody>
    </table>
</div>