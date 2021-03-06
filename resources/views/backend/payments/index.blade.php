@extends('layouts.home')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/dash-table.css') }}">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/extras/datatables/css/buttons.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/extras/datatables/css/fixedHeader.bootstrap4.css">
    
    <!-- causes toggle error in navbar -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    {{-- <style type="text/css">
        .dataTable>tbody>tr>td, 
        .dataTable>tbody>tr>th, 
        .dataTable>tfoot>tr>td, 
        .dataTable>tfoot>tr>th, 
        .dataTable>thead>tr>td, 
        .dataTable>thead>tr>th {
            padding: 12px!important;
        }
    </style> --}}
    <title>ExpenseNg - Payments</title>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid ">
            <!-- flash messages  -->
            <!-- ============================================================== -->
                @include('backend.partials.flash')

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header d-md-flex justify-content-between">
                            <h5 class="mb-0" style="float:left">PAYMENTS BY MDAs </h5>
                            @can('add')
                                <a href="{{'/admin/payments/create/'}}" class="btn btn-primary mt-3 section-btn-margin" style="float:right">ADD NEW</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                    <thead>
                                        <tr>
                                        <th>Payment Code</th>
                                        <th>Payment No</th>
                                        <th>Payment Date</th>
                                        <th>Organization</th>
                                        <th>Amount</th>
                                         <th>Description</th>
                                        <th>Beneficiary</th>
                                        @can('manage')
                                        <th>Action</th>
                                        @endcan
                                        </tr>
                                    </thead>
                                    
                                    
                                    <tbody>
                                    @if (count($payments ) > 0)
                                     @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{$payment->payment_code}} </td>
                                            <td>{{$payment->payment_no}} </td>
                                            <td>{{$payment->payment_date}}</td>
                                            <td>{{$payment->organization()}}</td>
                                            <td>₦{{number_format($payment->amount,2)}}</td>
                                            <td>{{$payment->description}}</td>
                                            <td>{{$payment->beneficiary}}</td>
                                            @can('manage')
                                            <td>
                                                @can('edit')
                                                <a href="{{'/admin/payments/edit/' . $payment->id}}"><i class="fa fa-edit" style="color: #00945E"></i></a>
                                                @endcan

                                                @can('delete')
                                                <form method="POST" style="display: inline-flex;" action="{{'/admin/payments/delete/'. $payment->id}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <a type="submit" class="trash delete-payment">
                                                        <i class="fa fa-trash" style="color: red"></i>
                                                    </a>
                                                </form>   
                                                @endcan       
                                            </td>
                                            @endcan
                                    </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                   
                                    <tfoot>
                                        <tr>
                                            <p>Note: You can search and sort payments by payment_no and payment_code</p>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end data table  -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
@endsection

@section('js')

    
    <!-- main js -->
    <script src="{{ asset('js/main-js.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dashboard-ecommerce.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>

  
    <script>
        jQuery(document).ready(function() {
    $('#example').DataTable({
        "order": [[ 2, "desc" ]]
    });
    } );
    </script>
    <script>
        $('.delete-payment').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>
    


@endsection