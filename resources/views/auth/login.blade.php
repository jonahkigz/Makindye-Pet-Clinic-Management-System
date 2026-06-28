@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-cover bg-center relative" 
     style="background-image: url('{{ asset('images/loginbg.png') }}');">

    
    <!-- Overlay for better readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-green-900/70 to-transparent"></div>

    <div class="max-w-6xl w-full mx-auto grid md:grid-cols-2 gap-8 relative z-10 px-6 py-12">
        
        <!-- Left Side - Branding -->
        <div class="hidden md:flex flex-col justify-center text-white space-y-6 pr-12">
            <div class="flex items-center gap-3">
                <div>
                    <span class="text-4xl"></span> <!-- Replace with your logo SVG if available -->
                </div>
                <div>
                    <h1 class="text-5xl font-bold tracking-tight"></h1>
                    <p class="text-xl"></p>
                </div>
            </div>

            <div class="space-y-4">
                <p class="text-2xl font-medium"></p>
                <p class="text-lg opacity-90"></p>
            </div>

            <!-- Pet Images Row -->
            <div class="flex gap-4 pt-8">
                <div src="" class="w-32 h-32 object-cover rounded-2xl shadow-xl"></div>
                <div src="{{ asset('images/small-dog.png') }}"  class="w-32 h-32 object-cover rounded-2xl shadow-xl -mt-6"></div>
                <div src="{{ asset('images/golden-retriever.png') }}" class="w-40 h-40 object-cover rounded-2xl shadow-xl"></div>
                <div src="{{ asset('images/rabbit.png') }}" class="w-28 h-28 object-cover rounded-2xl shadow-xl mt-8"></div>
            </div>
            </div>

        <!-- Right Side - Login Form -->
        <div class="max-w-md w-full mx-auto bg-white/75 rounded-3xl shadow-2xl overflow-hidden">
            <div class="p-10">
                <!-- Logo / Header -->
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 bg-#F2E6CF  rounded-full flex items-center justify-center shadow-inner">
                        <div class="w-20 h-20 bg-#F2E6CF rounded-full flex items-center justify-center">
                    <span class="text-8xl">🐾</span> <!-- Replace with your logo SVG if available -->
                         </div>
                        
                    </div>
                </div>

                <h1 class="text-center text-3xl font-bold size-25 text-gray-800 mb-1">Welcome</h1>
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
                            class="w-full bg-green-900 hover:bg-green-950 transition-colors text-white font-bold py-4 rounded-2xl flex items-center justify-center gap-2 text-1g">
                        LogIn
                    </button>

                    @if ($errors->any())
                        <div class="mt-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-2xl text-sm">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Footer -->
            <div class="bg-green-50 py-4 px-10 text-center text-sm text-green-700 border-t">
                Secure • Reliable • Compassionate
            </div>
        </div>
    </li>
</>
@endsection