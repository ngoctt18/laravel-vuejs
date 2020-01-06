@extends('layouts.app')

@section('content')
    <div class="container">

        <br>
        <h3>========</h3>
        <blog></blog>
        <br>

        <br>
        <h3>========</h3>
        <User></User>
        <br>

        <br>
        <h3>========</h3>
        <api-calling></api-calling>
        <br>

        <br>
        <h3>========</h3>
        <parent></parent>
        <br>

        <br>
        <h3>========</h3>
        <event-handling></event-handling>
        <br>

        <br>
        <h3>========</h3>
        <input-binding></input-binding>
        <br>

        <user-dashboard></user-dashboard>

        <br>
        <h3>========</h3>
        <my-component></my-component>
        <br>
        <h3>========</h3>
        <conditional-component></conditional-component>
        <br>
        <h3>========</h3>
        <life-cycle></life-cycle>
        <br>
        <h3>========</h3>
        <binding-html></binding-html>
        <br>
        <h3>========</h3>
    </div>
@endsection

@section('css_top')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@endsection

@section('js_top')
    <script type="text/javascript" src="http://asvd.github.io/syncscroll/syncscroll.js"></script>
@endsection
