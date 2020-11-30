@extends('layout.default')
@section('content')
<div class="container">
  <h2>Member</h2>
  <form action="{{ url('board/member/add', [$boardId]) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="label">Member Email:</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter User Email">
      @if ($errors->has('email'))
        <span class="text-danger">
          {{ $errors->first('email') }}
        </span>
      @endif
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ url('board/member/view', [$boardId]) }}" class="btn btn-info">GO Back</a>
  </form>
</div>
@endsection