<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionAndAnswer;

class QuestionsController extends Controller
{
    public function store(StoreQuestionAndAnswer $request)
    {
        $question = new Question;
        $question->body = $request->question;
        $question->save();

        $answer = $question->answer()->create([
            'body' => $request->reponse,
        ]);

        return redirect()->back();
    }
}
