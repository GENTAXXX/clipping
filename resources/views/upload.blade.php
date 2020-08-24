<!DOCTYPE html>
<html>

<head>
    <title>Upload File</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="row">
        <div class="container">

            <h2 class="text-center my-5">Upload File</h2>

            <div class="col-lg-8 mx-auto my-5">

                @if(count($errors ?? '') > 0)
                <div class="alert alert-danger">
                    @foreach ($errors ?? ''->all() as $error)
                    {{ $error }} <br />
                    @endforeach
                </div>
                @endif

                <form action="/api/news" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <b>File Gambar</b><br />
                        <input type="file" name="image">
                    </div>

                    <div class="form-group">
                        <b>Title</b>
                        <input class="form-control" name="title" />
                    </div>

                    <div class="form-group">
                        <b>Desc</b>
                        <input class="form-control" name="desc" />
                    </div>

                    <div class="form-group">
                        <b>Content</b>
                        <input class="form-control" name="content" />
                    </div>

                    <div class="form-group">
                        <b>Scan</b>
                        <input class="form-control" name="scan" />
                    </div>

                    <div class="form-group">
                        <b>Area</b>
                        <input class="form-control" name="area" />
                    </div>

                    <div class="form-group">
                        <b>Created</b>
                        <input class="form-control" type="date" name="created" />
                    </div>

                    <div class="form-group">
                        <b>Media Id</b>
                        <input class="form-control" type="number" name="media_id" />
                    </div>

                    <div class="form-group">
                        <b>Date</b>
                        <input class="form-control" type="date" name="date" />
                    </div>

                    <div class="form-group">
                        <b>Categories</b>
                        <input class="form-control" name="categories" />
                    </div>

                    <div class="form-group">
                        <b>Language Id</b>
                        <input class="form-control" type="number" name="lang_id" />
                    </div>

                    <div class="form-group">
                        <b>Project Id</b>
                        <input class="form-control" type="number" name="project_id" />
                    </div>

                    <input type="submit" value="Upload" class="btn btn-primary">
                </form>

                <h4 class="my-5">Data</h4>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="1%">File</th>
                            <th>Keterangan</th>
                            <th width="1%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $g)
                        <tr>
                            <td><img width="150px" src="{{ url('/data_file/'.$g->image) }}"></td>
                            <td>{{$g->title}}</td>
                            <td><a class="btn btn-danger" href="/upload/hapus/{{ $g->id }}">HAPUS</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>