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
                        <h2 class="fw-bold mb-0">Product In Form</h2>
                        <h6 class="op-7">Product comes in to storage</h6>
                        <div class="form-check mb-0 pb-0">
                            <input class="form-check-input" type="checkbox" value="0" id="newProduct" onclick="getCheckValue()">
                            <label class="form-check-label mb-0 pb-0" for="newProduct">
                                New Product
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.nav-item').removeClass('active')
    $('#transaction-page').addClass('active')

    products = []

    getCheckValue = () => {
        if ($('#newProduct').is(":checked")) {
            $('.card-body').html('')
            $('.card-body').append(`
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="product name" name="name">
                </div>
                <div class="form-group">
                    <label for="name">Code</label>
                    <input type="text" class="form-control" id="code" placeholder="product code" name="code">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" placeholder="product quantity" name="quantity">
                </div>
                <div class="form-group">
                    <label for="name">Origin</label>
                    <input type="text" class="form-control" id="origin" placeholder="product origin" name="origin">
                </div>

                <button class="btn btn-primary ms-2" onclick="submitNewProduct()">Submit</button>
            `)
        } else {
            $('.card-body').html('')
            $('.card-body').append(`
                <div class="form-group">
                    <label>Select</label>
                    <select id="select-state" placeholder="Pick a state...">
                        
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" id="quantity" placeholder="product quantity" name="quantity">
                    <small id="product-message-quantity"></small>
                </div>
                <div class="form-group">
                    <label for="name">Origin</label>
                    <input type="text" class="form-control" id="origin" placeholder="product origin" name="origin">
                </div>

                <button class="btn btn-primary ms-2 mt-2" onclick="updateProduct()">Submit</button>
            `)
            products.map((item, key) => {
                $('#select-state').append(`
                    <option value="${item.product_id}">${item.product_code} - ${item.product_name}; quantity : ${item.product_quantity}</option>
                `)
            })
            $('select').selectize({
                sortField: 'text'
            });
        }
    }

    getData = () => {
        $.ajax({
            type: "GET"
            , url: "http://127.0.0.1:8000/api/products"
            , data: {
                "_token": "{{ csrf_token() }}"
            }
            , success: function(res) {
                products = res.data
                getCheckValue()
            }
        })
    }

    getData()

    getProduct = (id) => {
        let selectedProduct = false

        products.map((item) => {
            if (item.product_id == id) {
                selectedProduct = item
            }
        })

        return selectedProduct
    }

    submitNewProduct = () => {
        let name = $('#name').val()
        let code = $('#code').val()
        let quantity = $('#quantity').val()
        let origin = $('#origin').val().toLowerCase()

        $.ajax({
            type: "POST"
            , url: "http://127.0.0.1:8000/api/transactions/formIn"
            , data: {
                "_token": "{{ csrf_token() }}"
                , "name": name
                , "code": code
                , "quantity": quantity
                , 'origin': origin
            }
            , success: function(res) {
                window.location.href = "http://localhost:8000/transaction"
            }
        })
    }

    updateProduct = () => {
        let id = $('#select-state').val()
        let quantity = $('#quantity').val()
        let origin = $('#origin').val().toLowerCase()
        console.log(id, quantity, origin)

        let product = getProduct(id)
        if (!product) {
            return false
        }

        $.ajax({
            type: "POST"
            , url: "http://127.0.0.1:8000/api/transactions/formIn"
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
                , "quantity": quantity
                , 'origin': origin
            , }
            , success: function(res) {
                window.location.href = "http://localhost:8000/transaction"
            }
        })
    }

</script>
@endpush
