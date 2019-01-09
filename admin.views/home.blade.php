@extends('layouts.app')

@section('content')
    <script type="text/javascript">
        function goto_wwc() {
            window.open('{{ config('app.url') }}' + '{{ session('CURRENT') }}', "TEST - 2017 WWC");
        }
    </script>
    <nav>
        <a id="id-home" href="#" onclick="goto_wwc()">SHOW in 2017-WWC</a>
        <a id="id-news" href="{{ url('/') }}/post-all">NEWS</a>
        <a id="id-tops" href="{{ url('/') }}/menu-all">TOP MENUS</a>
        <a id="id-pages" href="{{ url('/') }}/page-all">PAGES</a>
        <a id="id-meta" href="{{ url('/') }}/postmeta-all">S.E.O.</a>
        <a id="id-social" href="{{ url('/') }}/option-all">TEAM</a>
        <a id="id-langs" href="{{ url('/') }}/lang-all">HOME PAGES</a>
        <a id="id-current" href="{{ url('/') }}/current">CURRENT LANGUAGE</a>
        <div class="animation start-A"></div>
    </nav>
@endsection
