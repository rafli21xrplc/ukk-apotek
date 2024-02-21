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
                            Gambar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stok
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Experiet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($obat as $index => $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 ">
                            <td>
                                {{ $index + 1 }}
                            </td>
                            <td>
                                <img src="{{ asset('storage/' . $item->gambar) }}" width="100" alt="">
                            </td>
                            <td>
                                {{ $item->nama_obat }}
                            </td>
                            <td>
                                {{ $item->kategori->nama_kategori }}
                            </td>
                            <td>
                                {{ number_format($item->harga, 2, ',', '.') }}
                            </td>
                            <td>
                                {{ $item->keterangan }}
                            </td>
                            <td>
                                {{ $item->stok }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->exp)->formatLocalized('%d %B %Y') }}
                            </td>
                            <td class="d-flex justify-content-center align-items-center gap-2 py-5">
                                <div>
                                    <button data-kode="{{ $item->kode_obat }}" data-nama="{{ $item->nama_obat }}"
                                        data-gambar="{{ $item->gambar }}" data-kategori="{{ $item->id_kategori }}"
                                        data-harga="{{ $item->harga }}" data-keterangan="{{ $item->keterangan }}"
                                        data-stok="{{ $item->stok }}" data-exp="{{ $item->exp }}"
                                        class="btn btn-warning btn-edit" type="button"
                                        style="color: whitesmoke">Update</button>
                                </div>
                                <div>
                                    <form action="{{ route('destroy.obat.admin', $item->kode_obat) }}" method="post">
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
                                        <img width="250" src="{{ asset('assets/gambar/empty-data.png') }}"
                                            alt="" srcset="">
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
            <form action="{{ route('tambah.obat.admin') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Obat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">kategori</label>
                                    <select name="kategori" class="form-control">
                                        @forelse ($kategori as $item)
                                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                        @empty
                                            <option disabled value="">Empty</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama_obat"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="harga" class="form-label">harga</label>
                                    <input min="0" type="number" class="form-control" id="harga"
                                        name="harga" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">keterangan</label>
                                    <textarea style="resize: none" rows="4" name="keterangan" class="form-control" id="field-7"
                                        placeholder="keterangan.."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="stok" class="form-label">stok</label>
                                    <input min="0" type="number" class="form-control" id="stok"
                                        name="stok" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exp" class="form-label">exp</label>
                                    <input type="date" class="form-control" id="exp" name="exp"
                                        aria-describedby="emailHelp">
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

    <div id="obat-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="obat-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-edit-obat" action="{{ route('update.obat.admin') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Obat</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="id" id="code">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="my-3">
                                    <img id="gambar_obat" style="object-fit: cover" width="100" src=""
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">kategori</label>
                                    <select name="kategori" id="id_kategori_update" class="id_kategori form-control">
                                        @forelse ($kategori as $item)
                                            <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                        @empty
                                            <option disabled value="">Empty</option>
                                        @endforelse
                                    </select>
                                </div>
                                <img src="" alt="" srcset="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">nama</label>
                                    <input type="text" class="form-control" id="nama_update" name="nama_obat"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="harga" class="form-label">harga</label>
                                    <input min="0" type="number" class="form-control" id="harga_update"
                                        name="harga" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">keterangan</label> <input type="text"
                                        class="form-control" id="keterangan_update" name="keterangan"
                                        aria-describedby="emailHelp">
                                    {{-- <textarea name="keterangan" id="keterangan" rows="10" style="resize: none"></textarea> --}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="stok" class="form-label">stok</label>
                                    <input min="0" type="number" class="form-control" id="stok_update"
                                        name="stok" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exp" class="form-label">exp</label>
                                    <input type="date" class="form-control" id="exp_update" name="exp"
                                        aria-describedby="emailHelp">
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
                    var id = $(this).data('kode');
                    var nama = $(this).data('nama');
                    var kategori = $(this).data('kategori');
                    var harga = $(this).data('harga');
                    var keterangan = $(this).data('keterangan');
                    var stok = $(this).data('stok');
                    var exp = $(this).data('exp');
                    var gambar = $(this).data('gambar');
                    var formUpdate = document.querySelector('.form-edit-obat');

                    console.log(gambar);

                    document.querySelector('#code').value = id;
                    document.querySelector('#nama_update').value = nama;
                    document.querySelector('#harga_update').value = harga;
                    document.querySelector('#keterangan_update').value = keterangan;
                    document.querySelector('#stok_update').value = stok;
                    document.querySelector('#exp_update').value = exp;
                    document.querySelector('#gambar_obat').src =
                        `http://127.0.0.1:8000/storage/${gambar}`;

                    document.querySelector('#id_kategori_update option[value="' + kategori + '"]')
                        .selected = true;

                    $('#obat-update').modal('show');
                });
            });
        });
    </script>
@endsection
