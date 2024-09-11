<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function index()
    {
        $questions = QuizQuestion::with('quiz')->get();
        return view('quiz_questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quiz::all();
        return view('quiz_questions.create', compact('quizzes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string|max:255',
        ]);

        QuizQuestion::create($request->all());

        return redirect()->route('quiz_questions.index')->with('success', 'Question created successfully.');
    }

    public function show(QuizQuestion $quizQuestion)
    {
        return view('quiz_questions.show', compact('quizQuestion'));
    }

    public function edit(QuizQuestion $quizQuestion)
    {
        $quizzes = Quiz::all();
        return view('quiz_questions.edit', compact('quizQuestion', 'quizzes'));
    }

    public function update(Request $request, QuizQuestion $quizQuestion)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string|max:255',
        ]);

        $quizQuestion->update($request->all());

        return redirect()->route('quiz_questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy(QuizQuestion $quizQuestion)
    {
        $quizQuestion->delete();

        return redirect()->route('quiz_questions.index')->with('success', 'Question deleted successfully.');
    }
}
