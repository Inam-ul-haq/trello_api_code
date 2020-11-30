@extends('layout.default')
@section('content')
<div class="container">
  <h2>List</h2>
  <form action="{{ url('list/add', [$boardId]) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="email">List Name:</label>
      <input type="text" class="form-control" id="list" placeholder="Enter List Name" name="list">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ url('list/view', [$boardId]) }}" class="btn btn-info">GO Back</a>
  </form>
</div>
@endsection