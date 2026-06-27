# 🐾 Makindye Pet Clinic Management System (MPCMS)

<p align="center">
  <h3 align="center">Petcare, Our Priority.</h3>
  <p align="center">
    <strong>Healthier Pets, Happier Families.</strong>
  </p>
</p>

---

## 📖 Overview

The **Makindye Pet Clinic Management System (MPCMS)** is a modern, web-based Veterinary Clinic Management System developed using **Laravel 12**. The system digitizes veterinary clinic operations by providing secure management of pets, pet owners, appointments, medical records, inventory, billing, payments, and reports through an intuitive enterprise-grade interface.

Designed with an eco-friendly aesthetic and Role-Based Access Control (RBAC), MPCMS improves operational efficiency while delivering a seamless user experience for veterinary professionals and pet owners.

---

# ✨ Key Features

## 🔐 Authentication

- Secure Login & Logout
- Password Encryption
- Session Management
- Form Validation

---

## 👥 Role-Based Access Control (RBAC)

The system supports four user roles:

- 👑 Administrator
- 👨‍⚕️ Veterinarian
- 🧑‍💼 Receptionist
- 🐶 Pet Owner

Each role has customized dashboards, permissions, and accessible modules.

---

## 📊 Dashboard

- Real-time Statistics
- Appointment Overview
- Revenue Analytics
- Registered Pets
- Registered Owners
- Low Stock Alerts
- Activity Timeline
- Interactive Charts

---

## 👤 User Management

Administrators can:

- Create Users
- View Users
- Edit Users
- Delete Users
- Assign Roles

---

## 🐾 Pet Owner Management

- Register Owners
- Update Owner Profiles
- Search Owners
- View Owner History

---

## 🐕 Pet Management

- Register Pets
- Breed Information
- Species
- Medical History
- Vaccination Records
- Owner Assignment

---

## 📅 Appointment Management

- Schedule Appointments
- Appointment Calendar
- Consultation Tracking
- Appointment Status
- Appointment History

---

## 🩺 Medical Records

- Symptoms
- Diagnosis
- Treatment
- Prescriptions
- Consultation Notes
- Vaccination Records

---

## 💳 Billing & Payments

- Invoice Generation
- Payment Recording
- Outstanding Balances
- Payment History

---

## 💊 Inventory Management

- Medicines
- Products
- Services
- Stock Monitoring
- Low Stock Notifications

---

## 📈 Reports

Generate reports for:

- Clinic Operations
- Revenue
- Inventory
- Users
- Pets
- Appointments
- Medical Records

---

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

---

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

---

# 🔒 Security

- Password Hashing
- CSRF Protection
- Route Middleware
- Authentication
- RBAC
- SQL Injection Prevention
- XSS Protection
- Request Validation

---

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

---

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

---

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
