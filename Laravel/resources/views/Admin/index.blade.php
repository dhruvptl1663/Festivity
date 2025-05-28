@extends('layouts.admin')

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
                                <h4>{{ $totalOrders }}</h4>
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
                                <h4>₹{{ number_format($totalAmount, 2) }}</h4>
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
                                <h4>{{ $pendingOrders }}</h4>
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
                                <h4>₹{{ number_format($pendingAmount, 2) }}</h4>
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
                                <h4>{{ $completedOrders }}</h4>
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
                                <h4>₹{{ number_format($completedAmount, 2) }}</h4>
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
                                <h4>{{ $cancelledOrders }}</h4>
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
                                <h4>₹{{ number_format($cancelledAmount, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Booking Analytics</h5>
                <div class="dropdown default">
                    <a class="btn btn-secondary dropdown-toggle" href="#">
                        <span>This Month</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="javascript:void(0);">This Month</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Last Week</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            
            
            <!-- Chart containers with modern styling -->
            <div style="display: flex; flex-wrap: wrap; margin-top: 20px;">
                <div style="flex: 2; min-width: 300px; padding-right: 15px;">
                    <div id="revenue-chart" style="min-height: 365px; background: #fff; border-radius: 10px; padding: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);"></div>
                </div>
                <div style="flex: 1; min-width: 250px;">
                    <div id="booking-type-chart" style="min-height: 365px; background: #fff; border-radius: 10px; padding: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);"></div>
                </div>
            </div>
        </div>
        
        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check if ApexCharts is available
                if (typeof ApexCharts === 'undefined') {
                    console.error('ApexCharts library is not loaded!');
                    return;
                }
                
                // Monthly data
                const monthlyData = @json($monthlyData);
                
                // Revenue chart - modern styling
                const revenueOptions = {
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
                        height: 350,
                        toolbar: {
                            show: false,
                        },
                        fontFamily: 'Poppins, Arial, sans-serif',
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: {
                                enabled: true,
                                delay: 150
                            },
                            dynamicAnimation: {
                                enabled: true,
                                speed: 350
                            }
                        },
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 2,
                            blur: 4,
                            opacity: 0.1
                        }
                    },
                    grid: {
                        borderColor: '#f1f1f1',
                        strokeDashArray: 3,
                        position: 'back'
                    },
                    plotOptions: {
                        area: {
                            fillTo: 'end',
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    xaxis: {
                        categories: monthlyData.months,
                        labels: {
                            style: {
                                colors: '#5A5A5A',
                                fontSize: '12px',
                                fontFamily: 'Poppins, Arial, sans-serif',
                                fontWeight: 400
                            }
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#5A5A5A',
                                fontSize: '13px',
                                fontFamily: 'Poppins, Arial, sans-serif',
                                fontWeight: 500
                            },
                            formatter: function(val) {
                                // Format large numbers properly with clear suffix
                                if (val >= 100000) {
                                    return "₹" + (val/100000).toFixed(1) + ' Lakh';
                                } else if (val >= 1000) {
                                    return "₹" + (val/1000).toFixed(1) + ' K';
                                } else {
                                    return "₹" + val.toFixed(0);
                                }
                            },
                            offsetX: 0,
                            offsetY: 0,
                            padding: 5
                        },
                        tickAmount: 5,
                        min: function(min) { return 0; },
                        forceNiceScale: true,
                        title: {
                            text: 'Amount (₹)',
                            style: {
                                fontSize: '14px',
                                fontWeight: 600,
                                fontFamily: 'Poppins, Arial, sans-serif',
                                color: '#5A5A5A'
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        offsetY: -15,
                        fontFamily: 'Poppins, Arial, sans-serif',
                        markers: {
                            width: 10,
                            height: 10,
                            radius: 6
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: 'vertical',
                            shadeIntensity: 0.4,
                            opacityFrom: 0.7,
                            opacityTo: 0.2,
                            stops: [0, 90, 100]
                        }
                    },
                    tooltip: {
                        theme: 'dark',
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Poppins, Arial, sans-serif',
                        },
                        y: {
                            formatter: function (val) {
                                // Format large numbers properly in tooltip
                                if (val >= 100000) {
                                    return "₹" + (val/100000).toFixed(2) + ' Lakh';
                                } else if (val >= 1000) {
                                    return "₹" + (val/1000).toFixed(2) + ' Thousand';
                                } else {
                                    return "₹" + val.toFixed(2);
                                }
                            }
                        },
                        marker: {
                            show: true,
                        }
                    },
                    colors: ['#4361ee', '#fe6c6c', '#09b66d', '#ff9a42']
                };
                
                const revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), revenueOptions);
                revenueChart.render();
                
                // Booking type distribution chart - modern styling
                const bookingTypeOptions = {
                    series: [@json((int)$eventBookingsCount), @json((int)$packageBookingsCount)],
                    chart: {
                        width: '100%',
                        type: 'donut',
                        height: 350,
                        fontFamily: 'Poppins, Arial, sans-serif',
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: {
                                enabled: true,
                                delay: 150
                            },
                            dynamicAnimation: {
                                enabled: true,
                                speed: 350
                            }
                        },
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 2,
                            blur: 4,
                            opacity: 0.15
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                                background: 'transparent',
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        offsetY: -10,
                                        fontFamily: 'Poppins, Arial, sans-serif',
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '28px',
                                        fontWeight: 700,
                                        fontFamily: 'Poppins, Arial, sans-serif',
                                        color: '#5A5A5A',
                                        offsetY: 5,
                                        formatter: function (val) {
                                            return val;
                                        }
                                    },
                                    total: {
                                        show: true,
                                        fontSize: '16px',
                                        fontWeight: 600,
                                        label: 'Total',
                                        fontFamily: 'Poppins, Arial, sans-serif',
                                        color: '#5A5A5A',
                                        formatter: function (w) {
                                            return w.globals.seriesTotals.reduce((a, b) => {
                                                return a + b;
                                            }, 0);
                                        }
                                    }
                                }
                            }
                        }
                    },
                    labels: ['Events', 'Packages'],
                    colors: ['#4361ee', '#ff9a42'],
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            type: 'horizontal',
                            shadeIntensity: 0.25,
                            gradientToColors: ['#2e79fb', '#ff7200'],
                            inverseColors: true,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100]
                        }
                    },
                    title: {
                        text: 'Booking Type Distribution',
                        align: 'center',
                        style: {
                            fontSize: '16px',
                            fontFamily: 'Poppins, Arial, sans-serif',
                            fontWeight: 600,
                            color: '#5A5A5A'
                        }
                    },
                    legend: {
                        position: 'bottom',
                        fontFamily: 'Poppins, Arial, sans-serif',
                        fontSize: '14px',
                        markers: {
                            width: 10,
                            height: 10,
                            radius: 6
                        },
                        itemMargin: {
                            horizontal: 10,
                            vertical: 0
                        }
                    },
                    tooltip: {
                        theme: 'dark',
                        style: {
                            fontSize: '12px',
                            fontFamily: 'Poppins, Arial, sans-serif',
                        }
                    },
                    stroke: {
                        width: 0
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
                
                const bookingTypeChart = new ApexCharts(document.querySelector("#booking-type-chart"), bookingTypeOptions);
                bookingTypeChart.render();
            });
        </script>
        @endpush
    </div>

    <div class="tf-section mb-30">
        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Recent orders</h5>
                <div class="dropdown default">
                    <a class="btn btn-secondary dropdown-toggle" href="#">
                        <span class="view-all">View all</span>
                    </a>
                </div>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 80px">Booking ID</th>
                                <th>Customer</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Booking Date</th>
                                <th class="text-center">Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $booking)
                            <tr>
                                <td class="text-center">{{ $booking->booking_id ?? 'N/A' }}</td>
                                <td>{{ $booking->user->name ?? 'Guest' }}</td>
                                <td class="text-center">
                                    @if(isset($booking->advance_paid) && $booking->advance_paid > 0)
                                        ₹{{ number_format($booking->advance_paid, 2) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ 
                                        $booking->status == 'pending' ? 'warning text-dark' : 
                                        ($booking->status == 'accepted' ? 'info' : 
                                        ($booking->status == 'completed' ? 'success' : 
                                        ($booking->status == 'rejected' ? 'secondary' : 'danger'))) 
                                    }}">
                                        {{ ucfirst($booking->status ?? 'N/A') }}
                                    </span>
                                </td>
                                <td class="text-center">{{ $booking->created_at ? date('Y-m-d H:i', strtotime($booking->created_at)) : 'N/A' }}</td>
                                <td class="text-center">
                                    @if($booking->package_id)
                                        Package
                                    @elseif($booking->event_id)
                                        Event
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(route('admin.bookings.show', $booking->booking_id))
                                        <a href="{{ route('admin.bookings.show', $booking->booking_id) }}" class="btn btn-sm btn-primary">
                                            <i class="icon-eye"></i> View
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
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
