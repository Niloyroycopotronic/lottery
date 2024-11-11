@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Roll Amount
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Volt <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>



  <div class="row">
     <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Rolls Amount Add </h4>
                    <p>Date: {{ date('Y-m-d') }}</p>

                     <form action="{{ route('volt.roll_input_post') }}" method="post" class="forms-sample" >
                        @csrf
                        @foreach ($volts as  $key => $volt)
                            <div class="form-group row">

                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ $volt->name }} ( {{ $volt->value }} )</label>

                                <div class="col-sm-5">
                                    <input type="hidden"  name="id[]"  value="{{ $volt->id }}" >
                                    <input type="hidden"  name="value[]"  value="{{ $volt->value }}" >

                                    <input type="number" step="1" value="0" name="count[]" data-id="{{ $volt->id }}" data-value="{{ $volt->value }}" required class="form-control count" id="exampleInputUsername2" placeholder="Amount" >
                                </div>

                                <div class="col-sm-4">
                                    <input type="number" readonly required value="0" name='amount[]' class="form-control total amount_{{ $volt->id }}" id="exampleInputUsername2" placeholder="Total">
                                </div>

                            </div>
                        @endforeach
                      <p>Total Amount: <span class="font-weight-bold" id="total_amount" ></span></p>
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                     
                    </form>
                  </div>
                </div>
              </div>
                
    </div>
</div>
 
        
@endsection
@push('script')
    <script type="text/javascript" >
    
        $('.count').keyup(function(){
            var id = $(this).data('id');
            var value = $(this).data('value');
            var count = $(this).val();
            $('.amount_' + id ).val(value * count);

            totalAmount();
        });

        function totalAmount(){
            
            var sum = 0;
            $('.total').each(function(){
                sum += parseFloat($(this).val());

            });
        
            $('#total_amount').text(sum);

        }

    </script>
@endpush
