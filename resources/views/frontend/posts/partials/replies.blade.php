@foreach($comments as $comment)
<div class="usercomment row">
    {{-- <div class="col-12"> --}}
    
    <div class="card border-left">
        {{-- <div class="vl"> --}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="user-image">
                        <img src="{{(!empty($comment->user->profile_image)) ? asset($comment->user->profile_image) : asset('assets/images/profile.png') }}"
                                alt="profile" width="32" height="32" />
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <p class="col-md-6">{{$comment->user->display_name}}</p>
                        <p class="col-md-6">{{ date('M d,Y', strtotime($comment->created_at)) }}</p>
                    </div>
                    <div class="row mb-3">
                        <p class="col-md-12"><b>{{$comment->comment}}</b></p>
                    </div>
                    <div class="row">
                        <p class="col-md-12"> 
                            <form method="post" action="{{ url('/posts/comment/reply') }}" class="row">
                            @csrf
                            <div class="form-group w-60-p">
                                <input type="text" name="comment" class="form-control" />
                                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                            </div>
                            <div class="form-group replybtn">
                                <input type="submit" class="btn btn-sm btn-outline-danger" style="font-size: 0.8em;" value="Reply" />
                            </div>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </div>
    {{-- </div> --}}
    {{-- <div class="col-md-3 user-image">
        <img src="{{(!empty($comment->user->profile_image)) ? asset($comment->user->profile_image) : asset('assets/images/profile.png') }}"
            alt="profile" width="64" height="64" />
    </div>
    <div class="col-md-9 mb-3 row">
        <p class="col-md-6">{{$comment->user->display_name}}</p>
        <p class="col-md-6">{{ date('M d,Y', strtotime($comment->created_at)) }}</p>
        <p class="col-md-12"><b>{{$comment->comment}}</b></p>
        <p class="col-md-12"> 
            <form method="post" action="{{ url('/posts/comment/reply') }}" class="row">
            @csrf
            <div class="form-group w-60-p">
                <input type="text" name="comment" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group replybtn">
                <input type="submit" class="btn btn-sm btn-outline-danger" style="font-size: 0.8em;" value="Reply" />
            </div>
        </form></p>
    </div>
    <a href="" id="reply"></a> --}}
   
    @include('frontend.posts.partials.replies', ['comments' => $comment->replies])
</div>
@endforeach
