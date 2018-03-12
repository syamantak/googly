@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

                    <form action="{{ url('search') }}" method="post">
                        @csrf
                          <label class="sr-only" for="inlineFormInputGroupUsername">Search</label>
                          <div class="input-group">                            
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" name="search" placeholder="Question..." value="{{ old('search') }}" required>
                            <div class="input-group-prepend">
                              <button type="submit" class="btn-sm btn-primary">Search</button>
                            </div>
                          </div>
                        
                    </form>
            
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Questions  
                    
                    <div class="float-lg-right">
                        @if(Auth::check())
                        <a href="{{ url('/question') }}" class="btn btn-primary btn-sm">Post Question</a>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    
                    

                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Question</th>
                          <th scope="col">Tags</th>
                          <th scope="col">Answer</th>
                          @if(Auth::check())
                          <th scope="col">Edit</th>
                          @endif
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($questions as $question)
                            <tr>
                              <td>{{ $question->question }}</td>
                              <td>
                                 <button type="button" class="btn btn-primary btn-sm">{{ $question->tags }}</button>
                              </td>
                              <td><a href="{{ $question->answerlink }}">Answer</a></td>
                              @if(Auth::id() == $question->user)
                                <td><a href="{{ url('/edit/question/' . $question->id) }}">Edit</a></td>
                              @endif
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
