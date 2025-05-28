@extends('layouts.decorator')

@section('content')
<div class="main-content-wrap" style="margin-top:100px; margin-left:50px;">
    <div class="tf-section-2 mb-30">
        <div class="flex gap20 flex-wrap-mobile">
            <div class="w-half">
                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Total Orders</div>
                                <h4>{{ $totalBookings }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Total Amount</div>
                                <h4>₹{{ number_format($totalEarnings, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Pending Orders</div>
                                <h4>{{ $pendingBookings }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wg-chart-default">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Pending Orders Amount</div>
                                <h4>₹{{ number_format(0, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-half">
                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Completed Orders</div>
                                <h4>{{ $completedBookings }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Completed Orders Amount</div>
                                <h4>₹{{ number_format($totalEarnings, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Cancelled Orders</div>
                                <h4>{{ $cancelledBookings }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wg-chart-default">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Cancelled Orders Amount</div>
                                <h4>₹{{ number_format(0, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Earnings revenue</h5>
                <div class="dropdown default">
                    <button class="btn btn-secondary dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="icon-more"><i class="icon-more-horizontal"></i></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="javascript:void(0);">This Week</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Last Week</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-wrap gap40">
                <div>
                    <div class="mb-2">
                        <div class="block-legend">
                            <div class="dot t1"></div>
                            <div class="text-tiny">Total Bookings</div>
                        </div>
                    </div>
                    <div class="flex items-center gap10">
                        <h4>{{ $totalBookings }}</h4>
                        <div class="box-icon-trending up">
                            <i class="icon-trending-up"></i>
                            <div class="body-title number">Active</div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mb-2">
                        <div class="block-legend">
                            <div class="dot t2"></div>
                            <div class="text-tiny">Completed Orders</div>
                        </div>
                    </div>
                    <div class="flex items-center gap10">
                        <h4>{{ $completedBookings }}</h4>
                        <div class="box-icon-trending up">
                            <i class="icon-check"></i>
                            <div class="body-title number">Completed</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="line-chart-8"></div>
            
            <!-- JavaScript for Chart -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Default data structure for the chart
                    const monthlyData = {
                        data: {
                            total: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                            pending: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                            completed: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                            cancelled: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                        },
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    };
                    
                    var options = {
                        series: [{
                            name: 'Total',
                            data: monthlyData.data.total
                        }, {
                            name: 'Pending',
                            data: monthlyData.data.pending
                        },
                        {
                            name: 'Completed',
                            data: monthlyData.data.completed
                        }, {
                            name: 'Cancelled',
                            data: monthlyData.data.cancelled
                        }],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#212529',
                                },
                            },
                            categories: monthlyData.labels,
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "₹" + val.toFixed(2);
                                }
                            }
                        }
                    };
                    
                    if (document.querySelector("#line-chart-8")) {
                        const chart = new ApexCharts(
                            document.querySelector("#line-chart-8"),
                            options
                        );
                        chart.render();
                    }
                });
            </script>
        </div>

    </div>
    <div class="tf-section mb-30">
        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Recent orders</h5>
                <div class="dropdown default">
                    
                </div>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 80px">Booking ID</th>
                                <th>Customer</th>
                                <th class="text-center">Package Price</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Booking Date</th>
                                <th class="text-center">Items</th>
                                <th class="text-center">Completion Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                            <tr>
                                <td class="text-center">{{ $booking->booking_id }}</td>
                                <td class="text-center">{{ $booking->user->name ?? 'N/A' }}</td>
                                <td class="text-center">
                                    @if($booking->package_id && isset($booking->package))
                                        ₹{{ number_format($booking->package->price, 2) }}
                                    @elseif($booking->event_id && isset($booking->event))
                                        ₹{{ number_format($booking->event->price, 2) }}
                                    @else
                                        ₹{{ number_format(0, 2) }}
                                    @endif
                                </td>
                                <td class="text-center">₹{{ number_format($booking->discount ?? 0, 2) }}</td>
                                <td class="text-center">₹{{ number_format($booking->total_amount, 2) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ 
                                        $booking->status == 'pending' ? 'warning text-dark' : 
                                        ($booking->status == 'accepted' ? 'info' : 
                                        ($booking->status == 'completed' ? 'success' : 
                                        ($booking->status == 'rejected' ? 'secondary' : 'danger'))) 
                                    }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="text-center">{{ date('Y-m-d H:i', strtotime($booking->created_at)) }}</td>
                                <td class="text-center">
                                    @if($booking->event_id && isset($booking->event))
                                        <span class="badge bg-primary">Event: {{ $booking->event->name }}</span>
                                    @endif
                                    @if($booking->package_id && isset($booking->package))
                                        <span class="badge bg-info">Package: {{ $booking->package->name }}</span>
                                    @endif
                                    @if((!$booking->event_id || !isset($booking->event)) && (!$booking->package_id || !isset($booking->package)))
                                        <span class="badge bg-secondary">No items</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($booking->status == 'completed')
                                        @if($booking->event_datetime)
                                            {{ date('Y-m-d', strtotime($booking->event_datetime)) }}
                                        @elseif($booking->completed_at)
                                            {{ date('Y-m-d', strtotime($booking->completed_at)) }}
                                        @else
                                            {{ date('Y-m-d', strtotime($booking->updated_at)) }}
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('decorator.bookings.show', $booking->booking_id) }}">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="text-center">No recent bookings found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
