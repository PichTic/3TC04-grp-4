<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswer;
use App\Http\Requests\EditQuestion;
use App\Notifications\QuestionAnswered;
use App\Http\Requests\AssociateQuestion;
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
        $answers = Answer::with('questions')->get();
        return view('dashboard.AnswerVisitor', compact('question', 'answers'));
    }

    public function edit($id, EditQuestion $request)
    {
        $question = Question::findOrFail($id)->update(['body' => $request->question]);

        return redirect()->back();
    }

    public function associate($id, AssociateQuestion $request)
    {
        //associate an existing answer to an existing question
        $question = Question::findOrFail($id);
        $answer = Answer::find($request->reponseExistante);
        $question->answer()->associate($answer);
        $question->save();

        Notification::route('mail', $question->visitor->email)->notify(new QuestionAnswered($answer->body, $question->body));

        return redirect()->route('home');
    }

    public function answerStore($id, StoreAnswer $request)
    {

        // create a answer and associate it to the given question
        $question = Question::findOrFail($id);

        $answer = new Answer;
        $answer->body = $request->reponse;
        $answer->save();

        $question->answer()->associate($answer);
        $question->save();

        Notification::route('mail', $question->visitor->email)->notify(new QuestionAnswered($answer->body, $question->body));

        return redirect()->route('home');
    }


    public function answerDelete($id)
    {
        $question = Question::findOrFail($id)->delete();
        return redirect()->route('home');
    }

}
