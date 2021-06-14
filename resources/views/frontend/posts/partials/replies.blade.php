@foreach($comments as $comment)
<div class="usercomment row">
    <div class="col-md-3 user-image">
        <img src="{{(!empty($comment->user->profile_image)) ? asset($comment->user->profile_image) : asset('assets/images/profile.png') }}"
            alt="profile" width="64" height="64" />
    </div>
    <div class="col-md-9 row">
        <p class="col-md-12"><b>{{$comment->comment}}</b></p>
        <p class="col-md-6">{{$comment->user->display_name}}</p>
        <p class="col-md-6">{{ date('M d,Y', strtotime($comment->created_at)) }}</p>
    </div>
    <a href="" id="reply"></a>
    <form method="post" action="{{ url('/posts/comment/reply') }}" class="row" style="margin-left: 10%">
        @csrf
        <div class="form-group w-60-p">
            <input type="text" name="comment" class="form-control" />
            <input type="hidden" name="post_id" value="{{ $post_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>
        <div class="form-group replybtn">
            <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
        </div>
    </form>
    @include('frontend.posts.partials.replies', ['comments' => $comment->replies])
</div>
@endforeach
