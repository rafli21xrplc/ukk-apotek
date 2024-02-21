@extends('layouts.dashboard-layout')

@section('content')
    <div class="w-100 px-5">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 style="font-weight: 500">Log</h1>
            </div>
        </div>
        <div class="my-4 py-5 px-5" style="background-color: white; border-radius: 10px">
            <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Method
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Messages
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Url
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Waktu
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($log as $index => $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td>
                                {{ $index + 1 }}
                            </td>
                            <td>
                                {{ $item->method }}
                            </td>
                            <td>
                                {{ $item->message }}
                            </td>
                            <td>
                                {{ $item->url }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }}
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
@endsection
