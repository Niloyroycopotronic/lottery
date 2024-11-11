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
                    <h4 class="card-title">Reg Amount Update </h4>
                    <p>Date: {{ $date }}</p>

                     <form action="{{ route('reg.item_view_edit_post') }}" method="post" class="forms-sample" >
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
                                            <?php 
                                                $dd =   $list->where('reg_item_id', $itemi->id)->where('reg_id', $volt->id)->first();
                                            ?>

                                           <td>
                                            <input type="hidden" name="id[]" value="{{ $dd ? $dd->id : null }}">
                                                <input 
                                                    type="number"
                                                    step="1"
                                                    value="{{ $dd ? $dd->amount : 0 }}" 
                                                     
                                                    name="count[]" 
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
                                            <span id="total_{{ $volt->id }}" class="total_reg">{{ $list->where('reg_id', $volt->id)->sum('amount') }}</span>
                                        </td>
                                    @endforeach

                                 </tr>


                            </tbody>
                        </table>
                        <div class="text-center pt-3">

                            <p>All Reg Total: <span id="total_amount" >{{ $list->sum('amount') }}</span></p>
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                        </div>
                     
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
