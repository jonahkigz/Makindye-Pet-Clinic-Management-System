@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center relative" 
     style="background-image: url('{{ asset('loginbg.png') }}');">
    
    <!-- Overlay for better readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-green-900/70 to-transparent"></div>

    <div class="max-w-6xl w-full mx-auto grid md:grid-cols-2 gap-8 relative z-10 px-6 py-12">
        
        <!-- Left Side - Branding -->
        <div class="hidden md:flex flex-col justify-center text-white space-y-6 pr-12">
            <div class="flex items-center gap-3">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                    <span class="text-4xl">🐾</span> <!-- Replace with your logo SVG if available -->
                </div>
                <div>
                    <h1 class="text-5xl font-bold tracking-tight">MPCMS</h1>
                    <p class="text-xl">Makindye Pet Clinic Management System</p>
                </div>
            </div>

            <div class="space-y-4">
                <p class="text-2xl font-medium">"Petcare, Our Priority"</p>
                <p class="text-lg opacity-90">Healthier Pets, Happier Families</p>
            </div>

            <!-- Pet Images Row -->
            <div class="flex gap-4 pt-8">
                <img src="{{ asset('images/cat.png') }}" alt="Cat" class="w-32 h-32 object-cover rounded-2xl shadow-xl">
                <img src="{{ asset('images/small-dog.png') }}" alt="Small Dog" class="w-32 h-32 object-cover rounded-2xl shadow-xl -mt-6">
                <img src="{{ asset('images/golden-retriever.png') }}" alt="Golden Retriever" class="w-40 h-40 object-cover rounded-2xl shadow-xl">
                <img src="{{ asset('images/rabbit.png') }}" alt="Rabbit" class="w-28 h-28 object-cover rounded-2xl shadow-xl mt-8">
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="max-w-md w-full mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="p-10">
                <!-- Logo / Header -->
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-green-600 rounded-2xl flex items-center justify-center shadow-inner">
                        <span class="text-5xl">🐾</span>
                    </div>
                </div>

                <h2 class="text-center text-3xl font-semibold text-gray-800 mb-1">Welcome Back</h2>
                <p class="text-center text-gray-600 mb-8">Sign in to continue to your dashboard</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-green-600">✉️</span>
                            <input 
                                type="email" 
                                name="email" 
                                required
                                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200"
                                placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-green-600">🔒</span>
                            <input 
                                type="password" 
                                name="password" 
                                required
                                class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-2xl focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200"
                                placeholder="Enter your password">
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <label class="flex items-center gap-2 text-sm text-gray-600">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-green-600 rounded">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-green-600 hover:underline">Forgot password?</a>
                    </div>

                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 transition-colors text-white font-semibold py-4 rounded-2xl flex items-center justify-center gap-2 text-lg">
                        <span