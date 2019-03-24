<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswer;
use App\Notifications\QuestionAnswered;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\StoreQuestionAndAnswer;

class QuestionsController extends Controller
{
    public function questionStore(StoreQuestionAndAnswer $request)
    {

        $answer = new Answer;
        $answer->body = $request->reponse;
        $answer->save();

        $question = $answer->questions()->create([
            'body' => $request->question,
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
        $answer = new Answer;
        $answer->body = $request->reponse;
        $answer->save();

        $question = Question::findOrFail($id);
        $question->answer()->associate($answer);
        $question->save();

        Notification::route('mail', $question->visitor->email)->notify(new QuestionAnswered($request->reponse));

        return redirect()->route('home');
    }

    public function answerDelete($id)
    {
        $question = Question::findOrFail($id)->delete();
        return redirect()->route('home');
    }

}
