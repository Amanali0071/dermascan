@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.new_medicine') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-1">@yield('title')</h1>
            <a href="{{ route('medicines.index') }}" class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('medicines.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Medicine Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                                required>
                        </div>


                        <div class="mb-3">
                            <label for="price" class="form-label">Price (single item)</label>
                            <input type="number" class="form-control" id="price" name="price" min="0"
                                step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Medicine Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Medicine</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{--    assets/js/custom/input_price_format.js --}}
    {{--   assets/js/medicines/new.js --}}
@endsection
