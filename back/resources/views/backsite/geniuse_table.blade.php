@extends('backsite.layout.master')
@section('title')
    عرض النوابغ
@endsection
@section('content')

    <head>

        <head>
            <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
         </head>

    </head>
    <div class="container" dir="rtl">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('geniuse-post') }}">الاضافة</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">عرض</a>
            </li>
        </ul>
        <br>
        <br>
        <table class="table" dir="rtl">
            <thead>
                <tr align="center">
                    <th scope="col">#</th>
                    <th scope="col">الاسم </th>
                    <th scope="col">التفاصيل </th>
                    <th scope="col">الصورة</th>
                    <th scope="col">الحدث </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($geniuse as $gen)
                    {{-- $id={{ $gen->id }}; --}}
                    {{-- <input type="hidden" name="hidden_id" value="{{ $gen->id }}"> --}}
                    <tr align="center">
                        <th scope="row" style="padding-top: 42px">{{ $gen->id }}</th>
                        <td style="padding-top: 42px">{{ $gen->name }}</td>
                        <td style="padding-top: 42px">{{ Str::limit($gen->details, 30) }}</td>
                        <td> <img src="{{ asset('storage/' . $gen->image) }}" width="130 " height="90"></td>
                        <td style="padding-top: 42px ;width: 170px"><a href="{{ url('admin/geniuse/edit/' . $gen->id) }}"
                                class="btn btn-primary">تعديل</a>
                            <a href="{{ url('admin/geniuse/destroy/' . $gen->id) }}" class="btn btn-danger">حذف</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
@endsection
