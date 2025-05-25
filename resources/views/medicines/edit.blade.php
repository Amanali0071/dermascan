@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.edit_medicine') }}
@endsection
@section('header_toolbar')
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between mb-7">
            <h1 class="mb-0 me-3">@yield('title')</h1>
            <a href="{{ route('medicines.index') }}"
               class="btn btn-outline-primary">{{ __('messages.common.back') }}</a>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column livewire-table">
            <div class="row">
                <div class="col-12">
                    @include('layouts.errors')
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('medicines.update', $medicine->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Medicine Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $medicine->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $medicine->brand) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="{{ old('quantity', $medicine->quantity) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price (single item)</label>
                            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" value="{{ old('price', $medicine->price) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Medicine Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @if($medicine->image)
                                <div class="mt-2">
                                    <img src="{{ asset( $medicine->image) }}" alt="Medicine Image" width="100">
                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $medicine->description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Medicine</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{--  assets/js/custom/input_price_format.js --}}
    {{--    assets/js/medicines/new.js --}}
@endsection
