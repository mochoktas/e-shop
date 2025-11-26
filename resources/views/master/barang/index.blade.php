@extends('be/main')
@section('title_page','BARANG')
@section('title','BARANG')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
            <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Tambah Barang</h4>
                        </div>
                        <form id="productForm" name="productForm" method="post" action="{{ route('barang.store') }}">
                            @csrf
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}" maxlength="50" >
                                </div>
                                @error('name')
                                    <div style="color: red;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="harga" class="col-sm-2 control-label">Harga:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Enter Harga" value="{{ old('harga') }}" maxlength="50" >
                                </div>
                                @error('harga')
                                    <div style="color: red;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="jb_id" class="col-sm-2 control-label">Jenis Barang:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="jb_id" name="jb_id">
                                        <option value="">-- Pilih Jenis Barang --</option>
                                        @foreach($jenis_barang as $jb)
                                        <option value="{{ $jb->id }}" {{ old('jb_id') == $jb->id ? 'selected' : '' }}>{{ $jb->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('jenis_barang_id')
                                    <div style="color: red;">
                                        {{ $message }}
                                    </div>
                                @enderror
                                


                            </div>

                    
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12">
                            <button type="submit" id="saveBtn" class="btn btn-link waves-effect">Tambah</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Keluar</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="dataModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="dataModalTitle"></h4>
                        </div>
                        
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="field1" name="field1" readonly >
                        </div>
                       
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Keluar</button>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="modal fade" id="dataModal2" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="dataModalTitle2"></h4>
                        </div>
                        <form id="productForm" name="productForm" method="post" action="{{ route('barang.update') }}">
                            @csrf
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="field12" name="field12" required >
                        </div>
                        <input type="hidden" id="dataid" name="dataid" value="">
                       @error('field12')
                            <div style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="saveBtn" class="btn btn-link waves-effect">Update</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Keluar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Barang
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#defaultModal">Tambah Data</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="barang-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Harga</th>
                                            <th>Photo</th>
                                            <th>Jenis Barang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection

@section('js_custom')
<script type="text/javascript">
    $(function() {

        var table = $('#barang-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('barang.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'photo',
                    name: 'photo', orderable: false, searchable: false
                },
                {
                    data: 'jb',
                    name: 'jb'
                },
                {
                    data: 'action', 
                    name: 'action', orderable: false, searchable: false
                },
            ]
        });


        $('.dataTable').on('click', '.show-data', function() {
        var dataId = $(this).data('id'); // Ambil nilai dari atribut data-id
        var modalTitle = $(this).hasClass('update-data') ? 'Edit Data Barang' : 'Detail Data Barang';

        // Konfigurasi AJAX show data
        $.ajax({
            url: '/master/barang/show/' + dataId, // Ganti dengan URL route Laravel Anda
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    
                    // Isi data ke dalam modal
                    $('#dataModalTitle').text(modalTitle); // Atur judul modal
                    $('#field1').val(data.name); // Isi nilai ke input/field form

                    // Tampilkan modal
                    $('#dataModal').modal('show');
                } else {
                    alert('Data tidak ditemukan.');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
                alert('Terjadi kesalahan saat mengambil data.');
            }
            });
        });

        $('.dataTable').on('click', '.update-data', function() {
        var dataId = $(this).data('id'); // Ambil nilai dari atribut data-id
        var modalTitle = $(this).hasClass('update-data') ? 'Edit Data Barang' : 'Detail Data Barang';

        // Konfigurasi AJAX edit data
        $.ajax({
            url: '/master/barang/edit/' + dataId, // Ganti dengan URL route Laravel Anda
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    
                    // Isi data ke dalam modal
                    $('#dataModalTitle2').text(modalTitle); // Atur judul modal
                    $('#field12').val(data.name); // Isi nilai ke input/field form

                    // Simpan ID data di form untuk keperluan update
                    $('#dataid').val(data.id); 

                    // Tampilkan modal
                    $('#dataModal2').modal('show');
                } else {
                    alert('Data tidak ditemukan.');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
                alert('Terjadi kesalahan saat mengambil data.');
            }
            });

            



        });

        $('.dataTable').on('click', '.edit-foto', function() {
        var dataId = $(this).data('id'); // Ambil nilai dari atribut data-id
        var modalTitle = 'Edit Foto Barang';

        // Konfigurasi AJAX edit data
        $.ajax({
            url: '/master/barang/edit/' + dataId, // Ganti dengan URL route Laravel Anda
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var data = response.data;
                    
                    // Isi data ke dalam modal
                    $('#dataModalTitle2').text(modalTitle); // Atur judul modal

                    // Tampilkan modal
                    $('#dataModal3').modal('show');
                } else {
                    alert('Data tidak ditemukan.');
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
                alert('Terjadi kesalahan saat mengambil data.');
            }
            });

            



        });

        

    });

    
</script>
@endsection