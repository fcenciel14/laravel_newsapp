@extends('layouts.app')

@section('title', 'My Test Editor page')

@section('script-footer')
    <script src="{{ mix('js/editor.js') }}"></script>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row ">
      <div id="editor"><div>
    </div>
  </div>
</div>
@endsection
