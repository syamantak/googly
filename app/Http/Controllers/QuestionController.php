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
    	

    	foreach($questions as $question)
    	{
    		$question->tags = QuestionTag::where('question', $question->id)->value('tag');	
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

    	foreach($questions as $question)
    	{
    		$question->tags = QuestionTag::where('question', $question->id)->value('tag');	
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
			 			'user' => Auth::id()
			    	]);

    	foreach ($request->answerlink as $answer) {
    		if($answer != null)
    		Answer::create([
	    		'question' => $question->id,
	    		'answerlink' => $answer,
	    		'user' => Auth::id(),
	    		'note' => $request->has('note') ? $request->note : null
	    	]);
    	}
    	
    	foreach (explode(',', $request->tags) as $tag) {
    		$question_tag = QuestionTag::where('tag', $tag)->first(); 
    		if(empty($question_tag))
    		{
    			if($tag != null)
    			QuestionTag::create([
		    		'question' => $question->id,
		    		'tag' => $tag
		    	]);	
    		}
    			
    	}
    	$request->flash();
    	session()->flash('status', 'Question is posted');
    	return redirect('home');
    }

    public function edit(Request $request, $id)
    {
    	$question = Question::find($id);
    	
		$question->tags = QuestionTag::where('question', $question->id)->value('tag');

		$question->answers = Answer::where('question', $question->id)->value('answerlink');
		$request->flash();
    	
    	return view('questions.edit',['question' => $question]);
    }

    public function update(UpdateQuestion $request)
    {
    	$question = Question::find($request->id);

    	Answer::where('question', $question->id)->delete();

    	foreach ($request->answerlink as $answer) {
    		Answer::create([
	    		'question' => $question->id,
	    		'answerlink' => $answer,
	    		'user' => Auth::id(),
	    		'note' => $request->has('note') ? $request->note : null
	    	]);
    	}
    	
    	QuestionTag::where('question', $question->id)->delete();

    	foreach (explode(',', $request->tags) as $tag) {
    		$question_tag = QuestionTag::where('tag', $tag)->first(); 
    		if(empty($question_tag))
    		{
    			QuestionTag::create([
		    		'question' => $question->id,
		    		'tag' => $tag
		    	]);	
    		}
    			
    	}
    	$request->flash();

    	session()->flash('status', 'Question is updated');
    	return redirect('home');
    }

    public function view(Request $request, $id)
    {
    	$question = Question::find($id);
    	
		$question->tags = QuestionTag::where('question', $question->id)->value('tag');

		$question->answers = Answer::where('question', $question->id)->value('answerlink');
    	
    	return view('questions.view',['question' => $question]);
    }

    public function delete(Request $request, $id)
    {
    	$question = Question::find($id);
    	
		QuestionTag::where('question', $question->id)->delete();

		Answer::where('question', $question->id)->delete();

		Question::where('id', $question->id)->delete();
		$request->flash();
    	
    	session()->flash('status', 'Question is deleted');
    	return redirect('home');
    }
}
