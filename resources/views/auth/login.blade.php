@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center relative px-4" 
     style="background-image: url('{{ asset('images/loginbg.png') }}');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-green-900/70 to-transparent"></div>

    <div class="max-w-6xl w-full mx-auto grid md:grid-cols-2 gap-8 relative z-10 py-12">
        
        <!-- Left Side - Branding (Hidden on mobile) -->
        <div class="hidden md:flex flex-col justify-center text-white space-y-6 pr-12">
            <div class="flex items-center gap-3">
                <span class="text-6xl">🐾</span>
                <div>
                    <h1 class="text-5xl font-bold tracking-tight">MPCMS</h1>
                    <p class="text-xl">Makindye Pet Clinic</p>
                </div>
            </div>

            <div class="space-y-3">
                <p class="text-3xl font-medium">Compassionate Care</p>
                <p class="text-lg opacity-90">Healthier Pets. Happier Lives.</p>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="max-w-md w-full mx-auto bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden">
            <div class="p-8 md:p-10">
                <!-- Header -->
                <div class="flex justify-center mb-6">
                    <div class="w-24 h-24 bg-[#F2E6CF] rounded-2xl flex items-center justify-center shadow-inner text-6xl">
                        🐾
                    </div>
                </div>

                <h1 class="text-center text-3xl font-bold text-gray-800 mb-1">Welcome</h1>
                <p class="text-center text-gray-600 mb-8">Sign in to continue to your dashboard</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-green-600">✉️</span>
                            <input 
                                type="email" 
                                name="email" 
                                required
                                class="w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-2xl focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                                placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-green-600">🔒</span