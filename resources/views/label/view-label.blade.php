@extends('layout.default')
@section('content')
<div class="container">
<h2>Labels</h2>
<a class="btn btn-primary mb-3" href="{{ url('board/label/add', [$boardId]) }}">Add New Label</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Labels</th>
    </tr>
  </thead>
  <tbody>
    @foreach($labels as $id => $label)
    <tr>
      <td>{{ $id + 1 }}</td>
      <td>
        <span id="{{ $label->id }}" class="badge badge-secondary bg-{{ $label->color }} {{ $label->name == '' ? 'badge-empty' : '' }}">
            {{ $label->name }}
        </span>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection