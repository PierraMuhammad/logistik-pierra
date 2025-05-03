

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
            , url: "http://127.0.0.1:8000/api/transactions/in"
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
            , url: "http://127.0.0.1:8000/api/transactions/in"
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