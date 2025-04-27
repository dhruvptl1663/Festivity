@extends('layouts.app')

@section('content')
<div class="min-vh-100 bg-white flex items-center">
    <div class="container mx-auto px-4 max-w-md">
        <div class="animate-fade-in-up text-center">
            <!-- Animated Checkmark -->
            <div class="check-container mx-auto mb-8">
                <svg class="checkmark" viewBox="0 0 52 52" style="width: 100px; height: 100px;">
                    <circle cx="26" cy="26" r="25" fill="none" class="checkmark-circle"/>
                    <path fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" class="checkmark-check"/>
                </svg>
            </div>

            <!-- Content -->
            <h1 class="text-4xl font-light text-gray-900 mb-4">
                Booking Confirmed
            </h1>
            <p class="text-gray-600 mb-8 text-lg">
                Your reservation has been successfully processed
            </p>

            <!-- Modern Back Button -->
            <a href="/" class="modern-home-button inline-block">
                <span class="button-content">
                    <span class="button-text">Back to Home</span>
                    <span class="button-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"/>
                        </svg>
                    </span>
                </span>
                <span class="hover-effect"></span>
            </a>
        </div>
    </div>
</div>

<style>
/* Container Animation */
.animate-fade-in-up {
    animation: fadeInUp 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
    opacity: 0;
    transform: translateY(20px);
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Checkmark Animation */
.checkmark-circle {
    stroke: #10b981;
    stroke-width: 2;
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark-check {
    stroke: #10b981;
    stroke-width: 2;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.6s forwards;
}

@keyframes stroke {
    100% { stroke-dashoffset: 0; }
}

/* Modern Button Styles */
.modern-home-button {
    position: relative;
    display: inline-flex;
    padding: 14px 32px;
    background: #111827;
    color: white;
    border-radius: 12px;
    font-weight: 500;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    transform: translateY(0);
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    border: none;
    cursor: pointer;
    text-decoration: none;
}

.button-content {
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    z-index: 2;
}

.button-icon {
    display: flex;
    transition: transform 0.3s ease;
}

.button-icon svg {
    transition: transform 0.3s ease;
}

.hover-effect {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        rgba(255,255,255,0.1) 0%,
        rgba(255,255,255,0.2) 100%);
    transform: translateX(-100%);
    transition: transform 0.4s cubic-bezier(0.23, 1, 0.32, 1);
}

/* Hover Effects */
.modern-home-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
}

.modern-home-button:hover .button-icon {
    transform: translateX(4px);
}

.modern-home-button:hover .hover-effect {
    transform: translateX(0);
}

/* Active State */
.modern-home-button:active {
    transform: translateY(1px);
}

/* Responsive Design */
@media (max-width: 640px) {
    .checkmark { width: 80px; height: 80px; }
    h1 { font-size: 2rem; }
    .modern-home-button { padding: 12px 24px; }
}
</style>
@endsection