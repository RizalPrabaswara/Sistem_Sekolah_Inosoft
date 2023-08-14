@extends('layouts.app')

@section('title', 'Data Kelas')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="card-title">
                Data Kelas
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-4">
                <a href="#modal-form" class="btn btn-primary modal-tambah">Tambah Data</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>ID Siswa</th>
                        <th>Nama Kelas</th>
                        <th>Keterangan</th>
                        <th>Pembimbing</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-kategori">
                                <div class="form-group">
                                    <label for="">ID Siswa</label>
                                    <input type="text" name="id_siswa" id="id_siswa" class="form-control"
                                        placeholder="Category Name Here...." required>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Kelas</label>
                                    <input type="text" name="nama_kelas" id="nama_kelas" class="form-control"
                                        placeholder="Tulis Nama Kelas...." required>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan Kelas</label>
                                    <textarea name="keterangan" id="keterangan" placeholder="Tulis keterangan Disini....." cols="30" rows="10"
                                        class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Pembimbing Kelas</label>
                                    <input type="text" name="pembimbing" id="pembimbing" class="form-control"
                                        placeholder="Tulis Nama Pembimbing Kelas...." required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Submit Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(function() {
            $.ajax({
                type: "GET",
                url: "/api/reviews",
                success: function({
                    data
                }) {
                    let row;
                    data.map(function(val, index) {
                        row += `
                    <tr>
                        <td>${index+1}</td>
                        <td>${val.member_id}</td>
                        <td>${val.product_id}</td>
                        <td>${val.review}</td>
                        <td>${val.rating}</td>
                        <td>
                            <a class="btn btn-warning modal-ubah" data-toggle="modal" href="#modal-form" data-id="${val.id}">Edit</a>
                            <a class="btn btn-danger btn-hapus" href="#" data-id="${val.id}">Delete</a>
                        </td>
                    </tr>
                        `;
                    });

                    $('tbody').append(row)
                }
            });

            $(document).on('click', '.btn-hapus', function() {
                const id = $(this).data('id');
                const token = localStorage.getItem('token');

                confirm_dialog = confirm('Apakah anda Yakin ?');

                if (confirm_dialog) {
                    $.ajax({
                        type: "DELETE",
                        url: "api/reviews/" + id,
                        headers: {
                            "Authorization": "Bearer" + token
                        },
                        success: function(data) {
                            if (data.success) {
                                alert('Data Berhasil Dihapus')
                            }
                        }
                    }).done(function() {
                        window.location.reload()
                    });
                }
            });

            $('.modal-tambah').click(function() {
                $('#modal-form').modal('show')
                $('input[name="name"]').val('')
                $('textarea[name="description"]').val('')

                $('.form-kategori').submit(function(e) {
                    e.preventDefault()
                    const $form = $(this)
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url: "api/reviews",
                        type: "POST",
                        data: frmdata,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                            "Authorization": "Bearer" + token
                        },
                        success: function(data) {
                            if (data.success) {
                                alert('Data Berhasil Ditambahkan')
                            }
                        }
                    }).done(function() {
                        window.location.reload()
                    });
                });
            });

            $(document).on('click', '.modal-ubah', function() {
                $('#modal-form').modal('show')
                const id = $(this).data('id');

                $.get('/api/reviews/' + id, function({
                    data
                }) {
                    $('input[name="name"]').val(data.name);
                    $('textarea[name="description"]').val(data.description);
                });

                $('.form-kategori').submit(function(e) {
                    e.preventDefault()
                    const $form = $(this)
                    const token = localStorage.getItem('token')
                    const frmdata = new FormData(this);

                    $.ajax({
                        url: `api/reviews/${id}?_method=PUT`,
                        type: "POST",
                        data: frmdata,
                        cache: false,
                        contentType: false,
                        processData: false,
                        headers: {
                            "Authorization": "Bearer" + token
                        },
                        success: function(data) {
                            if (data.success) {
                                alert('Data Berhasil Diubah')
                            }
                        }
                    }).done(function() {
                        window.location.reload()
                    });
                });
            });
        });
    </script>
@endpush
