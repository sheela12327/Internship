@extends('admin.layout')

@section('pagecontent')
<h2>Edit About</h2>

<form action="{{ route('admin.about.update',$about->id) }}" method="POST" enctype="multipart/form-data">
@csrf

<input type="text" name="heading" value="{{ $about->heading }}"><br><br>

<textarea name="description">{{ $about->description }}</textarea><br><br>

<img src="{{ asset('uploads/about/'.$about->image) }}" width="100"><br><br>

<input type="file" name="image"><br><br>

<button type="submit">Update</button>

</form>




@endsection