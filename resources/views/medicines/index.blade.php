@extends('layouts.app')
@section('title')
    {{ __('messages.medicine.medicines') }}
@endsection
@section('css')
@endsection
@section('content')
    <div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Medicines</h3>
        <a href="{{ route('medicines.create') }}" class="btn btn-primary">
            Create Medicine
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="medicines-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicines as $medicine)
                    <tr>
                        <td style="width: 100px; height: 100px; object-fit: cover;">
                            @if ($medicine->image)
                                <img src="{{ asset($medicine->image) }}" alt="Medicine Image"
                                    style="width:100%; height:100%;object-fit:cover;">
                            @else
                                <img src="{{ asset('images/default-medicine.png') }}" alt="No Image"
                                    style="width:100%; height:100%;object-fit:cover;">
                            @endif
                        </td>
                        <td>{{ $medicine->name }}</td>
                        <td>{{ $medicine->brand }}</td>
                        <td>{{ $medicine->quantity }}</td>
                        <td>{{ $medicine->price }}</td>
                        <td>
                            <a href="{{ route('medicines.edit', $medicine->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST"
                                style="display:inline-block;" class="delete-medicine-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                            @push('scripts')
                                <script>
                                    $(document).on('submit', '.delete-medicine-form', function(e) {
                                        e.preventDefault();
                                        if (confirm('Are you sure?')) {
                                            var form = this;
                                            $.ajax({
                                                url: $(form).attr('action'),
                                                type: 'POST',
                                                data: $(form).serialize(),
                                                success: function() {
                                                    location.reload();
                                                },
                                                error: function() {
                                                    alert('Failed to delete medicine.');
                                                }
                                            });
                                        }
                                    });
                                </script>
                            @endpush
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#medicines-table').DataTable();
            });
        </script>
    @endpush
@endsection
@section('page_scripts')
@endsection
