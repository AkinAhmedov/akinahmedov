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
                            <h3 class="card-title">Sub Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="subcategories" action="/admin/subcategories" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label id="mainCats" for="mainCats">Main Categories</label>
                                    <select class="form-control" name="mainCats" onchange="getSubCategories(value);"
                                            required>
                                        <option value="0">Select a Category</option>
                                        @foreach($mainCats as $cat)
                                            <option value="{{$cat->id}}">{{$cat->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label id="subCatLabel"  for="subcats" style="display: none;" >Sub Categories</label>
                                    <select id="subCat" multiple class="form-control" name="deletesubcats[]" style="display: none;" >
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subnew">Add New Sub Category</label>
                                    <input type="text" id="subnew" name="newSubCategory" class="form-control" value=""/>
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
    <script>
        function getSubCategories(value) {
            if (value != 0) {
                $('#subCat, #subCatLabel').css('display', 'none');
                $('#subCat').find('option').remove();

                $.ajax({
                    dataType: 'json',
                    method: 'get',
                    url: '/admin/getSubCatWithAjax',
                    data: {
                        id: value,
                    },
                    success: function (data) {
                        var len = data.data.length;
                        if (len > 0) {
                            $('#subCat, #subCatLabel').css('display', 'block');
                            for (var i = 0; i < len; i++) {
                                var categoryId = data.data[i]['id'];
                                var categoryName = data.data[i]['category'];

                                $('#subCat').append("<option value='" + categoryId + "'>" + categoryName + "</option>");
                            }
                        } else {
                            $('#subCat').val("0");
                            $('#subCat, #subCatLabel').css('display', 'none');
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }

                });
            } else {
                $('#subCat').val("0");
                $('#subCat, #subCatLabel').css('display', 'none');
            }
        }
    </script>

@endsection
