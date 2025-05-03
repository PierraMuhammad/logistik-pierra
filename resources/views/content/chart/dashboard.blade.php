@extends('master')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Time - Transaction Chart (Many Transaction in a day)</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="multipleLineChart" width="481" height="375" style="display: block; height: 300px; width: 385px;" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Total Product</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="doughnutChart" style="width: 385px; height: 300px; display: block;" width="481" height="375" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2">
                        <div>
                            <h3 class="fw-bold mb-0">Transaction Table</h3>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            <a href="/transaction/formIn" class="btn btn-primary btn-round">Product In</a>
                            <a href="/transaction/formOut" class="btn btn-danger btn-round ms-2">Product Out</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="basic-datatables" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="basic-datatables_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-sort="ascending" style="width: 20%">Shipping Code</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 20%">Product Code</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 10%">Quantity</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 10%">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 20%">Origin / Destination</th>
                                                <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" style="width: 20%">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-table-body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('assets/js/helper/helper.js')}}"></script>
<script src="{{asset('assets/js/transaction/table.js')}}"></script>
<script>
    $('.nav-item').removeClass('active')
    $('#transaction-page').addClass('active')

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
                        , }
                    , }
                , });
            }
        })
    }

    getData()
    createMultipleLineChart()

</script>
@endpush
