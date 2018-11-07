@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Pertanyaan</div>

                <div class="card-body">
                    <form action="{{ route('forum.update', $forum->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{ $forum->title }}">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description"  rows="10">{{$forum->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <img src="{{ asset('images/'.$forum->image)}}" width="100%">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
