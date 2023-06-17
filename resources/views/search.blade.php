@extends('layout.app')
@section('content')
    <!--
			=============================================
				Theme Inner Banner
			==============================================
			-->
    <div class="theme-inner-banner bg-box section-margin-bottom">
        <div class="container">
            <h2>{{$searchText}}</h2>
        </div> <!-- /.container -->
    </div> <!-- /.theme-inner-banner -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12 blog-grid-style style-two hover-effect-one">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-6 col-12">
                            <div class="single-blog-post">
                                <div class="image-box">
                                    <img src="/assets/uploads/{{$post->img}}" alt="" width="370" height="230">
                                    <div class="tag"><a
                                            href="/search/category/{{$post->category_id}}">{{$post->category}}</a></div>
                                </div>
                                <div class="post-meta-box bg-box">
                                    <ul class="author-meta clearfix">
                                        <li class="date"><a
                                                href="/search/category/{{date('d-M-Y', strtotime($post->created_at))}}">{{date('d-M-Y', strtotime($post->created_at))}}</a>
                                        </li>
                                    </ul>
                                    <h4 class="title"><a href="/post/detail/{{$post->id}}">{{$post->title}}</a></h4>
                                    <!--
                                    <ul class="share-meta clearfix">
                                        <li><a href="#"><i class="icon flaticon-comment"></i>Comments (03)</a></li>
                                        <li><a href="#"><i class="icon flaticon-like-heart"></i>Likes (05)</a></li>
                                    </ul>
                                    -->
                                    <p>{!! Illuminate\Support\Str::words($post->description, 40) !!}</p>
                                </div> <!-- /.post-meta-box -->
                            </div> <!-- /.single-blog-post -->
                        </div> <!-- /.col -->
                    @endforeach
                </div> <!-- /.row -->

                <!-- pagination -->
                {{$posts->links('vendor.pagination.bootstrap-4')}}

            </div> <!-- /.col- -->

@endsection
