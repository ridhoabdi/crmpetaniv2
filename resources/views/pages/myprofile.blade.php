@extends('layouts.mother')

@section('container')

<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Tambah Data Diri Anda</h4>
            <form name="add-blog-post-form" id="add-blog-post-form" method="post"
                action="{{ url('/kirim/daftarpetani') }}">
                @csrf
                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">id</label>
                    <input type="id" id="id" name="id" class="form-control" required="">
                </div> --}}
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kabupaten</label>
                    <input type="text" id="kabupaten" name="kabupaten" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No Hp/Whastapp</label>
                    <input type="text" id="nohp" name="nohp" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">pendidikan</label>
                    <input type="text" id="pendidikan" name="pendidikan" class="form-control">
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<!-- partial -->
</div>
<!-- main-panel ends -->
@endsection