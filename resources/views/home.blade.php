@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Most Recents Questions</h1></div>
				<div class="panel-body">
				@foreach($questions as $question)
			  		<div class="card">
					  <div class="card-body">
					    <h3 class="card-title">{{ $question->title }}</h3>
					    <p class="card-text">{{ $question->body }}</p>
					    <a href="#" class="btn btn-primary">Read More</a>
					  </div>
					</div>
			  		<br>
			  	@endforeach
			  	</div>
			</div>
        </div>
        <div class="col-md-3">
            Most Viewev Questions
        </div>
    </div>
</div>
@endsection
