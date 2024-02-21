@extends('layouts.dashboard-layout')

@section('content')
    <div class="w-100 px-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-weight: 500">Obat</h1>
            </div>
            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                data-bs-target="#obat-modal">
                <span class="btn-label"><i class="dripicons-plus"></i></span>Tambah Obat
            </button>
        </div>
        <div class="my-4 py-5 px-5" style="background-color: white; border-radius: 10px">
            <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Buat
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $index => $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td>
                                {{ $index + 1 }}
                            </td>
                            <td>
                                {{ $item->nama_kategori }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }}
                            </td>
                            <td class="d-flex justify-content-center align-items-center gap-2">
                                <div>
                                    <button data-kode="{{ $item->id_kategori }}"
                                        data-nama_kategori="{{ $item->nama_kategori }}"
                                        class="btn btn-warning btn-edit"style="color: whitesmoke">Update</button>
                                </div>
                                <div>
                                    <form action="{{ route('destroy.kategori.admin', $item->id_kategori) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <div class="my-5 flex justify-center w-full" style="min-height:16rem">
                                    <div class="my-auto">
                                        <img width="250" src="{{ asset('assets/gambar/empty-data.png') }}" alt=""
                                            srcset="">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
        </div>
    </div>

    <div id="obat-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="obat-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('tambah.kategori.admin') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Kategori Obat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama_kategori"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light text-white">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="modal_obat_kategori_update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="obat-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('update.kategori.obat.admin') }}" method="POST" class="form_edit">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="code">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Update Obat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 inputData">
                                    <label for="nama" class="form-label">nama</label>
                                    <input type="text" class="form-control" id="nama_kategori_update"
                                        name="nama_kategori">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light text-white">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="{{ asset('assets/jQuery.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.btn-edit');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-kode');
                    var nama = this.getAttribute('data-nama_kategori');
                    var formUpdate = document.querySelector('.form_edit');

                    document.querySelector('#code').value = id;
                    document.querySelector('#nama_kategori_update').value = nama;

                    $('#modal_obat_kategori_update').modal('show');
                });
            });
        });
    </script>
@endsection
