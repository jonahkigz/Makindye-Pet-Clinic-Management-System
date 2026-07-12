
# 🐾 Makindye Pet Clinic Management System (MPCMS)

<p align="center">
  <h3 align="center">Petcare, Our Priority.</h3>
  <p align="center">
    <strong>Healthier Pets, Happier Families.</strong>
  </p>
</p>

-

## 📖 Overview

The **Makindye Pet Clinic Management System (MPCMS)** is a modern, web-based Veterinary Clinic Management System developed using **Laravel 12**. The system digitizes veterinary clinic operations by providing secure management of pets, pet owners, appointments, medical records, inventory, billing, payments, and reports through an intuitive enterprise-grade interface.

Designed with an eco-friendly aesthetic and Role-Based Access Control (RBAC), MPCMS improves operational efficiency while delivering a seamless user experience for veterinary professionals and pet owners.

-

# ✨ Key Features

## 🔐 Authentication

- Secure Login & Logout
- Password Encryption
- Session Management
- Form Validation



## 👥 Role-Based Access Control (RBAC)

The system supports four user roles:

- 👑 Administrator
- 👨‍⚕️ Veterinarian
- 🧑‍💼 Receptionist
- 🐶 Pet Owner

Each role has customized dashboards, permissions, and accessible modules.

-

## 📊 Dashboard

- Real-time Statistics
- Appointment Overview
- Revenue Analytics
- Registered Pets
- Registered Owners
- Low Stock Alerts
- Activity Timeline
- Interactive Charts

-

## 👤 User Management

Administrators can:

- Create Users
- View Users
- Edit Users
- Delete Users
- Assign Roles

-

## 🐾 Pet Owner Management

- Register Owners
- Update Owner Profiles
- Search Owners
- View Owner History

-

## 🐕 Pet Management

- Register Pets
- Breed Information
- Species
- Medical History
- Vaccination Records
- Owner Assignment

-

## 📅 Appointment Management

- Schedule Appointments
- Appointment Calendar
- Consultation Tracking
- Appointment Status
- Appointment History

-

## 🩺 Medical Records

- Symptoms
- Diagnosis
- Treatment
- Prescriptions
- Consultation Notes
- Vaccination Records

-

## 💳 Billing & Payments

- Invoice Generation
- Payment Recording
- Outstanding Balances
- Payment History

-

## 💊 Inventory Management

- Medicines
- Products
- Services
- Stock Monitoring
- Low Stock Notifications

-

## 📈 Reports

Generate reports for:

- Clinic Operations
- Revenue
- Inventory
- Users
- Pets
- Appointments
- Medical Records

-

# 🛠 Technology Stack

## Backend

- Laravel 12
- PHP 8.2
- MySQL
- Eloquent ORM

## Frontend

- Blade Templates
- Tailwind CSS
- JavaScript
- Vite

## Libraries

- Chart.js
- Laravel Authentication
- Laravel Validation

-

# 🎨 UI Design

MPCMS follows a modern SaaS-inspired interface featuring:

- Eco-friendly color palette
- Glassmorphism-inspired cards
- Responsive layouts
- Smooth animations
- Modern typography
- Professional dashboard
- Mobile-friendly design

Primary Colors

- 🌿 Emerald Green
- 🌲 Forest Green
- 🤍 Cream White
- 🌱 Soft Beige

-

# 🔒 Security

- Password Hashing
- CSRF Protection
- Route Middleware
- Authentication
- RBAC
- SQL Injection Prevention
- XSS Protection
- Request Validation

-

# 📂 Project Structure

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

-

# 🚀 Installation

Clone the repository

```bash
git clone https://github.com/jonahkigz/mpcms.git
```

Navigate into the project

```bash
cd mpcms
```

Install PHP dependencies

```bash
composer install
```

Install JavaScript dependencies

```bash
npm install
```

Copy environment file

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure your database credentials in `.env`

Run migrations

```bash
php artisan migrate
```

(Optional)

```bash
php artisan db:seed
```

Compile frontend assets

```bash
npm run dev
```

Start the application

```bash
php artisan serve
```

Visit

```
http://127.0.0.1:8000
```

-

# 👥 User Roles

## 👑 Administrator

- Full System Access
- User Management
- Reports
- Inventory
- Billing
- System Configuration

---

## 👨‍⚕️ Veterinarian

- Medical Records
- Appointments
- Consultations
- Pet Management

---

## 🧑‍💼 Receptionist

- Register Owners
- Register Pets
- Book Appointments
- Billing
- Payments

---

## 🐶 Pet Owner

