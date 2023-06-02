@extends('admin.layout.app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Posts</h3>
                            <a href="/admin/addpost" class="btn btn-success float-lg-right col-md-2">Add New Post</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-gray-light">
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Img</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Created Date</th>
                                    <th colspan="2" style="text-align: center">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->id}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{Illuminate\Support\Str::words($post->description, 3)}}</td>
                                        <td><img src="/assets/uploads/{{$post->img}}" width="55" height="55"/></td>
                                        <td>{{$post->category}}</td>
                                        <td>{{$post->tags}}</td>
                                        <td style="width: 13%">{{date('d M Y', strtotime($post->created_at))}}</td>
                                        <td>
                                            <a href="/admin/edit/{{$post->id}}" class="btn btn-primary">Edit </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('remove-form').submit();">Delete </a>
                                        </td>
                                        <form id="remove-form" action="/admin/remove/{{$post->id}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{$posts->links('vendor.pagination.bootstrap-5')}}

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
