@extends('layout.default')
@section('content')
<div class="container">
  <h2>Project</h2>
  <form action="{{ url('board/add') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="email">Project Name:</label>
      <input type="text" class="form-control" id="board" placeholder="Enter Project Name" name="board">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ url('board/view') }}" class="btn btn-info">GO Back</a>
  </form>
</div>
@endsection