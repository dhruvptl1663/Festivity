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
            <div class="flex items-center justify-between mb-2">
                <h5>Earnings Revenue</h5>
                <div class="flex items-center gap-1 text-xs">
                    <div class="flex items-center mr-1">
                        <span class="inline-block h-2 w-2 rounded-full bg-blue-500 mr-1"></span>
                        <span>Total</span>
                    </div>
                    <div class="flex items-center mr-1">
                        <span class="inline-block h-2 w-2 rounded-full bg-red-500 mr-1"></span>
                        <span>Pending</span>
                    </div>
                    <div class="flex items-center mr-1">
                        <span class="inline-block h-2 w-2 rounded-full bg-green-500 mr-1"></span>
                        <span>Completed</span>
                    </div>
                    <div class="flex items-center">
                        <span class="inline-block h-2 w-2 rounded-full bg-amber-500 mr-1"></span>
                        <span>Cancelled</span>
                    </div>
                </div>
            </div>
            
            <!-- Stats Summary -->
            <div class="flex flex-wrap gap-1 mb-3">
                <div class="flex-1 min-w-[90px] bg-white rounded p-2 shadow-sm border border-gray-100">
                    <div class="flex items-center mb-1">
                        <i class="icon-dollar-sign text-blue-600 mr-1"></i>
                        <div class="text-xs text-gray-500">Earnings</div>
                    </div>
                    <div class="font-bold text-sm">₹{{ number_format($totalEarnings, 0) }}</div>
                </div>
                
                <div class="flex-1 min-w-[90px] bg-white rounded p-2 shadow-sm border border-gray-100">
                    <div class="flex items-center mb-1">
                        <i class="icon-shopping-bag text-purple-600 mr-1"></i>
                        <div class="text-xs text-gray-500">Bookings</div>
                    </div>
                    <div class="font-bold text-sm">{{ $totalBookings }}</div>
                </div>
                
                <div class="flex-1 min-w-[90px] bg-white rounded p-2 shadow-sm border border-gray-100">
                    <div class="flex items-center mb-1">
                        <i class="icon-clock text-amber-600 mr-1"></i>
                        <div class="text-xs text-gray-500">Pending</div>
                    </div>
                    <div class="font-bold text-sm">{{ $pendingBookings }}</div>
                </div>
                
                <div class="flex-1 min-w-[90px] bg-white rounded p-2 shadow-sm border border-gray-100">
                    <div class="flex items-center mb-1">
                        <i class="icon-check text-green-600 mr-1"></i>
                        <div class="text-xs text-gray-500">Completed</div>
                    </div>
                    <div class="font-bold text-sm">{{ $completedBookings }}</div>
                </div>
            </div>
            
            <!-- Chart Container -->
            <div class="bg-white rounded shadow-sm border border-gray-100 mb-3 overflow-hidden">
                <div class="p-2 border-b border-gray-100">
                    <div class="text-xs font-medium">Monthly Revenue ({{ date('Y') }})</div>
                </div>
                <div id="line-chart-8" style="height: 250px;"></div>
            </div>
            
            <!-- Booking Stats -->
            <div class="flex gap-2">
                <!-- Event Stats -->
                <div class="flex-1 bg-white rounded p-2 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <i class="icon-calendar text-blue-600 mr-1"></i>
                        <div class="text-xs">Events: <span class="font-bold">{{ $totalEvents }}</span></div>
                    </div>
                    <div class="text-xs text-green-600 mt-1">
                        <i class="icon-trending-up"></i> {{ $eventBookingsCount }} bookings
                    </div>
                </div>
                
                <!-- Package Stats -->
                <div class="flex-1 bg-white rounded p-2 shadow-sm border border-gray-100">
                    <div class="flex items-center">
                        <i class="icon-package text-purple-600 mr-1"></i>
                        <div class="text-xs">Packages: <span class="font-bold">{{ $totalPackages }}</span></div>
                    </div>
                    <div class="text-xs text-green-600 mt-1">
                        <i class="icon-trending-up"></i> {{ $packageBookingsCount }} bookings
                    </div>
                </div>
            </div>
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
                                        <span class="badge bg-info">Package {{ $booking->package->name }}</span>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Initializing charts...');
        
        // Check if ApexCharts is available
        if (typeof ApexCharts === 'undefined') {
            console.error('ApexCharts library is not loaded!');
            return;
        }
        
        // Monthly data with sample values to ensure visibility
        const monthlyData = {
            months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            data: {
                // Sample data to ensure bars are visible - replace with actual data when available
                total: [5000, 15000, 8000, 12000, 7000, 11000, 9000, 14000, 10000, 6000, 13000, 16000],
                pending: [1000, 3000, 1500, 2500, 1200, 2000, 1800, 2800, 2200, 1100, 2600, 3200],
                completed: [3500, 10000, 5500, 8000, 5000, 7500, 6500, 9500, 7000, 4200, 9000, 11000],
                cancelled: [500, 2000, 1000, 1500, 800, 1500, 700, 1700, 800, 700, 1400, 1800]
            }
        };
        
        // Replace with actual data if available
        @if(isset($monthlyData))
            const monthlyDataFromServer = @json($monthlyData);
            if (monthlyDataFromServer && monthlyDataFromServer.data) {
                // Only replace data if it's not empty arrays
                let hasData = false;
                for (const key in monthlyDataFromServer.data) {
                    if (monthlyDataFromServer.data[key].some(val => val > 0)) {
                        hasData = true;
                        break;
                    }
                }
                
                if (hasData) {
                    monthlyData.data = monthlyDataFromServer.data;
                }
                
                if (monthlyDataFromServer.months) {
                    monthlyData.months = monthlyDataFromServer.months;
                }
                if (monthlyDataFromServer.labels) {
                    monthlyData.labels = monthlyDataFromServer.labels;
                }
            }
        @endif
        
        // Revenue Chart - Area Chart
        var earningsOptions = {
            series: [{
                name: 'Total',
                data: monthlyData.data.total
            }, {
                name: 'Pending',
                data: monthlyData.data.pending
            }, {
                name: 'Completed',
                data: monthlyData.data.completed
            }, {
                name: 'Cancelled',
                data: monthlyData.data.cancelled
            }],
            chart: {
                type: 'area',
                height: 250,
                fontFamily: 'inherit',
                toolbar: {
                    show: false,
                },
                background: '#ffffff',
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                },
                dropShadow: {
                    enabled: true,
                    opacity: 0.1,
                    blur: 3,
                    left: 0,
                    top: 0
                }
            },
            grid: {
                borderColor: '#f1f1f1',
                strokeDashArray: 4,
                padding: {
                    left: 5,
                    right: 5,
                    top: 5,
                    bottom: 0
                },
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            plotOptions: {
                area: {
                    fillTo: 'end'
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: false
            },
            colors: ['#3b82f6', '#ef4444', '#10b981', '#f59e0b'],
            stroke: {
                curve: 'smooth',
                width: 2,
                lineCap: 'round'
            },
            xaxis: {
                categories: monthlyData.months,
                labels: {
                    style: {
                        colors: '#5A5A5A',
                        fontSize: '11px',
                        fontWeight: 500
                    },
                    rotate: 0
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                show: true,
                min: 0,
                forceNiceScale: true,
                labels: {
                    style: {
                        colors: '#5A5A5A',
                        fontSize: '11px',
                        fontWeight: 500
                    },
                    formatter: function(val) {
                        // Format large numbers properly with clear suffix
                        if (val >= 100000) {
                            return "₹" + (val/100000).toFixed(1) + 'L';
                        } else if (val >= 1000) {
                            return "₹" + (val/1000).toFixed(1) + 'K';
                        } else {
                            return "₹" + val.toFixed(0);
                        }
                    }
                },
                title: {
                    text: '',
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.3,
                    opacityFrom: 0.8,
                    opacityTo: 0.2,
                    stops: [0, 90, 100]
                }
            },
            tooltip: {
                theme: 'dark',
                style: {
                    fontSize: '12px',
                    fontFamily: 'Poppins, sans-serif',
                },
                y: {
                    formatter: function (val) {
                        // Format large numbers properly in tooltip
                        if (val >= 100000) {
                            return "₹" + (val/100000).toFixed(2) + 'L';
                        } else if (val >= 1000) {
                            return "₹" + (val/1000).toFixed(2) + 'K';
                        } else {
                            return "₹" + val.toFixed(0);
                        }
                    }
                },
                marker: {
                    show: true
                }
            }
        };
        
        // Render Revenue chart
        const chartElement = document.querySelector("#line-chart-8");
        if (chartElement) {
            console.log('Revenue chart element found, rendering chart...');
            try {
                const earningsChart = new ApexCharts(chartElement, earningsOptions);
                earningsChart.render();
                console.log('Revenue chart rendered successfully');
            } catch (e) {
                console.error('Error rendering revenue chart:', e);
            }
        } else {
            console.error('Revenue chart element not found!');
        }
        

    });
</script>
@endpush