- View Personal Pets
- View Medical History
- View Appointments
- View Invoices

---

# 📸 Screenshots

> Screenshots will be added as development progresses.

- Login Page
- Administrator Dashboard
- User Management
- Pet Management
- Appointment Scheduling
- Medical Records
- Inventory
- Billing
- Reports

---

# 🔮 Future Enhancements

- SMS Notifications
- Email Notifications
- QR Code Pet Identification
- AI-assisted Diagnosis
- Online Appointment Booking
- Online Payments
- REST API
- Mobile Application
- Cloud Deployment
- Multi-Clinic Support

---

# 🤝 Contributing

Contributions are welcome.

1. Fork the repository
2. Create your feature branch

```bash
git checkout -b feature/NewFeature
```

3. Commit your changes

```bash
git commit -m "Add New Feature"
```

4. Push the branch

```bash
git push origin feature/NewFeature
```

5. Open a Pull Request

---

# 📄 License

Under way.

---

# 👨‍💻 Developer

**Jonathan Kigozi**

GitHub: https://github.com/jonahkigz

---

<p align="center">
Made with ❤️ using Laravel 12
<br>
Makindye Pet Clinic Management System (MPCMS)
</p>

@extends('layouts.guest')

@section('content')
<div
    class="min-h-screen bg-cover bg-center bg-no-repeat flex items-center justify-center px-4 py-8"
    style="background-image: url('{{ asset('loginbg.png') }}');"
>
    <div class="w-full max-w-7xl grid grid-cols-1 lg:grid-cols-2 items-center gap-8">
        
        <!-- Left content area -->
        <div class="hidden lg:flex flex-col justify-center px-8">
            <div class="max-w-xl">
                <h1 class="text-6xl font-extrabold text-green-800 leading-none">MPCMS</h1>
                <p class="mt-4 text-2xl text-green-900 font-medium">
                    Makindye Pet Clinic Management System
                </p>

                <div class="mt-8 flex items-center gap-4 text-green-700">
                    <div class="h-px w-24 bg-green-500"></div>
                    <span class="text-2xl">🐾</span>
                    <div class="h-px w-24 bg-green-500"></div>
                </div>

                <p class="mt-6 text-3xl italic text-green-800">
                    Petcare, Our Priority
                </p>

                <p class="mt-4 text-lg text-green-700">
                    Healthier Pets, Happier Families
                </p>
            </div>
        </div>

        <!-- Right login card -->
        <div class="flex justify-center lg:justify-end">
            <div class="w-full max-w-xl bg-white/95 backdrop-blur-sm rounded-[2rem] shadow-2xl p-8 md:p-10 border border-white/60">
                
                <!-- Top icon -->
                <div class="flex justify-center">
                    <div class="w-24 h-24 rounded-full border-4 border-green-100 shadow-md flex items-center justify-center text-4xl bg-white text-green-700">
                        🐾
                    </div>
                </div>

                <div class="text-center mt-6">
                    <h2 class="text-4xl font-extrabold text-green-800">Welcome Back</h2>
                    <p class="mt-2 text-gray-600 text-lg">Sign in to continue to your dashboard</p>
                </div>

                <div class="flex items-center gap-4 my-6">
                    <div class="flex-1 h-px bg-gray-300"></div>
                    <span class="text-green-700 text-xl">🐾</span>
                    <div class="flex-1 h-px bg-gray-300"></div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 mb-4 rounded-lg">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-green-900 font-semibold mb-2">
                            Email Address
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-2xl overflow-hidden focus-within:ring-2 focus-within:ring-green-500 bg-white">
                            <div class="bg-green-600 text-white px-4 py-4 text-lg">
                                ✉
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                class="w-full px-4 py-4 outline-none text-gray-700"
                                required
                                autofocus
                            >
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-green-900 font-semibold mb-2">
                            Password
                        </label>
                        <div class="flex items-center border border-gray-300 rounded-2xl overflow-hidden focus-within:ring-2 focus-within:ring-green-500 bg-white">
                            <div class="bg-green-600 text-white px-4 py-4 text-lg">
                                🔒
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                class="w-full px-4 py-4 outline-none text-gray-700"
                                required
                            >
                            <div class="px-4 text-gray-500">
                                👁
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-gray-700">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            <span>Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-green-700 hover:text-green-800 font-medium">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-green-700 hover:bg-green-800 text-white font-bold text-2xl py-4 rounded-2xl shadow-lg transition duration-200"
                    >
                        🐾 Login
                    </button>
                </form>

                <div class="mt-8 text-center text-gray-600">
                    <p class="text-base">
                        Secure • Reliable • Compassionate
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
