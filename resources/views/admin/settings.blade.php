@extends('admin.layout.app')
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="settings" action="/admin/settings" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                           value="{{$settings['title']}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" id="description" name="description" class="form-control"
                                           value="{{$settings['description']}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="keywords">Keywords</label>
                                    <input type="text" id="keywords" name="keywords" class="form-control"
                                           value="{{$settings['keywords']}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="copyright">Copyright</label>
                                    <input type="text" id="copyright" name="copyright" class="form-control"
                                           value="{{$settings['copyright']}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" id="facebook" name="facebook" class="form-control"
                                           value="{{$settings['facebook']}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" id="twitter" name="twitter" class="form-control"
                                           value="{{$settings['twitter']}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" id="instagram" name="instagram" class="form-control"
                                           value="{{$settings['instagram']}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="text" id="linkedin" name="linkedin" class="form-control"
                                           value="{{$settings['linkedin']}}"/>
                                </div>
                                <div class="form-group">
                                    <label for="google">Google</label>
                                    <input type="text" id="google" name="google" class="form-control"
                                           value="{{$settings['google']}}"/>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>



@endsection
