getData = () => {
    $.ajax({
        type: "GET"
        , url: "http://localhost:8000/api/products"
        , data: {
            "_token": "{{ csrf_token() }}"
        }
        , success: function(res) {
            res.data.map((item, key) => {
                if (key % 2 == 0) {
                    $('#product-table-body').append(`
                        <tr role="row" class="even">
                            <td class="sorting_1">${item.product_code}</td>
                            <td>${item.product_name}</td>
                            <td>${item.product_quantity} pieces</td>
                        </tr>
                    `)
                } else {
                    $('#product-table-body').append(`
                        <tr role="row" class="odd">
                            <td class="sorting_1">${item.product_code}</td>
                            <td>${item.product_name}</td>
                            <td>${item.product_quantity} pieces</td>
                        </tr>
                    `)
                }
            })
            if(res.data.length < 10){
                $("#basic-datatables").DataTable({
                    pageLength : res.data.length
                });
            } else {
                $("#basic-datatables").DataTable({});
            }
        }
    })
}