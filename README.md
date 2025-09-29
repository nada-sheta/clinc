# Clinic 

## Description
This is a web-based system to manage clinic operations.  
It allows admins, doctors, and patients to interact smoothly and efficiently.

## Features
* Department Management: The website is organized into multiple departments, and each department contains doctors.

* Doctor Management: Admin can add, edit, and delete doctors, as well as create accounts for them.

* Manual Email Sending: When a new doctor is added, the system prepares a login email with credentials. The admin can review and edit this email before sending.

* Booking System: Patients can book appointments with doctors based on the available time slots set by each doctor.

* Booking Reminder: An automatic email reminder is sent to the patient 24 hours before their appointment.

* Doctor Ratings: Patients can rate and review doctors after their appointments.

* AI Chat: Patients can interact with an AI-powered chatbot to ask for medical information.

* Patient Profile: Patients have a profile page where they can view their personal information and all their bookings.

* Doctor Application Form: Doctors who want to join the platform can submit their information through an application form, which is reviewed by the admin.

* Doctor Approval Workflow: Admin can accept or reject doctor applications. If accepted, the admin creates the doctor’s profile and login account (email + password), which is then sent to the doctor via email.

* Doctor Profile: Doctors have a dedicated profile page where they can:

View their ratings and reviews.

Manage their personal data displayed on the site.

Update their session prices.

View and manage patient bookings (cancel if needed).

Set their available schedule for appointments.

* Admin Dashboard: Admin can manage departments, doctors, bookings, and also add new admins.

* API: The system provides an API for integration with other applications or mobile apps.

* Google Login: Users can log in using their Google account.

* Forget Password: Users can reset their password via email if they forget it.

## Installation

1. Clone the repository:
   git clone https://github.com/nada-sheta/clinc
   cd clinic

2. Install dependencies:
composer install
npm install && npm run dev

3. Copy the .env file:
cp .env.example .env

4. Generate application key:
php artisan key:generate

5. Set up your database in .env:
DB_DATABASE=clinic
DB_USERNAME=root
DB_PASSWORD=

6. Run migrations:
php artisan migrate --seed

7. Serve the project:
php artisan serve

8. Mail (Mailtrap for testing)
Configure Mailtrap in .env to send test emails:
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=clinic@example.com
MAIL_FROM_NAME="Clinic System"

9. Cloudinary (for image storage)
Upload and manage images with Cloudinary:
CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME

10. AI Chat API
Enable chatbot using OpenRouter API:
GEMINI_API_KEY=your_api_key

11. Scheduler (Booking Reminder)
To send reminder emails 24h before bookings, ensure the Laravel Scheduler is running.
If using Linux, add this cron job:
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1

If using Windows,, open a terminal inside your project folder and run:
php artisan schedule:run
php artisan schedule:work

12. Queue Worker
Some features (like sending emails) use Laravel queues.  
Make sure you run the queue worker:

On Linux (server):
php artisan queue:work --tries=3

On Windows (local development):
php artisan queue:work

## Usage
Admins: Manage departments, doctors, bookings, and approve/reject doctors.

Doctors: Create schedules, set session price, and manage bookings.

Patients: Register, book appointments, chat with AI, rate doctors, and receive email reminders.

## Tech Stack
Backend: Laravel 10
Frontend: Blade, TailwindCSS
Database: MySQL
Storage: Cloudinary
Mail: Mailtrap
AI: GEMINI API

## License
This project is for educational purposes (graduation project).
