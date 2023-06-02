@foreach($childs as $child)
    <div class="single-comment clearfix" style="margin-left: 50px;">
        <img src="{{$comment->avatar}}" alt="" class="float-left">
        <div class="comment float-left">
            <h6><a href="#">{{$comment->name}}</a></h6>
            <div class="date">{{date('d-M-Y', strtotime($comment->created_at))}}</div>
            <!-- <a href="javascript:void(0);" onclick="scrollAndGetId({{$comment->id}});" class="reply">Cevapla</a> -->
            <p>{{$comment->comment}}</p>
        </div>
    </div>
    @if(count($child->childs))
        @include('manage_childs_comment',['childs' => $child->childs])
    @endif
@endforeach




