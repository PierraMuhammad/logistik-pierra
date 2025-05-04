@extends('master')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2">
                    <div>
                        <h2 class="fw-bold mb-0">Product Out Form</h2>
                        <h6 class="op-7">Product comes out from storage</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Select</label>
                    <select id="select-state" placeholder="Pick a state...">

                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" placeholder="product quantity" name="quantity">
                    <small id="product-message-quantity" class="text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="name">Destination</label>
                    <input type="text" class="form-control" id="origin" placeholder="product origin" name="origin">
                </div>

                <button class="btn btn-primary ms-2 mt-2" onclick="submitProduct()">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/js/transaction/formOut.js')}}"></script>
<script>
    $('.nav-item').removeClass('active')
    $('#transaction-page').addClass('active')

    getData()

</script>
@endpush
