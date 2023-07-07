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
                            <h3 class="card-title">Add Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="addpost" action="/admin/addpost" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" id="postid" name="postid"
                                   value="{{(isset($post->id) ? $post->id : null)}}" hidden/>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control"
                                           value="{{(isset($post->title) ? $post->title : null)}}" required/>
                                </div>
                                <div class="form-group">
                                    <label for="summernote">Description</label>
                                    <textarea id="summernote" name="description" value="" required>
                                        {{(isset($post->description) ? $post->description : 'Place <em>some</em> <u>text</u> <strong>here</strong>')}}

                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="customFile">Pattern</label>
                                    <select id="pattern" name="pattern" class="form-control" required>
                                        <option value="0">Select a Pattern ...</option>
                                        @foreach($patterns as $i)
                                            @if(isset($post->pattern_id))
                                                @if($i->id == $post->pattern_id)
                                                    <option selected value="{{$i->id}}">{{$i->description}}</option>
                                                @else
                                                    <option value="{{$i->id}}">{{$i->description}}</option>
                                                @endif
                                            @else
                                                <option value="{{$i->id}}">{{$i->description}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    <input type="text" name="oldImg" value="{{(isset($post->img) ? $post->img : null)}}"
                                           hidden/>
                                </div>
                                <div class="form-group">
                                    <label for="title">Pattern Text</label>
                                    <input type="text" id="patternText" name="patternText" class="form-control"
                                           value="{{(isset($post->pattern_text) ? $post->pattern_text : null)}}"
                                           required/>
                                </div>
                                <div class="form-group">
                                    <label for="mainCats">Main Category</label>
                                    <select id="mainCats" class="form-control" onchange="catSelected(value);" required>
                                        <option value="0">Select a Category ...</option>
                                        @foreach($mainCats as $cat)
                                            @if(isset($postMainCat->id))
                                                @if($cat->id == $postMainCat->id)
                                                    <option selected value="{{$cat->id}}">{{$cat->category}}</option>
                                                @else
                                                    <option value="{{$cat->id}}">{{$cat->category}}</option>
                                                @endif
                                            @else
                                                <option value="{{$cat->id}}">{{$cat->category}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    <div class="form-group">
                                        <label id="subCatLabel" for="subCat" hidden>Sub Category</label>
                                        <select id="subCat" name="subcategory" class="form-control" hidden required>
                                            <option value="0">Select a Sub Category</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <input type="text" value="{{(isset($post->tags) ? $post->tags : null)}}"
                                           class="form-control" id="tags" name="tags"
                                           placeholder="Add tags" required/>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
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

    <script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            @if(isset($postMainCat->id))
            catSelected({{$postMainCat->id}});
            @endif
        });

        function changeImg(value) {
            $('#oldImg').val(value);
        }

        function catSelected(value) {
            if (value != 0) {

                $('#subCat, #subCatLabel').removeAttr('hidden');
                $('#subCat').find('option').not(':first').remove();

                $.ajax({
                    dataType: 'json',
                    method: 'get',
                    url: '/admin/getSubCatWithAjax',
                    data: {
                        id: value,
                    },
                    success: function (data) {
                        var len = data.data.length;
                        for (var i = 0; i < len; i++) {
                            var categoryId = data.data[i]['id'];
                            var categoryName = data.data[i]['category'];
                            @if(isset($post))
                            if ({{$post->category_id}} == categoryId)
                                $('#subCat').append("<option  selected value='" + categoryId + "'>" + categoryName + "</option>");
                            else
                                $('#subCat').append("<option  value='" + categoryId + "'>" + categoryName + "</option>");
                            @else
                            $('#subCat').append("<option value='" + categoryId + "'>" + categoryName + "</option>");
                            @endif

                        }
                        console.log(data.data);
                    },
                    error: function (error) {
                        console.log(error);
                    }

                });
                console.log(html);
            } else {
                $('#subCat').val("0");
                $('#subCat, #subCatLabel').attr('hidden', true);
            }
        }

    </script>

    <!-- populate sub categroy jscript -->

@endsection
