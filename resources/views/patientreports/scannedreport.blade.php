@extends('layouts.app')

@section('title')
    {{ __('Patient Reports') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="d-flex flex-column">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3>{{ __('Patient Reports') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="searchReport" class="form-control" placeholder="Search by report number...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="searchBtn" type="button">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="reportsTable">
                            <thead>
                                <tr>
                                    <th>{{ __('Report No') }}</th>
                                    <th>{{ __('Patient Name') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Disease') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Reports will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Load reports on page load
            loadReports();
            
            // Search functionality
            $('#searchBtn').on('click', function() {
                loadReports($('#searchReport').val());
            });
            
            // Also search when pressing Enter
            $('#searchReport').on('keypress', function(e) {
                if (e.which === 13) {
                    loadReports($('#searchReport').val());
                }
            });
            
            function loadReports(searchTerm = '') {
                console.log('Searching for:', searchTerm); // Debug log
                
                $.ajax({
                    url: "{{ route('patient.reports.search') }}",
                    type: "GET",
                    data: { search: searchTerm },
                    dataType: 'json',
                    beforeSend: function() {
                        // Show loading indicator if needed
                        $('#reportsTable tbody').html('<tr><td colspan="5" class="text-center">Loading...</td></tr>');
                    },
                    success: function(response) {
                        console.log('Response:', response); // Debug log
                        
                        var tbody = $('#reportsTable tbody');
                        tbody.empty();
                        
                        if (response.data && response.data.length > 0) {
                            $.each(response.data, function(index, report) {
                                tbody.append(`
                                    <tr>
                                        <td>${report.report_number}</td>
                                        <td>${report.patient_name}</td>
                                        <td>${report.date}</td>
                                        <td>${report.disease}</td>
                                        <td>
                                            <a href="${report.download_url}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-download"></i> Download
                                            </a>
                                        </td>
                                    </tr>
                                `);
                            });
                        } else {
                            tbody.append(`
                                <tr>
                                    <td colspan="5" class="text-center">No reports found</td>
                                </tr>
                            `);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr, status, error); // Debug log
                        $('#reportsTable tbody').html('<tr><td colspan="5" class="text-center">Error loading reports</td></tr>');
                    }
                });
            }
        });
    </script>
@endsection
