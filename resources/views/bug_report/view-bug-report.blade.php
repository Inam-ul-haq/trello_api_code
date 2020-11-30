@extends('layout.default')
@section('content')


          <div class="container mt-3">
            <span class="font-weight-bold">Bug Report</span>
          </div>
       <!-- 
          <div class="container mt-3">
              @if ($isAdmin == "admin")
            <div class="main row">
                <div class="col-md-6 form-group has-search">
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control shadowcustom2" placeholder="Search">
                </div>
             
            </div>
              <br>
          
               @endif
          </div> -->
            @if ($isAdmin == "user")
           <div class="container mt-3">
            <div class="main row">
                <div class="col-md-6 form-group has-search">
                    
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-primary btn-lg {{ Request::is('bug-report/view') ? 'active' : '' }}">  <a class="nav-link" href="{{ url('bug-report/view/user') }}"><span>View Bug</span> </a></button>
                    <button type="button" class="btn btn-success btn-lg ml-2 {{ Request::is('bug-report/add') ? 'active' : '' }}"> <a class="nav-link" href="{{ url('bug-report/add/user') }}">
                            Add  Bug
                        </a></button>

                </div>
            </div>
          </div>
          @endif

          <div class="container mt-3">
            <table class="table table-borderless bg-white">
                  <tr class="shadowcustom text-center">
                    <th scope="col">Issue Name</th>
                    <th scope="col">Issue Number</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Description</th>
                 
                    <th scope="col">Reported Date</th>
                    <th scope="col">Reported Name</th>
                      @if ($isAdmin == "admin")
                    <th scope="col">Member</th>
                     <th scope="col">Action</th>
                     @endif
                  </tr>
                <tbody>
                 @foreach($array as $key => $value)
                 @if(($key % 2) !=0)
                 <tr class="text-muted text-center shadowcustom">
                    <td>{{$value[7]}}</td>
                    <td>{{$value[0]}}</td>
                    <td>{{$value[1]}}</td>
                    <td >{{$value[2]}}</td>
                    <td>{{$value[3]}}</td>
                     <td>{{$value[4]}}</td>
                    @if ($isAdmin == "admin")
                    <td>
                      @foreach($value[5] as $member)
                        Member: {{ $membersMap[$member] }}
                      @endforeach
                    </td>
                   
                    <td>
                       <div class="row">
    <div class="col-md-6">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#due-date-{{ $value[6] }}">  Add  Date </button>
    </div>
    <div class="col-md-6">
      <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#assign-to-{{ $value[6] }}">  Assign To</button>
    </div>
  </div>
                     
                   
                  </td>
                  @endif
                  </tr>
                 @else
                 <tr class="text-muted text-center">
                    <td>{{$value[7]}}</td>
                    <td>{{$value[0]}}</td>
                    <td>{{$value[1]}}</td>
                    <td>{{$value[2]}}</td>
                    <td>{{$value[3]}}</td>
                     <td>{{$value[4]}}</td>
                    @if ($isAdmin == "admin")
                    <td>
                      @foreach($value[5] as $member)
                        Member: {{ $membersMap[$member] }}
                      @endforeach
                    </td>
                   
                    <td><div class="row">
    <div class="col-md-6">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#due-date-{{ $value[6] }}">  Add  Date </button>
    </div>
    <div class="col-md-6">
      <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#assign-to-{{ $value[6] }}">  Assign To</button>
    </div></td>@endif
                  </tr>
                 @endif
                  
                       
                        @foreach($cards as $id => $card)

                    <div class="modal fade" id="add-label-{{ $card->id}}" tabindex="-1" role="dialog" aria-labelledby="add-label" aria-hidden="true">
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
    <div class="modal fade" id="due-date-{{ $card->id}}" tabindex="-1" role="dialog" aria-labelledby="add-label" aria-hidden="true">
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
    <!-- Member Modal -->
    <div class="modal fade" id="assign-to-{{ $value[6] }}" tabindex="-1" role="dialog" aria-labelledby="add-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{ url('card/assign-to', [ $value[6]]) }}" method="post">
            {{ csrf_field() }}
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Assign To</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container">
                <input type="hidden" id="board-id" name="board-id" value="{{ $card->idBoard }}">
                <input type="hidden" id="list-id" name="list-id" value="{{ $listId }}">
                <div class="form-group">
                  <label for="color">Assign To</label>
                  <select class="form-control" id="member" name="member">
                    @foreach($members as $key => $mem)
                        <option value="{{ $mem->id }}">{{ $mem->fullName }}</option>
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
        @endforeach
         @endforeach
                </tbody>
              </table>
          </div>
          





@endsection