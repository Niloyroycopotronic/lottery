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
                          {{-- <th>Created</th> --}}
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($volts as  $key => $volt)
                            
                    
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$volt->date  }}</td>
                            <td>{{$volt->amount  }}</td>
                            
                            <td>
                                <a href="{{ route('volt.roll_list_edit', $volt->date ) }}" class="btn btn-info">Edit</a>
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