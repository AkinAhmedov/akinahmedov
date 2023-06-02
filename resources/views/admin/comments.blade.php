@extends('admin.layout.app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Comments</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-gray-light">
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th>Post</th>
                                    <th>Created Date</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allComments as $comment)
                                    <tr>
                                        <td>{{$comment->id}}</td>
                                        <td>{{$comment->name}}</td>
                                        <td>{{$comment->email}}</td>
                                        <td>{{$comment->comment}}</td>
                                        <td>{{$comment->postid}}</td>
                                        <td style="width: 13%">{{date('d M Y', strtotime($comment->created_at))}}</td>
                                        <td>
                                            <a class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('remove-form').submit();">Delete</a>
                                        </td>
                                        <form id="remove-form" action="/admin/comment/remove/{{$comment->id}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{$allComments->links('vendor.pagination.bootstrap-5')}}

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
