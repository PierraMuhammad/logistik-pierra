@extends('master')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2">
                    <div>
                        <h2 class="fw-bold mb-0">Storage Form</h2>
                        <h6 class="op-7">Create New Storage</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="storage code" required>
                    <small id="codeHelp" class="form-text text-muted text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="location">location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="storage location" required>
                    <small id="locationHelp" class="form-text text-muted text-danger"></small>
                </div>
                <button class="btn btn-primary ms-2 mt-2" onclick="submitStorage()">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    submitStorage = () => {
        let code = $('#code').val()
        let location = $('#location').val()
        $.ajax({
            type: "POST"
            , url: "http://localhost:8000/api/storages/create"
            , data: {
                "_token": "{{ csrf_token() }}"
                , "code": code
                , "location": location
            }
            , success: function(res) {

            }
        })
    }

</script>
@endpush
