@extends('backsite.layout.master')

@section('content')

    <head>

        <head>
            <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.min.css') }}">
            <title>show director director</title>
        </head>

    </head>

    <div class="container" dir="rtl">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('director-post') }}">الاضافة</a>
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
                    <th>#</th>
                    <th>الاسم </th>
                    <th>القسم</th>
                    <th>الصورة</th>
                    <th>الحدث </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($directors as $director)
                    {{-- $id={{ $gen->id }}; --}}
                    {{-- <input type="hidden" name="hidden_id" value="{{ $gen->id }}"> --}}
                    <tr align="center">
                        <th>{{ $director->id }}</th>
                        <td>{{ $director->name }}</td>
                        <td>{{ $director->postion }}</td>
                        <td> <img src="{{ asset('storage/' . $director->image) }}" width="130 " height="90"></td>
                        <td><a href="{{ url('admin/director/edit/' . $director->id) }}" class="btn btn-primary">تعديل</a>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
@endsection

@section('title')
    عرض مجلس الإدارة
@endsection
