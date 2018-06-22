@include('common.error')

<div class="reply-box">
    <form action="{{ route('replies.store') }}" method="post" accpet-charset="UTF-8">
        {{ csrf_field() }}
        <input type="hidden" name="topic_id" value={{ $topic->id }}>

        <div class="form-group">
            <textarea name="content" class="form-control" placeholder="分享你的想法"  rows="3"></textarea>
        </div>

        <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-share"></i>回复</button>
    </form>
</div>