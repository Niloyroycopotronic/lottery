@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Lottery Edit Form Date: {{ $date }}
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
                            <h4 class="card-title">Lottery Edit Fields</h4>
                            {!! displayAlert() !!}
                            <form action="{{ route('ticket.list_edit_post')  }}" method="post" >

                                @csrf

                                <input type="hidden" value="{{ $date }}" name="date" />

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
                                                $old = $list->where('ticket_id', $ticket->id )->where('lottery_id', $value->id)->first();
                                            ?>
                                            
                                            <input type="hidden" value="{{ $old->id }}" name="id[]" />
                                            <input type="hidden" value="{{ $value->value }}" name="value[]" />

                                            <tr>
                                                <td rowspan="3">{{ $value->name }}</td>
                                                <td>
                                                    Today <br>
                                                    <input type="number" value="{{ $old->today }}" name="today[]" data-id="{{ $value->id }}" data-page="{{ $value->page }}" class="today" id="today_{{ $value->id }}" placeholder="Today Number" />
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>
                                                    Last <br>
                                                    <input type="number" readonly value="{{ $old->old }}" name="last[]" id="last_{{ $value->id }}" placeholder="Last Number" />
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    Total <br>
                                                    <input type="text" readonly value="{{ $old->total }}" name="total[]" id="total_{{ $value->id }}" placeholder="Total Number" />
                                                </td>
                                            </tr> 

                                            @endif

                                        @endforeach

                                    @endforeach
                
                                    
                                </tbody>

                                </table>

                                    <div>
                                        <button class="btn btn-info">Update Final Submit</button>
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