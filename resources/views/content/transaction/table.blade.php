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
                        <h2 class="fw-bold mb-0">Transaction Table</h2>
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
@endsection

@push('script')
<script src="{{asset('assets/js/helper/helper.js')}}"></script>
<script src="{{asset('assets/js/transaction/table.js')}}"></script>
<script>
    $('.nav-item').removeClass('active')
    $('#transaction-page').addClass('active')

    getData()

</script>
@endpush
