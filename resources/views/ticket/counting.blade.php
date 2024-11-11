@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Lottery List
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Lottery <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    
                    
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Lottery Input Fields</h4>
                            {!! displayAlert() !!}
                            <form action="{{ route('ticket.counting_post')  }}" method="post" >

                                @csrf

                                <table class="table">
                                <thead>
                                    <tr>
                                    <th>Lottery Category</th>
                                    <th>Lottery</th>
                                    <th>Tickets Number</th>
                                    </tr>
                                </thead>
                                
                                <tbody>

                                    @foreach ($tickets as $item => $ticket)
                                        
                                        <?php
                                        $count  = $lottery->where('ticket_id', $ticket->id)->count();
                                        ?>
                                    
                                        <tr>
                                            <td rowspan="{{ ( $count * 3 ) + 1 }} "> {{ $ticket->name }}</td>
                                        </tr>
                                    
                                        @foreach ($lottery as $key => $value)

                                            @if ($value->ticket_id == $ticket->id)
                                            <?php
                                                $old = DB::table('last_data')->where(['ticket_id' => $ticket->id, 'lottery_id' => $value->id ])->orderBy('id', 'desc')->limit(1)->first();
                                            ?>
                                            
                                            <input type="hidden" value="{{ $ticket->id }}" name="ticket[]" />
                                            <input type="hidden" value="{{ $value->id }}" name="lottery[]" />
                                            <input type="hidden" value="{{ $old->id }}"   name="old[]" />
                                            <input type="hidden" value="{{ $old->amount }}" name="old_amount[]" />
                                            <input type="hidden" value="{{ $value->value }}" name="value[]" />

                                            <tr>
                                                <td rowspan="3">{{ $value->name }}</td>
                                                <td>
                                                    Today <br>
                                                    <input type="number" value="0" name="today[]" data-id="{{ $value->id }}" data-page="{{ $value->page }}" class="today" id="today_{{ $value->id }}" placeholder="Today Number" />
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    Last <br>
                                                    <input type="number" readonly value="{{ $old->amount }}" name="last[]" id="last_{{ $value->id }}" placeholder="Last Number" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Total <br>
                                                    <input type="text" readonly value="0" name="total[]" id="total_{{ $value->id }}" placeholder="Total Number" />
                                                </td>
                                            </tr> 

                                            @endif

                                        @endforeach

                                    @endforeach
                
                                    
                                </tbody>

                                </table>

                                    <div>
                                        <button class="btn btn-info">Final Submit</button>
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

      $('.today').keyup(function(){

        var id =  $(this).data('id');

        var value = parseInt( $(this).val() );
        var page =  parseInt( $(this).data('page') );

        var last = parseInt( $( '#last_'+ id ).val() );
     


        if( value >= last ){
            var set = value - last;
            $( '#total_'+ id ).val( set );

        }else{

             var withpage = value +  page;
             var set = withpage - last;

            $( '#total_'+ id ).val( set );
            
        }


        
       

      });


       

    </script>
@endpush