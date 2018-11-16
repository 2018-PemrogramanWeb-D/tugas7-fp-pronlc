@extends('layouts.app')
@section('title',"$forums->title")
@section('content')
<div class="container">
  <div class="jumbotron" id="tc_jumbotron">
    <div class="card-body" id="xx">
        <div class="tc_head_title"> 
           <h2 style="color: #fff;">{{$forums->title}}</h2>  
        </div>
    </div>
  </div>
</div>  
<div class="container">
    <div class="row">
        <div class="col-md-12" id="tc_container_wrap">
            <div class="card" id="tc_paneldefault" style="background: #f9f9f9;"> 
                <div class="card-body" id="tc_panelbody">
                    <div class="row">
                        <div class="col-md-8">
                          <div class="card">
                             <div class="card-body" style="background: #f9f9f9;"> 
                      <div class="forum_info">
                     <div class="share pull-right">
                      <a href="#">  <i class="fa fa-facebook"></i></a>
                      <a href="#">  <i class="fa fa-twitter"></i></a>
                      <a href="#">  <i class="fa fa-google-plus"></i></a>
                      </div>
                    <a href="#" class="badge" style="background: #ff934a; color: #fff">telukcoding</a> |
                    <small>{{$forums->created_at->diffForHumans()}}</small> |
                    <small>0 Views</small> |
                    <small>0 Comments</small> |
                    @foreach($forums->tags as $tag)
                    <div class="badge" style="background: #ff934a; color: #fff">#{{$tag->name}}</div>
                    @endforeach
                    @if (empty($forums->image))
                            @else
                          <div class="badge" style="background: #ff934a; color: #fff"><i class="fa fa-image"></i></div>
                           @endif
                    <h3>{{$forums->title}}</h3> 
                  </div>
                  <hr style="margin-top: 0; margin-bottom: 5px;">
                  <div class="forum_description">
                  @if (!empty($forums->image))
                        <br>
                    <div class="tc_if_empty">
                   <a data-toggle="collapse" data-target="#open_modal"><i class="fa fa-image" id="zoom_image"></i></a>
                <div id="open_modal" class="collapse"> 
                  <div class="bg">
                    <img src="{{asset('images/'.$forums->image)}}" alt="">
                    <div class="overlay">
                     <a href="#myModal" data-toggle="modal" data-target="#myModal"><h2>Zoom</h2> </a> 
                    </div>
                  </div>
                    </div>
                    </div>  
                       @endif
                    <p>{!!$forums->description!!}</p>
                  </div>
                </div>
              </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Screenshot:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="modal_img">
                 <img src="{{asset('images/'.$forums->image)}}" alt="">
                  </div> 
                </div>
              </div>
            </div>

            <br>
            <hr>
            <div class="panel panel-default" style="background-color: #f9f9f9;">
              <div class="panel-body">
            <div class="add_comment">
              <div class="open_comment">
                  <div class="h1"><h4>Add a Comment</h4></div>
              </div>
              <div class="comment-show">
                <form action="#" method="post">
                  {{csrf_field()}}
                <div class="form-group">
                  <input type="text" name="content" id="Your-Answer" placeholder="Your Comment:" required="required">
                  <label for="Your-Comment">Your Comment:</label>    
                </div>
                <div class="button-gg"> 
                  <button class="btn btn-success" type="submit">Submit</button>
                </div>
              </form>
              </div>
            </div>
              </div>
            </div>
            </div>
               <div class="col-md-4">
                  <a href="{{route('forum.create')}}" class="btn btn-success btn-block">Buat Pertanyaan</a><br>
               <div class="card">
                <div class="card-header" style="background: #ff934a; color: #fff; padding: 8px 1.25rem;">Popular</div>
                <div class="list-group">
                 <a href="#" class="list-group-item" id="index_hover">What is Lorem Ipsum?
                 <a href="#" class="list-group-item" id="index_hover">Where does it come from?
                </a> 
                </div>
                </div>
            </div>
             </div>
            <hr style="margin-top: 0;">
              </div>
            </div>
           </div>
          </div>
      </div><br>
@endsection

@section('js')
<script type="text/javascript">
var openComment = document.querySelector('.h1');
var addComment = document.querySelector('.add_comment');
openComment.addEventListener('click', function(){
addComment.classList.toggle('open'); 
}); 
</script>
@endsection