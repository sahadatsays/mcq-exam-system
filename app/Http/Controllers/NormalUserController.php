<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class NormalUserController extends Controller
{
    public function questions(Request $request)
    {
        $questions = Question::query();

        if (request('category')) {
            $questions->where('category_id', request('category'));
        }
        if (request('sub_category')) {
            $questions->where('sub_category_id', request('sub_category'));
        }

        return view('user-pages.questions')->with([
            'questions' => $questions->get(),
            'categories' => Category::all()
        ]);
    }

    public function question(Question $question)
    {
        return view('user-pages.question')->with([
            'question'      => $question
        ]);
    }

    public function giveAnswer(Request $request, Question $question)
    {
        if (!$request->has('answer')) {
            session()->flash('action', ['type' => 'danger', 'message' => 'Please give a answer !']);
            return back();
        }

        $answer = [
            'user_id' => auth()->id(),
            'answer' => $request->answer,
            'question_id' => $question->id
        ];
        if ($request->answer == $question->right_option) {
            $answer['yes'] = 1;
            session()->flash('action', ['type' => 'success', 'message' => 'Your answer is currect']);
        } else {
            $answer['yes'] = 0;
            session()->flash('action', ['type' => 'warning', 'message' => 'Your answr is wrong !']);
        }

        UserAnswer::create($answer);

        return redirect()->route('my_answers');
    }

    public function my_answers()
    {
        $answers = UserAnswer::query();

        return view('user-pages.my_answer')->with([
            'my_answers' => $answers->where('user_id', auth()->id())->get()
        ]);
    }
}
