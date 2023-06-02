@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="font-weight-bold">Add New Employee</h5>
                @livewire('employee-wire')
            </div>  
        </div>  
    </div>
</div>
@endsection