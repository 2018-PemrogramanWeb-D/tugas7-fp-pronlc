@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Create a Question</h1></div>
                <div class="panel-body">
                    <form action="{{ route('questions.store') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea name="body" class="form-control" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Tanyakan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection