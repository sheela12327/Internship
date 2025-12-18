@extends('admin.layout')

@section('pagecontent')

<h2>About List</h2>
<a href="{{ route('admin.about.create') }}">Add About</a>

<table border="1" width="100%">
<tr>
    <th>ID</th>
    <th>Heading</th>
    <th>Image</th>
    <th>Action</th>
</tr>

@foreach($abouts as $about)
<tr>
    <td>{{ $about->id }}</td>
    <td>{{ $about->heading }}</td>
    <td>
        <img src="{{ asset('uploads/about/'.$about->image) }}" width="80">
    </td>
    <td>
        <a href="{{ route('admin.about.edit',$about->id) }}">Edit</a> |
        <a href="{{ route('admin.about.delete',$about->id) }}">Delete</a>
    </td>
</tr>
@endforeach
</table>




@endsection