@extends('layout.default')
@section('content')
<div class="container">
  <h2>Cards</h2>
  <a class="btn btn-primary" href="{{ url('bug-report/add') }}">Add New Card</a>
  {{-- url('card/add', [$listId]) --}}
  <div class="row mt-3">
    @foreach($cards as $id => $card)
    <div class="col-sm-6 mb-3">
      <div class="card">
        @if (!empty($card->cover_image_url))
            <img class="card-img-top" src="{{ $card->cover_image_url }}" alt="Card image cap">
        @endif
        <div class="card-header">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-label-{{ $id }}">
            Add Label
          </button>
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#due-date-{{ $id }}">
            Add Due Date
          </button>
        </div>
        <div class="card-body">
          @foreach($card->labels as $label)
            <span class="badge badge-secondary bg-{{ $label->color }} {{ $label->name == '' ? 'badge-empty' : '' }}">
              {{ $label->name }}
            </span>
          @endforeach
          <h5 class="card-title">{{ $card->name }}</h5>
          <p class="card-text">{!! $card->desc !!}</p>
          <p class="card-text">
            Due Date:
            {{ $card->due }}
          </p>
        </div>
      </div>
    </div>
    <!-- Color Modal -->
    <div class="modal fade" id="add-label-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="add-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{ url('card/label/add', [$card->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">add Label to Card</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container">
                
                <input type="hidden" id="board-id" name="board-id" value="{{ $card->idBoard }}">
                <input type="hidden" id="list-id" name="list-id" value="{{ $listId }}">
                <div class="form-group">
                  <label for="color">Color</label>
                  <select class="form-control" id="color" name="color">
                      <option value="">Select Color</option>
                      @foreach($boardLabels as $boardLabel)
                          <option class="badge badge-secondary bg-{{ $boardLabel->color }} {{ $boardLabel->name == '' ? 'badge-empty' : '' }}" value="{{ $boardLabel->id }}">
                              {{ $boardLabel->name }}
                          </option>
                      @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Color Modal -->
    <!-- Due Date Modal -->
    <div class="modal fade" id="due-date-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="add-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{ url('card/due-date', [$card->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">add Due Date to Card</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container">
                <input type="hidden" id="board-id" name="board-id" value="{{ $card->idBoard }}">
                <input type="hidden" id="list-id" name="list-id" value="{{ $listId }}">
                <div class="form-group">
                  <label for="color">Date</label>
                  <input type="date" id="date" name="date">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Color Modal -->
    @endforeach
  </div>
</div>
@endsection