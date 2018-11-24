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
                    <small>{{ $forums->comments->count() }} Comments</small> |
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
            @forelse($forums->comments as $comment)
            <div class="card">
              <div class="card-header" style=" background-color: #2ab27b; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">{{$comment->created_at->diffForHumans()}}</small></div>
              <div class="card-body" style="background: #f9f9f9; "> 
                <div class="row">
                  <div class="col-md-3" id="img_comment">
                    <img src="{{asset('images/profile.jpg')}}" width="100%">
                    <br>
                    <div class="comment_user">
                    <b>{{$comment->user->name}}</b>
                    </div>
                  </div>
                  <div class="col-md-8">
                    {{$comment->content}}
                  </div>
                </div>
              </div>

              {{-- tambahan --}}
              <div class="card-body">
                  <!-- forelse reply-->
                  @forelse($comment->comments as $reply)
                  <div class="card">
                    <div class="card-header" style="background-color: #2ab27b; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">{{$reply->created_at->diffForHumans()}}</small></div>
                    <div class="card-body" style="background: #f9f9f9;"> 
                      <div class="row"> 
                        <div class="col-md-3" id="img_comment_reply">
                          <img src="{{asset('images/profile.jpg')}}" width="100%">
                          <br>
                          <div class="comment_user">
                          <b>{{$reply->user->name}}</b>
                          </div>
                        </div>
                        <div class="col-md-8">
                          {{$reply->content}}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                @empty
              <p>No reply</p>
              @endforelse
              <!-- endforelse reply-->

                <div class="panel-body" style="    border-top: 1px solid #eee;">
                  <form action="{{ route('replyComment', $comment->id) }}" method="post" style="    padding: 0 16px;">
                    {{csrf_field()}}
                    <div class="form-group">
                      <input type="text" name="content" class="form-control" id="input_reply" placeholder="Reply here..">        
                    </div>
                    <button class="btn btn-success" type="submit">Submit</button>
                    <br><br>
                  </form>
                </div>

                {{-- end tambahan --}}

              <div class="card-footer link_a">
                <div class="info_comment">
                 <a data-toggle="collapse" href="#{{$comment->id}}-collapse1info"><i class="fa fa-info-circle"></i> Info</a>
                </div>
               <div class="reply_comment">
               <a data-toggle="collapse" href="#{{$comment->id}}-collapse1reply"><i class="fa fa-comment-o"></i> Reply</a>
               </div>
              </div>

              <div id="{{$comment->id}}-collapse1info" class="card-collapse collapse">
                <div class="card-body">*Klik 'Reply' untuk melihat atau membuat komentar balasan.</div> 
              </div>

              <div id="{{$comment->id}}-collapse1reply" class="card-collapse collapse">
                <div class="card-body">
                  <!-- forelse reply-->
                  <div class="card">
                    <div class="card-header" style="background-color: #2ab27b; color: #fff; border-top-right-radius: 0px; border-top-left-radius: 0px;"><i class="fa fa-clock-o" style="color: #eee"></i> <small style="color: #eee">2 min ago </small></div>
                    <div class="card-body" style="background: #f9f9f9;"> 
                      <div class="row"> 
                        <div class="col-md-3" id="img_comment_reply">
                          <img src="{{asset('images/profile.jpg')}}" width="100%">
                          <br>
                          <div class="comment_user">
                          <b>Azzam Jiul</b>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel-body" style="    border-top: 1px solid #eee;">
                  <form action="#" method="post" style="    padding: 0 16px;">
                    {{csrf_field()}}
                    <div class="form-group">
                      <input type="text" name="content" class="form-control" id="input_reply" placeholder="Reply here..">        
                    </div>
                    <button class="btn btn-success" type="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
            <br>
            @empty
            <p>No Comment</p>
            @endforelse
            <!-- endforelse -->
            <hr>

            <hr>
            <div class="panel panel-default" style="background-color: #f9f9f9;">
              <div class="panel-body">
            <div class="add_comment">
              <div class="open_comment">
                  <div class="h1"><h4>Add a Comment</h4></div>
              </div>
              @if (Auth::guest())

              <div class="comment-show" style="padding: 60px">
                <a href="{{route('login')}}" style="color: #28ad76">
                  <p><i class="fa fa-sign-in"></i> Login to Comment</p>
                </a>
              </div>

              @else
              <div class="comment-show">
                <form action="{{ route('addComment', $forums->id)}}" method="post">
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

              @endif
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