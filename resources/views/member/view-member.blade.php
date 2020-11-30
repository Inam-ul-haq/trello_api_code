@extends('layout.default')
@section('content')
<div class="container">
<h2>Members</h2>
<a class="btn btn-primary mb-3" href="{{ url('board/member/add', [$boardId]) }}">Add New Member</a>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Fullname</th>
    </tr>
  </thead>
  <tbody>
    @foreach($members as $id => $member)
    <tr>
      <td>{{ $id + 1 }}</td>
      <td>
        {{ $member->username }}
      </td>
      <td>
        {{ $member->fullName }}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection