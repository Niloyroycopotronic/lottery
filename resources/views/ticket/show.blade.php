@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Ticket {{ $ticket->name }}, Price {{ $ticket->value }}
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Ticket <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
     <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Filter Your Tickets</h4>
                
                    <form class="forms-sample" method="get" action="{{ route('ticket_name.filter') }}">
                        @csrf

                      <div class="form-group">
                        <label for="exampleInputUsername1">Ticket Category</label>
                        <select name="ticket_id" id="" required class="form-control">
                            <option value="">Select Ticket Category</option>
                            
                            @foreach ($all_ticket as $item)
                                 <option value="{{ $item->id }}" {{ $ticket->id === $item->id ? 'selected':''  }}>{{ $item->name }}</option>
                            @endforeach

                        </select>
                      </div>
                     
                
                      <button type="submit" class="btn btn-gradient-primary me-2">Filter</button>
                   
                    </form>
                  </div>
                </div>
              </div>
                <div class="col-md-8 grid-margin stretch-card">
                    
                    
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ticket List</h4>
                            {!! displayAlert() !!}
                  
                    <table class="table">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Category</th>
                          <th>Name</th>
                          <th>Value</th>
                          <th>Pages</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($ticketname as  $key => $volt)
                            
                    
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{$volt->ticket->name  }}</td>
                            <td>{{$volt->name  }}</td>
                            <td>{{$volt->value  }}</td>
                            <td>{{$volt->page  }}</td>
                            <td>{{$volt->status->getLebelText()  }}</td>
                            <td>
                                {{-- <a href="{{ route('ticket.show', $volt->id) }}" class="btn  btn-gradient-info">View AA</a> --}}

                                <a href="{{ route('ticket_name.edit', $volt->id) }}" class="btn  btn-gradient-success">Edit</a>
                                <form action="{{ route('ticket_name.destroy', $volt->id)}}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn  btn-gradient-danger" type="submit">Delete</button>
                                </form>
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