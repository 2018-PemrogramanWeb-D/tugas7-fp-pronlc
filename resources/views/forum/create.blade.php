@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tulis Pertanyaan</div>

                <div class="card-body">
                    <form action="{{ route('forum.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" placeholder="title...">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" placeholder="description..." rows="10">
                                
                            </textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="image">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
