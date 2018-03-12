<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\QuestionTag;
use App\Http\Requests\StoreQuestion;
use App\Http\Requests\UpdateQuestion;
use Auth;


class QuestionController extends Controller
{
    public function index(Request $request)
    {
    	if(Auth::check())
		{
			$questions = Question::where('user', Auth::id())->paginate(10);	
		}
		else
		{
			$questions = Question::paginate(10);
		}

    	return view('questions.list',['questions' => $questions]);
    }

    public function search(Request $request)
    {
    	if(Auth::check())
		{
			$questions = Question::where('user', Auth::id())->where('question', 'like', '%' . $request->search . '%')->paginate(10);	
		}
		else
		{
			$questions = Question::where('question', 'like', '%' . $request->search . '%')->paginate(10);
		}

    	$request->flash();

    	return view('questions.list',['questions' => $questions]);
    }

    public function create(Request $request)
    {
    	return view('questions.create');
    }

    public function post(StoreQuestion $request)
    {
    	$question = Question::create([
			    		'question' => $request->question,
			 			'user' => Auth::id(),
                        'answerlink' => $request->answerlink,
                        'tags' => $request->tags
			    	]);
    	$request->flash();
    	session()->flash('status', 'Question is posted');
    	return redirect('home');
    }

    public function edit(Request $request, $id)
    {
    	$question = Question::find($id);
    
		$request->flash();
    	
    	return view('questions.edit',['question' => $question]);
    }

    public function update(UpdateQuestion $request)
    {
    	$question = Question::find($request->id);

    	$question->answerlink = $request->answerlink;
        $question->tags = $request->tags;
    	$request->flash();

    	session()->flash('status', 'Question is updated');
    	return redirect('home');
    }

    public function view(Request $request, $id)
    {
    	$question = Question::find($id);
    	
    	return view('questions.view',['question' => $question]);
    }

    public function delete(Request $request, $id)
    {
		Question::where('id', $question->id)->delete();
		$request->flash();
    	
    	session()->flash('status', 'Question is deleted');
    	return redirect('home');
    }
}
