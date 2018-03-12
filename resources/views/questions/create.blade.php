@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Post Question</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ url('question/post') }}">
                        {{ csrf_field() }}
                      <div class="form-group">
                        <label for="question" class="col-sm-2 control-label">Question</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="question" value="{{ old('question') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="tags" class="col-sm-2 control-label">Tags</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="tags" value="{{ old('tags') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>

                     

                      <div class="form-group">
                        <label for="answerlink" class="col-sm-2 control-label">Answer Link</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="answerlink[]"  required>

                                @if ($errors->has('answerlink'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answerlink') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Post Question</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



