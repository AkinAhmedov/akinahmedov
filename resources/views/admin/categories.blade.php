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
                            <h3 class="card-title">Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="settings" action="/admin/categories" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <select multiple class="form-control" name="deleteCategory[]">
                                        @foreach($mainCats as $cat)
                                            <option value="{{$cat->id}}">{{$cat->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Add New Category</label>
                                    <input type="text" id="title" name="newCategory" class="form-control"
                                           value=""/>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="action" value="save" class="btn btn-primary">Save</button>
                                <button type="submit" name="action" value="delete" class="btn btn-danger">Detele
                                </button>
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
