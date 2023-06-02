@extends('admin.layout.app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Contacts</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="bg-gray-light">
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Created Date</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($allContacts as $contact)
                                    <tr>
                                        <td>{{$contact->id}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->message}}</td>
                                        <td style="width: 13%">{{date('d M Y', strtotime($contact->created_at))}}</td>
                                        <td>
                                            <a class="btn btn-danger" onclick="event.preventDefault();
                                                     document.getElementById('remove-form').submit();">Delete</a>
                                        </td>
                                        <form id="remove-form" action="/admin/contact/remove/{{$contact->id}}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{$allContacts->links('vendor.pagination.bootstrap-5')}}

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
