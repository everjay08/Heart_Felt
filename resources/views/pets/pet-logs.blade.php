@extends('layouts.sidebar')

@section('title', 'Activity Logs')

@section('head')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- FontAwesome (optional, for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" crossorigin="anonymous" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" crossorigin="anonymous"></script>
    
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('table').DataTable();
        });
    </script>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Activity Logs</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Log Name</th>
                <th>Description</th>
                <th>Caused By</th>
                <th>Subject</th>
                <th>Changes</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->log_name }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ optional($activity->causer)->name ?? 'N/A' }}</td>
                    <td>{{ class_basename($activity->subject_type) }}</td>
                    <td>
                        @if($activity->properties && count($activity->properties->toArray()))
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                    @foreach($activity->properties->toArray() as $key => $value)
                                        <tr>
                                            <th style="width:40%;">{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                                            <td>
                                                @if(is_array($value) || is_object($value))
                                                    <pre class="mb-0">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $activities->links() }}
</div>
@endsection
