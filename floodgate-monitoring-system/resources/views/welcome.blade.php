@extends('layouts.app')

@section('title', 'Homepage - Smart Flood Management')

@section('content')
    <section id="search-section" style="padding: 40px 20px; background-color: #ffffff; margin-bottom: 20px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2><img src="https://via.placeholder.com/30x30?text=🔎" alt="Search Icon" style="vertical-align: middle; margin-right: 10px;"> Floodgate Search</h2>
        
        <form method="POST" action="{{ route('floodgate.search') }}">
            @csrf
            <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                <label for="floodgate_id" style="flex-basis: 100px;">Floodgate ID:</label>
                <input type="text" name="floodgate_id" id="floodgate_id" pattern="[0-9]{5}" title="Enter 5-digit ID" value="{{ old('floodgate_id', isset($searched_id) && $searched_id ? $searched_id : '') }}" required style="flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <button type="submit" style="padding: 8px 15px; background-color: #337ab7; color: white; border: none; border-radius: 4px; cursor: pointer;">Search</button>
            </div>
            @error('floodgate_id')
                <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </form>

        @if(session('status'))
            <div style="margin-top: 10px; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px;">
                {{ session('status') }}
            </div>
        @endif

        @if(isset($search_result) && $search_result)
            <div style="margin-top: 20px;" class="table-responsive-container">
                <h3>Search Result:</h3>
                <table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr>
                            <th style="padding: 8px;">ID</th>
                            <th style="padding: 8px;">Location</th>
                            <th style="padding: 8px;">Water Flow Rate (m³/s)</th>
                            <th style="padding: 8px;">Status</th>
                            <th style="padding: 8px;">Pump Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 8px;">{{ $search_result->id }}</td>
                            <td style="padding: 8px;">{{ $search_result->location }}</td>
                            <td style="padding: 8px;">{{ $search_result->water_flow_rate }}</td>
                            <td style="padding: 8px;">{{ $search_result->status }}</td>
                            <td style="padding: 8px;">{{ $search_result->pump_status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @elseif(isset($searched_id))
            <div style="margin-top: 20px; color: #721c24; background-color: #f8d7da; padding: 10px; border-radius: 5px;">
                Floodgate with ID '{{ $searched_id }}' not found.
            </div>
        @elseif(!isset($search_result) && !isset($searched_id) && (!isset($all_floodgates) || $all_floodgates->isEmpty()))
            <div style="margin-top: 20px; color: #004085; background-color: #cce5ff; padding: 10px; border-radius: 5px;">
                Enter a 5-digit Floodgate ID to search.
            </div>
        @endif
    </section>

    <section id="list-section" style="padding: 40px 20px; background-color: #e7f0ff; margin-bottom: 20px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2><img src="https://via.placeholder.com/30x30?text=📄" alt="List Icon" style="vertical-align: middle; margin-right: 10px;"> Floodgate List</h2>
        
        @if(isset($all_floodgates) && $all_floodgates->count() > 0)
            <div class="table-responsive-container">
                <table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr>
                            <th style="padding: 8px;">No.</th>
                            <th style="padding: 8px;">ID</th>
                            <th style="padding: 8px;">Location</th>
                            <th style="padding: 8px;">Water Flow Rate (m³/s)</th>
                            <th style="padding: 8px;">Status</th>
                            <th style="padding: 8px;">Pump Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_floodgates as $floodgate)
                            <tr>
                                <td style="padding: 8px;">{{ $loop->iteration + ($all_floodgates->currentPage() - 1) * $all_floodgates->perPage() }}</td>
                                <td style="padding: 8px;">{{ $floodgate->id }}</td>
                                <td style="padding: 8px;">{{ $floodgate->location }}</td>
                                <td style="padding: 8px;">{{ $floodgate->water_flow_rate }}</td>
                                <td style="padding: 8px;">{{ $floodgate->status }}</td>
                                <td style="padding: 8px;">{{ $floodgate->pump_status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 20px;">
                {{ $all_floodgates->links() }}
            </div>
        @else
            <p>No floodgate data available.</p>
        @endif
    </section>

    <section id="dashboard-section" style="padding: 40px 20px; background-color: #ffffff; border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <h2><img src="https://via.placeholder.com/30x30?text=📊" alt="Dashboard Icon" style="vertical-align: middle; margin-right: 10px;"> Statistics Dashboard</h2>
        
        @if(isset($dashboard_stats))
            <h3>Overall Status</h3>
            <div class="dashboard-cards-container" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-around; margin-bottom: 30px;">
                <div class="dashboard-card" style="background-color: #cceeff; padding: 20px; border-radius: 10px; text-align: center; flex-basis: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <h4><img src="https://via.placeholder.com/20x20?text=⚙️" alt="Total Icon" style="vertical-align: middle; margin-right: 5px;"> Total Gates</h4>
                    <p style="font-size: 2em; margin-top: 5px;">{{ $dashboard_stats['total_gates'] ?? 0 }}</p>
                </div>
                <div class="dashboard-card" style="background-color: #ccffcc; padding: 20px; border-radius: 10px; text-align: center; flex-basis: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <h4><img src="https://via.placeholder.com/20x20?text=🟢" alt="Open Icon" style="vertical-align: middle; margin-right: 5px;"> Gates Open</h4>
                    <p style="font-size: 2em; margin-top: 5px;">{{ $dashboard_stats['open_gates'] ?? 0 }}</p>
                </div>
                <div class="dashboard-card" style="background-color: #ffcccc; padding: 20px; border-radius: 10px; text-align: center; flex-basis: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <h4><img src="https://via.placeholder.com/20x20?text=🔴" alt="Closed Icon" style="vertical-align: middle; margin-right: 5px;"> Gates Closed</h4>
                    <p style="font-size: 2em; margin-top: 5px;">{{ $dashboard_stats['closed_gates'] ?? 0 }}</p>
                </div>
                <div class="dashboard-card" style="background-color: #ccddff; padding: 20px; border-radius: 10px; text-align: center; flex-basis: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <h4><img src="https://via.placeholder.com/20x20?text=💨" alt="Pump Active Icon" style="vertical-align: middle; margin-right: 5px;"> Pumps Active</h4>
                    <p style="font-size: 2em; margin-top: 5px;">{{ $dashboard_stats['pumps_active'] ?? 0 }}</p>
                </div>
                <div class="dashboard-card" style="background-color: #ffddcc; padding: 20px; border-radius: 10px; text-align: center; flex-basis: 150px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                    <h4><img src="https://via.placeholder.com/20x20?text=🚫" alt="Pump Inactive Icon" style="vertical-align: middle; margin-right: 5px;"> Pumps Inactive</h4>
                    <p style="font-size: 2em; margin-top: 5px;">{{ $dashboard_stats['pumps_inactive'] ?? 0 }}</p>
                </div>
            </div>
        @else
            <p>Statistics are currently unavailable.</p>
        @endif

        <h3>Gate Specific Overview (1-200)</h3>
        <p>Detailed per-gate statistics will be shown here if applicable based on ID structure.</p>
    </section>
@endsection

@push('styles')
<style>
    /* Basic styling for pagination */
    .pagination {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: center;
        flex-wrap: wrap; /* Allow pagination to wrap on small screens */
    }
    .pagination li {
        margin: 5px; /* Add some margin for wrapped items */
    }
    .pagination li a,
    .pagination li span {
        padding: 8px 12px;
        border: 1px solid #ddd;
        color: #337ab7;
        text-decoration: none;
        border-radius: 4px;
    }
    .pagination li.active span {
        background-color: #337ab7;
        color: white;
        border-color: #337ab7;
    }
    .pagination li.disabled span {
        color: #777;
        border-color: #ddd;
    }
</style>
@endpush
