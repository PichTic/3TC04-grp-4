<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::doesntHave('answer')->get();
        $answers = Answer::all();

        return view('home', compact('questions', 'answers'));
    }

}
