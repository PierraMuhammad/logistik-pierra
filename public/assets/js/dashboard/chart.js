createMultipleLineChart = () => {
    $.ajax({
        type: "POST"
        , url: "http://localhost:8000/api/transactions"
        , data: {
            "_token": "{{ csrf_token() }}"
        }
        , success: function(res) {
            let dataProduct = res.data.reduce((acc, item) => {
                let date = createFormatDate(item.created_at)
                let statusKey = item.tp_status ? 'true' : 'false'

                if (!acc[date]) {
                    acc[date] = {
                        true: 0
                        , false: 0
                    };
                }

                acc[date][statusKey]++
                return acc;
            }, {});

            new Chart($("#multipleLineChart")[0].getContext('2d'), {
                type: "line"
                , data: {
                    labels: Object.keys(dataProduct)
                    , datasets: [{
                            label: "Product In"
                            , borderColor: "#1d7af3"
                            , pointBorderColor: "#FFF"
                            , pointBackgroundColor: "#1d7af3"
                            , pointBorderWidth: 2
                            , pointHoverRadius: 4
                            , pointHoverBorderWidth: 1
                            , pointRadius: 4
                            , backgroundColor: "transparent"
                            , fill: true
                            , borderWidth: 2
                            , data: Object.keys(dataProduct).map(date => dataProduct[date].true)
                        , }

                        , {
                            label: "Product Out"
                            , borderColor: "#f3545d"
                            , pointBorderColor: "#FFF"
                            , pointBackgroundColor: "#f3545d"
                            , pointBorderWidth: 2
                            , pointHoverRadius: 4
                            , pointHoverBorderWidth: 1
                            , pointRadius: 4
                            , backgroundColor: "transparent"
                            , fill: true
                            , borderWidth: 2
                            , data: Object.keys(dataProduct).map(date => dataProduct[date].false)
                        , }
                    , ]
                , }
                , options: {
                    responsive: true
                    , maintainAspectRatio: false
                    , legend: {
                        position: "top"
                    , }
                    , tooltips: {
                        bodySpacing: 4
                        , mode: "nearest"
                        , intersect: 0
                        , position: "nearest"
                        , xPadding: 10
                        , yPadding: 10
                        , caretPadding: 10
                    , }
                    , layout: {
                        padding: {
                            left: 15
                            , right: 15
                            , top: 15
                            , bottom: 15
                        }
                    }
                    , scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            , });
        }
    })
}