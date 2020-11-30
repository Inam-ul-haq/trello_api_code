@extends('layout.default')
@section('content')
<div class="container">
  <h2>Card</h2>
  <form action="{{ url('card/add', [$listId]) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="card">List Card:</label>
      <input type="text" class="form-control" id="card" placeholder="Enter Card Name" name="card">
    </div>
    <div class="form-group">
      <label for="description">Description:</label>
      <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ url('card/view', [$listId]) }}" class="btn btn-info">GO Back</a>
  </form>
</div>
@endsection