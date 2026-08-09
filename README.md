# DriveCheck: Vehicle Monitoring System 🚓


**DriveCheck** is a state-of-the-art Human Resource Management System (HRMS) and Vehicle Monitoring Portal custom-built for modern law enforcement. Designed with a mobile-first, high-performance architecture, the system digitizes the logging of vehicle checks, automates duty rosters, and provides commanding officers with real-time, actionable analytics to ensure optimal resource deployment and heightened regional security.

**Prepared For:** Superintendent of Police (SP), Botad

---

## 🌟 Core Features & Modules

### 👑 Administrative Command Center
The Admin Portal serves as the nerve center for commanding officers and station administrators, providing absolute oversight over police personnel and operational data.
- **Real-Time Analytics Dashboard:** Features interactive ApexCharts visualizing "Checks by Shift," "Top Checking Points," and a "7-Day Performance Trend."
- **Advanced Duty Roster Management:** Administrators can assign checkpoints, review active shift times, and monitor the real-time "On Duty / Off Duty" status of all personnel.
- **Comprehensive Reporting Engine:** Filter vehicle check data by Police Station, Vehicle Number, or Custom Date Ranges. Reports can be instantly exported to **PDF** and **CSV** for official record-keeping.
- **Personnel Management:** Securely register new police personnel, assign Role-Based access (Admin vs. Employee), and manage deployment locations.

### 👮 Field Officer Interface (Employee Portal)
A streamlined, highly responsive interface designed specifically for officers on the ground, ensuring data entry is fast and effortless, even on mobile devices.
- **My Duty Assignment:** A dynamic, visually distinct dashboard that instantly informs officers of their current shift (Morning, Evening, or Night), assigned checkpoint, and reporting officer.
- **Flexible Duty Time Entry:** Officers can manually punch in their exact duty start and end times using a sleek, native mobile-optimized time picker, automatically categorizing their shift.
- **Digital Vehicle Checking (E-Logging):** 
  - Officers can rapidly log suspicious vehicles, capturing the Person's Name, Vehicle Number, Checkpoint, and Officer ID.
  - **Live Photo Capture:** Integrated camera support allows officers to capture and upload vehicle photos directly from the field.
  - **Smart Remarks:** Officers can log specific outcomes (e.g., "Routine Check," "Issued E-Challan," "Suspicious Activity").

---

## 🎨 UI/UX & Design Excellence

The system was engineered using the premium **Sneat Bootstrap 5 Theme**, ensuring a world-class aesthetic that is both professional and user-friendly.
- **100% Mobile Responsive:** Every table, chart, and form has been meticulously optimized for smartphones and tablets. The dashboard charts automatically stack and resize on mobile screens without squishing.
- **Theme-Consistent Design:** Replaced harsh gradients with clean, corporate-grade status colors (e.g., Soft Yellow for Morning, Soft Blue for Evening, Dark for Night).
- **Dynamic AJAX Interactions:** Data tables, duty shift updates, and form submissions occur instantly without requiring page reloads, providing a seamless "App-like" experience.
- **Professional Branding:** Features a custom, branded footer with secure portal badges and official copyright details.

---

## 🛡️ Security Architecture & Data Integrity

Given the sensitive nature of law enforcement data, DriveCheck implements strict, enterprise-grade security protocols:

| Security Feature | Implementation Details |
| :--- | :--- |
| **Role-Based Access Control (RBAC)** | Strict separation of privileges. Employees cannot access administrative data, analytics, or other officers' logs. Unlawful access attempts are instantly blocked. |
| **CSRF Protection** | Every form submission and AJAX request is cryptographically secured with Cross-Site Request Forgery (CSRF) tokens to prevent malicious automated attacks. |
| **Data Validation & Sanitization** | The Laravel backend enforces strict validation rules (e.g., valid Vehicle number formatting, secure password hashing, sanitized inputs) preventing SQL Injection and XSS attacks. |
| **Secure File Storage** | Captured vehicle photos and officer avatars are stored in isolated, secure storage directories that cannot be executed as malicious scripts. |
| **Session Security** | Automatic session timeouts and secure cookie transmission protect officer accounts on shared station devices. |

---

## 🚀 System Scalability & Tech Stack

The underlying architecture guarantees that the system is ready for district-wide expansion.

**Tech Stack:**
- **Backend:** Laravel 9+ (PHP)
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Sneat Admin Theme, Vanilla JS & AJAX
- **Charts:** ApexCharts
- **Date/Time:** Flatpickr

**Future Readiness:**
- **Dynamic Relational Data:** Shifts, Checkpoints, and User Roles are heavily decoupled, meaning new police stations and hundreds of new officers can be added instantly without code changes.
- **Hardware Integration Ready:** The frontend is pre-configured to handle advanced hardware integrations like automated Number Plate Recognition (ANPR) APIs in future iterations.

---

## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone <repository-url>
   cd DriveCheck
   ```

2. **Install Composer Dependencies:**
   ```bash
   composer install
   ```

3. **Install NPM Packages (if building frontend assets):**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Update your `.env` file with your database credentials.*

5. **Database Migration & Seeding:**
   ```bash
   php artisan migrate --seed
   ```

6. **Storage Link:**
   ```bash
   php artisan storage:link
   ```

7. **Run the Application:**
   ```bash
   php artisan serve
   ```

---

*© 2026 DriveCheck HRMS. Designed for secure and efficient law enforcement operations.*
