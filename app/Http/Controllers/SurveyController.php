<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    protected $user_id;

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return view('welcome');
    }

    public function __construct()
    {
        if(Auth::check()) {
            $this->user_id = auth()->user()->id;
        }
    }

    public function survey(Request $request)
    {
        $surveys = Question::paginate(5);

        return response($surveys);
    }
    public function addResult(Request $request)
    {
        if(Auth::check()) {
            $this->user_id = auth()->user()->id;
        }

        DB::table('results')
            ->where('user_id', $this->user_id)
            ->where('question_id', $request->question)
            ->delete();
        DB::table('results')->insert([
            'user_id' => $this->user_id,
            'question_id' => $request->question,
            'result' => $request->answer,
        ]);
        $results = DB::table('results')->select('question_id', 'result')->where('user_id', $this->user_id)->get();
        $results = $results->pluck('result', 'question_id')->toArray();
        return response($results);
    }

    public function results()
    {
        if(Auth::check()) {
            $this->user_id = auth()->user()->id;
        }

        $results = DB::table('results')->select('question_id', 'result')->where('user_id', $this->user_id)->get();
        $results = $results->pluck('result', 'question_id')->toArray();
        return $results;
    }

    public function statistic() {
        $results = DB::table('results')->select('question_id', 'result', 'questions.title')
            ->join('questions' , 'questions.id', '=', 'results.question_id')->where('user_id', $this->user_id)->get();

        $statistic['questions'] = $results->pluck('title');
        $statistic['results'] = $results->pluck('result');

        return $statistic;
    }

    public function users() {
        $users = DB::table('results')
            ->select('user_id', 'users.name', 'users.email')
            ->join('users', 'users.id', '=', 'results.user_id')
            ->groupBy('user_id')
            ->having(DB::raw('count(*)'), '<', 10)
            ->get();

        return $users;
    }
}
