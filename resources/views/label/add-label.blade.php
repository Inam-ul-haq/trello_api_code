@extends('layout.default')
@section('content')
<div class="container">
  <h2>List</h2>
  <form action="{{ url('board/label/add', [$boardId]) }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="label">Label Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Label Name" name="name">
      @if ($errors->has('name'))
        <span class="text-danger">
          {{ $errors->first('name') }}
        </span>
      @endif
    </div>
    <div class="form-group">
        <label for="color">Color</label>
        <select class="form-control" id="color" name="color">
            <option value="">Select Color</option>
            @foreach($colors as $color)
                <option value="{{ $color }}">{{ $color }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ url('board/label/view', [$boardId]) }}" class="btn btn-info">GO Back</a>
  </form>
</div>
@endsection