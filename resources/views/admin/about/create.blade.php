@extends('admin.layout')

@section('pagecontent')

<h2>Add About</h2>

<form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<input type="text" name="heading" placeholder="Heading"><br><br>

<textarea name="description" placeholder="Description"></textarea><br><br>

<input type="file" name="image"><br><br>

<button type="submit">Save</button>

</form>

@endsection