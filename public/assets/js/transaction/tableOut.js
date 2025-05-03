getData = () => {
    $.ajax({
        type: "POST"
        , url: "http://localhost:8000/api/transactions/tableOut"
        , data: {
            "_token": "{{ csrf_token() }}"
        }
        , success: function(res) {
            res.data.map((item, key) => {
                let formatDate = createFormatDate(item.created_at)
                if (key % 2 == 0) {
                    $('#product-table-body').append(`<tr role="row" class="even">
                        <td class="sorting_1">${item.tp_status_id}</td>
                        <td>${item.tp_product_code}</td>
                        <td>${item.tp_quantity} pieces</td>
                        <td>${item.tp_storage_location}</td>
                        <td>${formatDate}</td>    
                    </tr>
                    `)
                } else {
                    $('#product-table-body').append(`<tr role="row" class="odd">
                        <td class="sorting_1">${item.tp_status_id}</td>
                        <td>${item.tp_product_code}</td>
                        <td>${item.tp_quantity} pieces</td>
                        <td>${item.tp_storage_location}</td>
                        <td>${formatDate}</td>
                    </tr>`)
                }

            })
            if (res.data.length < 10) {
                $("#basic-datatables").DataTable({
                    pageLength: res.data.length
                });
            } else {
                $("#basic-datatables").DataTable({});
            }
        }
    })
}