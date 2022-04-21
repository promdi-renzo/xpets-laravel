@extends('layouts.app')

@section('content')
<h1 class="text-center text-5xl pb-8 pt-6 font-bold ">Welcome To
  <span class="font-bold bg-black border-black text-red-600 rounded-l-lg">XxXxX</span>
  <span class="p-2 text-black bg-slate-100 rounded-r-lg">Pets</span> , {{
  Auth::user()->full_name }}
</h1>
<hr>
</div>

@endsection