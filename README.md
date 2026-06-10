# B2B Marketplace

A Laravel 12 + MySQL + Tailwind CSS platform connecting local manufacturers with international buyers.

## Tech Stack

- **Backend**: Laravel 12, PHP 8.4
- **Database**: MySQL (`b2b_db`)
- **Frontend**: Tailwind CSS v4 (via Vite)
- **Auth**: Laravel Auth + Google OAuth (Socialite)
- **Roles**: Spatie Laravel Permission

---

## Quick Start

### 1. Install dependencies
```bash
composer install
npm install
```

### 2. Configure environment
Copy `.env.example` to `.env` and update:
```env
DB_DATABASE=b2b_db
DB_USERNAME=root
DB_PASSWORD=your_password

GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URL=http://localhost/auth/google/callback
```

### 3. Run migrations & seed
```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

### 4. Build assets
```bash
npm run build
# or for development:
npm run dev
```

---

## Demo Credentials

| Role   | Email                    | Password     |
|--------|--------------------------|--------------|
| Admin  | admin@b2bmarket.com      | Admin@1234   |
| Vendor | vendor@b2bmarket.com     | Vendor@1234  |
| User   | user@b2bmarket.com       | User@1234    |

---

## Pages & Features

### Public Website
| Route              | Description                              |
|--------------------|------------------------------------------|
| `/`                | Home — hero, featured vendors/products   |
| `/about`           | About Us page                            |
| `/vendors`         | Browse & filter vendors                  |
| `/vendors/{slug}`  | Vendor detail with product listing       |
| `/products`        | Browse & filter products                 |
| `/products/{slug}` | Product detail with gallery              |
| `/rfq`             | Request for Quotation form               |
| `/contact`         | Contact form                             |
| `/login`           | Login (email + Google OAuth)             |
| `/register`        | Registration                             |
| `/profile`         | User profile management                  |

### Admin Panel (`/admin`)
| Section               | Features                                    |
|-----------------------|---------------------------------------------|
| Dashboard             | Stats, recent vendors, recent RFQs          |
| User Management       | List, edit, role assignment, toggle status  |
| Vendor Categories     | Full CRUD with image upload                 |
| Vendor Management     | Full CRUD, status approval workflow         |
| Product Categories    | Full CRUD                                   |
| Product Subcategories | Full CRUD, linked to parent category        |
| Product Management    | Full CRUD, multi-image gallery upload       |
| RFQ Management        | View, status updates, delete                |
| Contact Messages      | View, mark read, reply via email, delete    |

---

## Google OAuth Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project and enable **Google+ API**
3. Create OAuth 2.0 credentials (Web Application)
4. Add redirect URI: `http://your-domain/auth/google/callback`
5. Copy Client ID and Secret to `.env`

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── Admin/          # All admin panel controllers
│   ├── Auth/           # Auth: Login, Register, Profile, Social
│   ├── HomeController.php
│   ├── VendorController.php
│   ├── ProductController.php
│   ├── RfqController.php
│   └── ContactController.php
├── Models/             # User, Vendor, Product, Category, RFQ, Contact
resources/
├── views/
│   ├── layouts/        # app.blade.php, admin.blade.php
│   ├── admin/          # All admin panel views
│   ├── auth/           # Login, Register, Profile
│   ├── vendors/        # Vendor listing & detail
│   ├── products/       # Product listing & detail
│   ├── rfq/            # RFQ form
│   ├── home.blade.php
│   ├── about.blade.php
│   └── contact.blade.php
database/
├── migrations/         # All database migrations
└── seeders/            # DatabaseSeeder with demo data
```
