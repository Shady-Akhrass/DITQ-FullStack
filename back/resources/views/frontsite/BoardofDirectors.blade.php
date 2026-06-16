@extends('frontsite.layout.master')

@section('content')
    <div id="myButton"></div>
    <div class="board">
        <div class="container">
            <div class="title">
                <h2><a href="#">مجلس الإدارة</a></h2>
            </div>

            <div class="president">
                @for ($i = 0; $i < 1; $i++)
                    <div class="a-box">
                        <div class="img-container">
                            <img src="{{ asset('storage/' . $directors[$i]->image) }}">
                        </div>
                        <div class="text-container">
                            <h3>{{ $directors[$i]->name }}</h3>
                            <div>
                                {{ $directors[$i]->postion }}
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <div class="members">
                @for ($i = 1; $i < 4; $i++)
                    <div class="Management_members">
                        <div class="a-box">
                            <div class="img-container">
                                <img src="{{ asset('storage/' . $directors[$i]->image) }}">
                            </div>
                            <div class="text-container">
                                <h3>{{ $directors[$i]->name }}</h3>
                                <div>
                                    {{ $directors[$i]->postion }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="member">

                @for ($i = 4; $i < 4 * 2; $i++)
                    <div class="Management_members">
                        <div class="a-box">
                            <div class="img-container">
                                <img src="{{ asset('storage/' . $directors[$i]->image) }}">
                            </div>
                            <div class="text-container">
                                <h3>{{ $directors[$i]->name }}</h3>
                                <div>
                                    {{ $directors[$i]->postion }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            @if (count($directors) > 8 and count($directors) % 4 == 1)
                @for ($i = 8; $i < 9; $i++)
                    <div align="center">
                        <div class="a-box">
                            <div class="img-container">
                                <img src="{{ asset('storage/' . $directors[$i]->image) }}">
                            </div>
                            <div class="text-container">
                                <h3>{{ $directors[$i]->name }}</h3>
                                <div>
                                    {{ $directors[$i]->postion }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
            <div style="display: flex; align-items: center; justify-content: center;">
                @if (count($directors) > 8 and count($directors) % 4 == 2)
                    @for ($i = 8; $i < 10; $i++)
                        <div style="margin-right: 126px; margin-bottom: 20px;margin-left: 120px;">
                            <div class="a-box">
                                <div class="img-container">
                                    <img src="{{ asset('storage/' . $directors[$i]->image) }}">
                                </div>
                                <div class="text-container">
                                    <h3>{{ $directors[$i]->name }}</h3>
                                    <div>
                                        {{ $directors[$i]->postion }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>

            @if (count($directors) > 8 and count($directors) % 4 == 3)
                <div style="display: flex; align-items: center; justify-content: center;">
                    @for ($i = 8; $i < 11; $i++)
                        <div style="margin-left:70px ; margin-right:70px ; margin-bottom: 20px;">
                            <div class="a-box">
                                <div class="img-container">
                                    <img src="{{ asset('storage/' . $directors[$i]->image) }}">
                                </div>
                                <div class="text-container">
                                    <h3>{{ $directors[$i]->name }}</h3>
                                    <div>
                                        {{ $directors[$i]->postion }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif

            @if (count($directors) > 8 and count($directors) % 4 == 0)
                <div style="display: flex; align-items: center; justify-content: center;">
                    @for ($i = 8; $i < count($directors); $i++)
                        <div style="margin-left:20px ; margin-right:20px ; margin-bottom: 20px;">
                            <div class="a-box">
                                <div class="img-container">
                                    <img src="{{ asset('storage/' . $directors[$i]->image) }}">
                                </div>
                                <div class="text-container">
                                    <h3>{{ $directors[$i]->name }}</h3>
                                    <div>
                                        {{ $directors[$i]->postion }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
        
        </div>
<div class="directorsofphone" style="direction: rtl;">
        <h3> 1- أ. أحمد موسى <span>- رئيس مجلس الإدارة </span></h3>
        <h3> 2- أ. ناصر المصري <span>- نائب رئيس مجلس الإدارة </span></h3>
        <h3> 3- أ. مصطفى الحولي <span>- أمين سر </span></h3>
        <h3> 4- أ. محمد ابو محسن <span>- أمين صندق</span></h3>
        <h3> 5- أ.بلال اللحام <span>- عضو </span></h3>
        <h3> 6- أ.مصطفى ابو هربيد<span>- عضو </span></h3>
        <h3> 7- أ. أنور الغوطي <span>- عضو </span></h3>
        <h3> 8- أ. يوسف بدوي <span>- عضو </span></h3>
        <h3> 9-أ. ناهل شعت <span>- عضو </span></h3>
    </div>
    </div>
        
        
    </div>
@endsection
@section('title')
    مجلس الإدارة
@endsection