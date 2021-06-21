<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $examList       = Exam::query();
        $categories     = Category::query();

        if ($request->category) {
            $examList        = $examList->where('category_id', $request->category);
        }
        if ($request->sub_category) {
            $examList        = $examList->where('sub_category_id', $request->sub_category);
        }

        return view('pages.exam.index')->with([
            'exam_list'     => $examList->get(),
            'categories'    => $categories->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'      => ['required', 'string', 'unique:exams'],
            'category'  => ['required'],
            'sub_category'  => ['required'],
        ]);

        $exam = Exam::create([
            'name'              => $request->name,
            'category_id'       => $request->category,
            'sub_category_id'   => $request->sub_category,
        ]);
        session()->flash('action', ['type' => 'success', 'message' => 'Examination created']);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('pages.exam.edit')->with([
            'exam'              => $exam,
            'categories'        => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'name'      => ['required', 'string', 'unique:exams,name,' . $exam->id],
            'category'  => ['required'],
            'sub_category'  => ['required'],
        ]);

        $exam->update([
            'name'              => $request->name,
            'category_id'       => $request->category,
            'sub_category_id'   => $request->sub_category,
        ]);
        session()->flash('action', ['type' => 'success', 'message' => 'Examination Updated']);

        return redirect()->route('exam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        if ($exam->delete()) {
            session()->flash('action', ['type' => 'success', 'message' => 'Examination Deleted']);
            return back();
        }

        session()->flash('action', ['type' => 'warning', 'message' => 'Examination does not updated.']);

        return back();
    }
}
