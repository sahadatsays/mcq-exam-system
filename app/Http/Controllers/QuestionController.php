<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions  = Question::query();

        if (request('category')) {
            $questions->where('category_id', request('category'));
        }
        if (request('sub_category')) {
            $questions->where('sub_category_id', request('sub_category'));
        }

        return view('pages.question.index')->with([
            'question_list'             => $questions->get(),
            'categories'                => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::query();


        return view('pages.question.create')->with([
            'categories' => $categories->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required',
            'sub_category_id'   => 'required',
            'question'          => 'required|string|max:191',
            'a'                 => 'required|string|max:191',
            'b'                 => 'required|string|max:191',
            'c'                 => 'required|string|max:191',
            'd'                 => 'required|string|max:191',
            'right_option'      => 'required',
            'time'              => 'required|numeric',
        ]);

        $question = Question::create([
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'question'          => $request->question,
            'a'                 => $request->a,
            'b'                 => $request->b,
            'c'                 => $request->c,
            'd'                 => $request->d,
            'right_option'      => $request->right_option,
            'q_time'            => $request->time,
        ]);

        session()->flash('action', ['type' => 'success', 'message' => 'Question Created']);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('pages.question.edit')->with([
            'question'                  => $question,
            'categories'                => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'category_id'       => 'required',
            'sub_category_id'   => 'required',
            'question'          => 'required|string|max:191',
            'a'                 => 'required|string|max:191',
            'b'                 => 'required|string|max:191',
            'c'                 => 'required|string|max:191',
            'd'                 => 'required|string|max:191',
            'right_option'      => 'required',
            'time'              => 'required|numeric',
        ]);

        $question->update([
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'question'          => $request->question,
            'a'                 => $request->a,
            'b'                 => $request->b,
            'c'                 => $request->c,
            'd'                 => $request->d,
            'right_option'      => $request->right_option,
            'q_time'            => $request->time,
        ]);

        session()->flash('action', ['type' => 'success', 'message' => 'Question Updated']);

        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if ($question->delete()) {
            session()->flash('action', ['type' => 'success', 'message' => 'Question Deleted']);
            return back();
        }

        session()->flash('action', ['type' => 'warning', 'message' => 'Question not delete.']);
        return back();
    }
}
