<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Module;
use App\Models\Point;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('module')->get();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('quizzes.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
        ]);

        Quiz::create($request->all());

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully.');
    }

    public function show(Quiz $quiz)
    {
        return view('quizzes.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $modules = Module::all();
        return view('quizzes.edit', compact('quiz', 'modules'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
        ]);

        $quiz->update($request->all());

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function completeQuiz(Request $request, $quizId)
    {
        $userId = $request->input('user_id');
        $answers = $request->input('answers'); // Array di risposte

        $quiz = Quiz::with('questions.answers')->find($quizId);

        if ($quiz) {
            $totalPoints = 0;

            foreach ($answers as $answer) {
                $questionId = $answer['question_id'];
                $selectedAnswerId = $answer['answer_id'];

                $question = $quiz->questions()->find($questionId);
                $correctAnswers = $question->answers()->where('is_correct', true)->pluck('id')->toArray();

                if (in_array($selectedAnswerId, $correctAnswers)) {
                    $totalPoints += $quiz->points;
                }

                // Salva la risposta del quiz
                QuizAnswer::updateOrCreate(
                    ['quiz_id' => $quizId, 'user_id' => $userId, 'question_id' => $questionId],
                    ['answer_id' => $selectedAnswerId, 'is_correct' => in_array($selectedAnswerId, $correctAnswers)]
                );
            }

            // Assegna i punti all'utente
            $this->addPoints($userId, $totalPoints);

            return response()->json(['message' => 'Quiz completato', 'points_awarded' => $totalPoints]);
        } else {
            return response()->json(['message' => 'Quiz non trovato'], 404);
        }
    }

    // Aggiungi punti all'utente
    private function addPoints($userId, $points)
    {
        $pointRecord = Point::firstOrCreate(['user_id' => $userId]);
        $pointRecord->points_gained += $points;
        $pointRecord->save();
    }
}
