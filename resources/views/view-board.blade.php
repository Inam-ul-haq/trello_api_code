@extends('layout.default')
@section('content')
<div class="container">
<h2>Project Name</h2>
<a class="btn btn-primary" href="{{ url('board/add') }}">Add New Project</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Project Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($boards as $id => $board)
    <tr>
      <td>{{ $id + 1 }}</td>
      <td>{{ $board->name }}</td>
      <td>
        <a href="{{ url('list/view', [$board->id]) }}" class="btn btn-info">View List</a>
        <a href="{{ url('board/label/view', [$board->id]) }}" class="btn btn-secondary">View Label</a>
        <a href="{{ url('board/member/view', [$board->id]) }}" class="btn btn-info">View Member</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection