@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Reg Amount
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Reg <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>



  <div class="row">
     <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Reg Amount Input </h4>
                    <p>Date: {{ date('Y-m-d') }}</p>

                     <form action="{{ route('reg.reg_input_post') }}" method="post" class="forms-sample" >
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Name</td>
                                    @foreach ($reg as  $key => $volt)
                                        <td>{{ $volt->name }}</td>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item as  $keyi => $itemi)
                                    <tr>
                                        <td>
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{ $itemi->name }} ( {{ $itemi->value }} )</label>
                                        </td>
                                        @foreach ($reg as  $key => $volt)
                                           <td>
                                            <input type="hidden" name="value[{{ $itemi->id }}]"  value="{{ $itemi->value }}" >
                                                <input 
                                                    type="number"
                                                    step="1"
                                                    value="0" 
                                                    name="count[{{ $itemi->id }}][{{ $volt->id }}]" 
                                                    data-id="{{ $volt->id }}" 
                                                    data-value="{{ $itemi->value }}" 
                                                    required
                                                    class="form-control count addision_{{ $volt->id }}" 
                                                    id="exampleInputUsername2" 
                                                    placeholder="Amount" 
                                                >
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach


                                 <tr>
                                    <td>Total</td>
                                    
                                    @foreach ($reg as  $key => $volt)
                                        <td>
                                            <span id="total_{{ $volt->id }}" class="total_reg">0</span>
                                        </td>
                                    @endforeach

                                 </tr>


                            </tbody>
                        </table>
                        <p>All Reg Total: <span id="total_amount" ></span></p>
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
            var count = $(this).val();
            var value = $(this).data('value');

             totalAmount(id);
        });

        function totalAmount(id){
            
            var sum = 0;
            $('.addision_' + id ).each(function(){
                sum += parseFloat( $(this).val() );

            });

            $('#total_' + id ).text(sum);


            var sum_total = 0;
            $('.total_reg').each(function(){
                sum_total += parseFloat( $(this).text() );

            });

            $('#total_amount').text(sum_total);

        }

    </script>
@endpush
