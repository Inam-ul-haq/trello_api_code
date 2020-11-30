@extends('layout.default')
@section('content')
<div class="container">
<h2>List</h2>
<a class="btn btn-primary" href="{{ url('list/add', [$boardId]) }}">Add New List</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>List Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($lists as $id => $list)
    <tr>
      <td>{{ $id + 1 }}</td>
      <td>{{ $list->name }}</td>
      <td>
        <a href="{{ url('card/view', [$list->id]) }}" class="btn btn-info">View Card</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection