@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">View Question</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Question</label>
                          <div class="col-sm-10">
                            <label class="control-label">{{ $question->question }}</label>    
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tags</label>
                          <div class="col-sm-10">
                            @if(count($question->tags) > 0)
                              @if(count($question->tags) == 1)
                                <button type="button" class="btn btn-primary btn-sm">{{ $question->tags }}</button>
                              @else
                              @foreach($question->tags as $tag)
                                <button type="button" class="btn btn-primary btn-sm">{{ $tag }}</button>
                              @endforeach
                              @endif
                            @endif
                            
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Answers</label>
                          <div class="col-sm-10">
                            @if(count($question->answers) > 0)
                              @if(count($question->answers) == 1)
                                <a target="_blank" href="{{ $question->answers }}" class="btn btn-primary btn-sm">{{ $question->answers }}</a>
                              @else
                              @foreach($question->answers as $answer)
                                <a target="_blank" href="{{ $answer }}" class="btn btn-primary btn-sm">{{ $answer }}</a>
                              @endforeach
                              @endif
                            @endif
                          </div>
                      </div>
                      
                      
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



