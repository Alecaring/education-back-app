<?php

namespace App\Http\Controllers;

use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizAnswerController extends Controller
{
    public function index()
    {
        $answers = QuizAnswer::with('question')->get();
        return view('quiz_answers.index', compact('answers'));
    }

    public function create()
    {
        $questions = QuizQuestion::all();
        return view('quiz_answers.create', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|exists:quiz_questions,id',
            'answer' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
        ]);

        QuizAnswer::create($request->all());

        return redirect()->route('quiz_answers.index')->with('success', 'Answer created successfully.');
    }

    public function show(QuizAnswer $quizAnswer)
    {
        return view('quiz_answers.show', compact('quizAnswer'));
    }

    public function edit(QuizAnswer $quizAnswer)
    {
        $questions = QuizQuestion::all();
        return view('quiz_answers.edit', compact('quizAnswer', 'questions'));
    }

    public function update(Request $request, QuizAnswer $quizAnswer)
    {
        $request->validate([
            'question_id' => 'required|exists:quiz_questions,id',
            'answer' => 'required|string|max:255',
            'is_correct' => 'required|boolean',
        ]);

        $quizAnswer->update($request->all());

        return redirect()->route('quiz_answers.index')->with('success', 'Answer updated successfully.');
    }

    public function destroy(QuizAnswer $quizAnswer)
    {
        $quizAnswer->delete();

        return redirect()->route('quiz_answers.index')->with('success', 'Answer deleted successfully.');
    }
}
