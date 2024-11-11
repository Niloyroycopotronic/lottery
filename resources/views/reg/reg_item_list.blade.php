@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Volt Category
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
                            <h4 class="card-title">Rolls List</h4>
                            {!! displayAlert() !!}
                  
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>REG</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($save as  $key => $volt)
                            
                    
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$volt->dates  }}</td>
                            <td>{{$volt->amount  }}</td>

                            <td>
                                <?php
                                $results = DB::table('reg_item_saves')
                                            ->join('regs', 'regs.id', 'reg_item_saves.reg_id' )
                                            ->select(
                                                DB::raw('SUM(amount) as total_amount'),
                                                'regs.name'
                                            )
                                            ->groupBy( 'reg_id')
                                            ->where('dates', $volt->dates)
                                            ->get();
                                ?>
                                @foreach ($results as $item)
                                    {{ $item->name }} : {{ $item->total_amount }} <br>
                                @endforeach
                            </td>
                            
                            <td>
                                <a href="{{ route('reg.item_view_edit', $volt->dates ) }}" class="btn btn-gradient-info">View & Edit</a>
                            </td>
                        </tr>

                           @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                </div>
  </div>
 
  

  
</div>
        
@endsection