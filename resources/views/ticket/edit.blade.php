@extends('layouts.admin_layout')

@section('admin_content')
        
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Ticket Category
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
     <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Tickets Edit</h4>
                
                    <form class="forms-sample" method="post" action="{{ route('ticket.update', $ticket->id) }}">
                        @csrf
                        @method('put')

                      <div class="form-group">
                        <label for="exampleInputUsername1">Name</label>
                        <input type="text" required class="form-control" value="{{ $ticket->name  }}" name="item" id="exampleInputUsername1" placeholder="Item Name">
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputUsername11">Value</label>
                        <input type="number" step="0.01" required class="form-control" name="value"  value="{{ $ticket->value  }}" id="exampleInputUsername11" placeholder="Item Value">
                      </div>
                
                      <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                   
                    </form>
                  </div>
                </div>
              </div>
                
  </div>
 
  

  
</div>
        
@endsection