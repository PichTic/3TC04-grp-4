<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswer;
use App\Http\Requests\StoreQuestionAndAnswer;

class QuestionsController extends Controller
{
    public function questionStore(StoreQuestionAndAnswer $request)
    {
        $question = new Question;
        $question->body = $request->question;
        $question->save();

        $answer = $question->answer()->create([
            'body' => $request->reponse,
        ]);

        return redirect()->back();
    }

    public function answer($id)
    {
        $question = Question::find($id);

        return view('dashboard.AnswerVisitor', compact('question'));
    }

    public function answerStore($id, StoreAnswer $request)
    {
        $question = Question::findOrFail($id);

        $answer = $question->answer()->create([
            'body' => $request->reponse,
        ]);
        return redirect()->route('home');
    }

}
