@extends('layouts.base')

@section('title', 'Stock Summary Report')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-graph-up"></i> Stock Summary Report</h1>
    <p>Total stock in and stock out per product for a selected period</p>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('reports.stock-summary') }}" method="GET" class="row g-3">
            <div class="col-md-5">
                <label for="from_date" class="form-label">From Date</label>
                <input type="date" class="form-control" id="from_date" name="from_date" 
                       value="{{ request('from_date', now()->subMonths(1)->toDateString()) }}">
            </div>

            <div class="col-md-5">
                <label for="to_date" class="form-label">To Date</label>
                <input type="date" class="form-control" id="to_date" name="to_date" 
                       value="{{ request('to_date', now()->toDateString()) }}">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Generate
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <span>Summary: {{ isset($fromDate) ? $fromDate->format('M d, Y') : now()->subMonths(1)->format('M d, Y') }} to {{ isset($toDate) ? $toDate->format('M d, Y') : now()->format('M d, Y') }}</span>
            <button class="btn btn-sm btn-primary" onclick="window.print()">
                <i class="bi bi-printer"></i> Print Report
            </button>
        </div>
    </div>
    <div class="card-body">
        @if(count($summary) > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
                            <th>Net Movement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalIn = 0;
                            $totalOut = 0;
                            $totalNet = 0;
                        @endphp
                        @foreach($summary as $item)
                            @php
                                $totalIn += $item['stock_in'];
                                $totalOut += $item['stock_out'];
                                $totalNet += $item['net_movement'];
                            @endphp
                            <tr>
                                <td><strong>{{ $item['product']->sku }}</strong></td>
                                <td>{{ $item['product']->name }}</td>
                                <td>{{ $item['product']->category->name }}</td>
                                <td>
                                    <span class="badge" class="bg-success">
                                        {{ $item['stock_in'] }} {{ $item['product']->unit }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge" class="bg-danger">
                                        {{ $item['stock_out'] }} {{ $item['product']->unit }}
                                    </span>
                                </td>
                                <td>
                                    @if($item['net_movement'] > 0)
                                        <span class="badge badge-in-stock">+{{ $item['net_movement'] }}</span>
                                    @elseif($item['net_movement'] < 0)
                                        <span class="badge badge-low-stock">{{ $item['net_movement'] }}</span>
                                    @else
                                        <span class="badge" style="background-color: #95a5a6;">0</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #f8f9fa; font-weight: bold;">
                            <td colspan="3">TOTAL</td>
                            <td><span class="badge" class="bg-success">{{ $totalIn }}</span></td>
                            <td><span class="badge" class="bg-danger">{{ $totalOut }}</span></td>
                            <td>
                                @if($totalNet > 0)
                                    <span class="badge badge-in-stock">+{{ $totalNet }}</span>
                                @elseif($totalNet < 0)
                                    <span class="badge badge-low-stock">{{ $totalNet }}</span>
                                @else
                                    <span class="badge" style="background-color: #95a5a6;">0</span>
                                @endif
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <p class="text-muted text-center py-5">No data available for the selected period.</p>
        @endif
    </div>
</div>
@endsection
