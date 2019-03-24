<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AddQuestion;

class AnswersController extends Controller
{
    public function questions($id) {
        $answer = Answer::with('questions')->find($id);

        return view('dashboard.addQuestionsToAnswer', compact('answer' ));
    }

    public function questionsAdd($id, AddQuestion $request) {
        $question = new Question(['body' => $request->question]);

        $answer = Answer::find($id);

        $answer->questions()->save($question);

        return redirect()->back();
    }
}
