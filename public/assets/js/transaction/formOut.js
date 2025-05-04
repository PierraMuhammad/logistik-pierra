let products = []

getData = () => {
    $.ajax({
        type: "GET"
        , url: "http://localhost:8000/api/products"
        , data: {
            "_token": "{{ csrf_token() }}"
        }
        , success: function(res) {
            products = res.data
            res.data.map((item, key) => {
                $('#select-state').append(`
                <option value="${item.product_id}">${item.product_code} - ${item.product_name}; quantity : ${item.product_quantity}</option>
            `)
            })
            $('select').selectize({
                sortField: 'text'
            });
        }
    })
}

getProduct = (id) => {
    let selectedProduct = false

    products.map((item) => {
        if (item.product_id == id) {
            selectedProduct = item
        }
    })

    return selectedProduct
}

submitProduct = () => {
    let id = $('#select-state').val()
    let quantity = $('#quantity').val()
    let origin = $('#origin').val().toLowerCase()
    console.log(id, quantity, origin)

    let product = getProduct(id)
    if (!product) {
        return false
    }

    $('#product-message-quantity').text('')
    if (product.product_quantity - quantity < 0) {
        $('#product-message-quantity').text('product quantity can not be lower than 0')
        return false
    }

    $.ajax({
        type: "POST"
        , url: "http://localhost:8000/api/transactions/formOut"
        , data: {
            "_token": "{{ csrf_token() }}"
            , "id": id
            , "quantity": quantity
            , 'origin': origin
        , }
        , success: function(res) {
            window.location.href = "http://localhost:8000/"
        }
    })
}