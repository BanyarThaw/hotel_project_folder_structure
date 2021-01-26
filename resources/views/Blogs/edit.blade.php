@extends('Templates.Blog.sub_template_blogs_edit')

@section('sub_content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12 animated fadeInRight">
                <div class="mail-box-header">
                    <h2>
                        Edit Blog
                    </h2>
                </div>
                <form action="/hotel-admin/blogs/{{ $blog->id }}" method="POST" enctype="multipart/form-data">
                    {{ method_field("PUT") }}
                    {{ csrf_field() }}
                    <div class="mail-box">
                        <div class="mail-body">
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Title : </label>
                                <div class="col-sm-10"><input type="text" name="title" class="form-control" value="{{ $blog->title }}" required></div>
                            </div>
                            <br>
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Body :</label>
                                <div class="col-sm-10">
                                    <textarea class="summernote" name="about">{{ $blog->about }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mail-body">
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Author Name : </label>
                                <div class="col-sm-10"><input type="text" name="author_name" value="{{ $blog->author_name }}" class="form-control" required></div>
                            </div>
                        </div>
                        <div class="mail-body">
                            <div class="form-group row"><label class="col-sm-2 col-form-label">Photo : </label>
                                <div class="col-sm-10"><input type="file" name="photo"></div>
                            </div>
                        </div>   
                        <div class="mail-body text-right tooltip-demo">
                            <button type="submit" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="update">Update </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection