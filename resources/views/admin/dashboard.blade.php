@extends('admin.layout')

@section('pagecontent')

<h4 class="mb-4">Admin Dashboard</h4>

<div class="row">

    <div class="col-md-3">
        <div class="card shadow-sm mb-3">
            <div class="card-body text-center">
                <h6>Total Products</h6>
                <h2>{{ $totalProducts }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm mb-3">
            <div class="card-body text-center">
                <h6>Total Categories</h6>
                <h2>{{ $totalCategories }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm mb-3">
            <div class="card-body text-center">
                <h6>Total Orders</h6>
                <h2>{{ $totalOrders }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm mb-3">
            <div class="card-body text-center">
                <h6>Total Users</h6>
                <h2>{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>

</div>

@endsection
