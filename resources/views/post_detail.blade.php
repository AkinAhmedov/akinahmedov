@extends('layout.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="blog-details">
                    <div class="main-post-wrapper">
                        <div class="post-top-image  ">
                            <div class="item"><img src="/assets/uploads/{{$post->img}}" alt="" width="770" height="400">
                            </div>
                        </div>
                        <h3 class="title">{{$post->title}}</h3>
                        <ul class="author-meta clearfix">
                            <li class="tag"><a href="/search/category/{{$post->category_id}}">{{$post->category}}</a>
                            </li>
                            <li class="date"><a href="#">{{date('d M Y', strtotime($post->created_at))}}</a></li>
                        </ul>
                        <p>{!! $post->description !!}</p>
                        <div class="bottom-content clearfix">
                            <ul class="tag-meta float-left">
                                <li>tags:</li>
                                @foreach(explode(',', $post->tags) as $tag )
                                    <li><a href="/search/tag/{{$tag}}">{{$tag}}</a></li>
                                @endforeach
                            </ul>
                        </div> <!-- /.bottom-content -->
                    </div> <!-- /.main-post-wrapper -->
                </div> <!-- /.blog-details -->
                @if($relatedPosts->count() > 1)
                    <div class="details-page-inner-box">
                        <h3>İlgili Postlar</h3>
                        <div class="row">
                            <div class="related-blog-slider blog-grid-style style-two hover-effect-one">
                                @foreach($relatedPosts as $rpost)
                                    @if($post->id != $rpost->id)
                                        <div class="item">
                                            <div class="single-blog-post">
                                                <div class="image-box">
                                                    <img src="/assets/uploads/{{$rpost->img}}" alt="" width="370"
                                                         height="230">
                                                </div>
                                                <div class="post-meta-box bg-box">
                                                    <ul class="author-meta clearfix">
                                                        <li class="date"><a
                                                                href="#">{{date('d-M-Y', strtotime($rpost->created_at))}}</a>
                                                        </li>
                                                    </ul>
                                                    <h4 class="title"><a
                                                            href="/post/detail/{{$rpost->id}}">{{$rpost->title}}</a>
                                                    </h4>
                                                </div> <!-- /.post-meta-box -->
                                            </div> <!-- /.single-blog-post -->
                                        </div> <!-- /.item -->
                                    @endif
                                @endforeach
                            </div> <!-- /.related-blog-slider -->
                        </div> <!-- /.row -->
                    </div> <!-- /.details-page-inner-box -->
                @endif

                <div class="details-page-inner-box comment-meta">
                    <h3>Yorumlar ({{$commentsCount}})</h3>
                    @foreach($comments as $comment)
                        <div class="single-comment clearfix" >
                            <img src="{{$comment->avatar}}" alt="" class="float-left">
                            <div class="comment float-left">
                                <h6><a href="#">{{$comment->name}}</a></h6>
                                <div class="date">{{date('d-M-Y', strtotime($comment->created_at))}}</div>
                                <a href="javascript:void(0);" onclick="scrollAndGetId({{$comment->id}});" class="reply">Cevapla</a>
                                <p>{{$comment->comment}}</p>
                            </div>
                        </div>
                        @if(count($comment->childs))
                            @include('manage_childs_comment',['childs' => $comment->childs])
                        @endif
                    @endforeach

                </div> <!-- /.comment-meta -->
                <div class="details-page-inner-box comment-form" id="writeComment">
                    <h3>Yorum Yap</h3>
                    <form action="#" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" id="postid" name="postid" value="{{$post->id}}"/>
                            <input type="hidden" id="subcommemt" name="parent_id" value="0"/>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <input type="text" placeholder="İsim" name="name" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                <input type="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="col-12">
                                <textarea name="comment" required placeholder="Mesaj"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="theme-button-one">Yorumla</button>
                    </form>
                </div> <!-- /.comment-form -->

            </div> <!-- /.col- -->
            <script>


                function scrollAndGetId(id) {
                    $('#subcommemt').val(id);

                    window.scrollTo({top: document.body.scrollHeight / 1.58, behavior: "smooth"});
                }
            </script>
@endsection
