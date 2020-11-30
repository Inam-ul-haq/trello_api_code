@extends('layout.default')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

      <div class="container mt-3">
        <span class="font-weight-bold">Bug Report</span>
         @if(Session::has('message'))
        <p class="alert alert-danger">{{ Session::get('message') }}</p>
        @endif
      </div>
        <div class="container border-top rounded mt-3 bg-white">
      <form action="{{ url('bug-report/add/false') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group d-none">
        <label for="project">Project:</label>
        <select class="form-control" id="project" name="project">
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
            
            <div class="form-row mt-4 pl-4">
              <div class="form-group col-md-6 font-weight-bold">
                <label for="name">Issue Title</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Issue Title" name="name">
              </div>
              <div class="form-group col-md-6 pr-4 font-weight-bold">
                <label for="priority">Priority</label>
              
                <select class="form-control" id="priority" name="priority">
                <option value="">Select Priority</option>
                @foreach($priority as $prior)
                    <option value="{{ $prior }}">{{ $prior }}</option>
                @endforeach
                </select>
                @if ($errors->has('priority'))
                    <span class="text-danger">
                        {{ $errors->first('priority') }}
                    </span>
                @endif
              </div>
            </div>
            <div class="form-group pl-4 pr-4 font-weight-bold">
              <label for="description">Issue Description</label>
              <textarea class="form-control" placeholder="Enter Description" id="description" name="description"  rows="3"></textarea>
            </div>
            <div class="form-row font-weight-bold pl-4">
              <div class="form-group col-md-6">
                <label for="Reporter Name">Reporter Name</label>
                <input type="text" class="form-control" id="reporter_name" placeholder="Reporter Name" name="reporter_name">
                @if ($errors->has('reporter_name'))
                    <span class="text-danger">
                      {{ $errors->first('reporter_name') }}
                    </span>
                  @endif
              </div>
              <div class="form-group col-md-6 pr-4 font-weight-bold">
                <label for="url">Bug Url(Optional)</label>
                <input type="url" class="form-control" id="url" placeholder="Enter Url" name="url">
              </div>
              <label class="font-weight-bold pl-1" for="file">Choose Image</label>
            </div>
            <div class="upload">
                <input type="file"  accept="image/*"  id="fileUpload" name="file" />
                <span class="fileName">Choose File</span>
            </div>
            <input type="button" class="uploadButton" value="Upload" />
            <div class="mt-3 mb-5 pl-4 pr-4">
              <button id="button" type="submit" class="btn btn-lg btn-block">SUBMIT</button>
            </div>
          </form>
        </div>


     <!--    <div class="container">
  <h2>Bug Report</h2>
  @if(Session::has('message'))
    <p class="alert alert-danger">{{ Session::get('message') }}</p>
  @endif
  <form action="{{ url('bug-report/add/false') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group d-none">
        <label for="project">Project:</label>
        <select class="form-control" id="project" name="project">
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
      <label for="name">Issue Title:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Issue Title" name="name">
    </div>
    <div class="form-group">
        <label for="priority">Priority</label>
        <select class="form-control" id="priority" name="priority">
            <option value="">Select Priority</option>
            @foreach($priority as $prior)
                <option value="{{ $prior }}">{{ $prior }}</option>
            @endforeach
        </select>
        @if ($errors->has('priority'))
            <span class="text-danger">
                {{ $errors->first('priority') }}
            </span>
        @endif
    </div>
    <div class="form-group">
      <label for="">Goal:</label>
      <textarea class="form-control" id="" name="" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="description">Issue Description:</label>
      <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="reporter">Reporter Name:</label>
      <input type="text" class="form-control" id="reporter_name" placeholder="Reporter Name" name="reporter_name">
      @if ($errors->has('reporter_name'))
        <span class="text-danger">
          {{ $errors->first('reporter_name') }}
        </span>
      @endif
    </div>
    <div class="form-group">
      <label for="error_message">Error Message:</label>
      <textarea class="form-control" id="error_message" name="error_message" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="file">choose image</label>
        <input type="file" class="form-control-file" id="file" name="file">
    </div>
    <div class="form-group">
      <label for="url">Bug Url (optional):</label>
      <input type="url" class="form-control" id="url" placeholder="Enter Url" name="url">
    </div>
    <div class="form-group">
      <label for="name">Reported Date:</label>
      <input type="date" class="form-control" id="date" placeholder="Select Date" name="date">
    </div>
    <div class="form-group">
        <label for="bug_type">Bug Type</label>
        <select class="form-control" id="bug_type" name="bug_type[]" multiple="multiple">
            <option value="">Select Bug Type</option>
            @foreach($bugType as $bug)
                <option value="{{ $bug->id }}">{{ $bug->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="label">Label</label>
        <select class="form-control" id="label" name="label[]" multiple="multiple">
            <option value="">Select Label</option>
            @foreach($labels as $label)
                <option value="{{ $label->id }}">{{ $label->color }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div> -->
@push('scripts')
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(function() {
            // $('#label, #bug_type').select2();
            // $("#project").change(function() {
            //     var id = $(this).val();
            //     var urlLabels = `{{ url('bug-report/labels/') }}/${id}`;
            //     $.get(urlLabels, function(e) {
            //         console.log(e);
            //         // if (e) {
            //             $("#label").html(e).select2();
            //         // }
            //     });

            //     var urlBugType = `{{ url('bug-report/bug-type/') }}/${id}`;
            //     $.get(urlBugType, function(e) {
            //         // console.log(e);
            //         // if (e) {
            //             $("#bug_type").html(e).select2();
            //         // }
            //     });
            // });
        });
    </script>
@endpush
@endsection