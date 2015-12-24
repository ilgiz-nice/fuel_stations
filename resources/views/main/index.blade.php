@extends('app')

@section('title')
    Личный кабинет
@endsection

@section('nav')
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="/images/logo.png" alt="Автоваз" style="height:50px;">
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <p class="navbar-text navbar-right"><a href="/auth/logout/" class="navbar-link">Выйти</a></p>
                <a class="navbar-brand" href="#" style="float:right;margin-right: 300px;">{{ Auth::User()->name }}</a>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@endsection

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Дата</th>
                <th>номер заправки</th>
                <th>Кол-во литров</th>
                <th>Гос. номер</th>
            </tr>
            </thead>
            <tbody>
            @foreach($array as $a)
                <tr>
                    <td>{{ $a->date }}</td>
                    <td>{{ $a->station }}</td>
                    <td>{{ $a->value }}</td>
                    <td>{{ $a->car }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-default navbar-btn" onclick="print()">Распечатать</button>
    </div>
@endsection