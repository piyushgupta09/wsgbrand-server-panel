@extends('panel::datatable')

@section('dashboard-content')
    
    @push('page-title')
        Dashboard
    @endpush

    <div class="row">

        <div class="col-md-4">
            <div class="card rounded-0 shadow-none" style="border-left: solid #3a8e94 10px;">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="font-title fs-4 fw-bold">{{ App\Models\User::count() }}</div>
                        <div class="font-subtitle">New Users</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-4">
            <div class="card rounded-0 shadow-none" style="border-left: solid #3a8e94 10px;">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="font-title fs-4 fw-bold">{{ App\Models\Product::count() }}</div>
                        <div class="font-subtitle">Total Products</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card rounded-0 shadow-none" style="border-left: solid #3a8e94 10px;">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="font-title fs-4 fw-bold">{{ Fpaipl\Shopy\Models\Order::where('status', 'pending')->count() }}</div>
                        <div class="font-subtitle">New Orders</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-0 shadow-none" style="border-left: solid #3a8e94 10px;">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="font-title fs-4 fw-bold">{{ Fpaipl\Shopy\Models\Order::where('status', 'proccessing')->count() }}</div>
                        <div class="font-subtitle">Running Orders</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-0 shadow-none" style="border-left: solid #3a8e94 10px;">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="font-title fs-4 fw-bold">{{ Fpaipl\Shopy\Models\Payment::where('status', 'pending')->count() }}</div>
                        <div class="font-subtitle">New Receipts</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card rounded-0 shadow-none" style="border-left: solid #3a8e94 10px;">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="font-title fs-4 fw-bold">{{ Fpaipl\Shopy\Models\Payment::where('status', 'approved')->count() }}</div>
                        <div class="font-subtitle">Approved Receipts</div>
                    </div>
                </div>
            </div>
        </div>
 --}}

    </div>

@endsection
