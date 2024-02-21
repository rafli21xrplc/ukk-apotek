@if ($errors->any())
    @php
        alert()->warning('Warning', $errors->first());
    @endphp
@endif

@if (session('success'))
    @php
        alert()->success('Berhasil', session('success'));
    @endphp
@endif

@if (session('error'))
    @php
        alert()->warning('Gagal', session('error'));
    @endphp
@endif
