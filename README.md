## About Tiny Hands

Tiny hands is a Laravel multi-tenant boilerplate with SPA and i18n using the following technology stack:

### Backend
- Laravel 8.0 
- API with Passport Token
- Roles and Permission using (https://github.com/spatie/laravel-permission)
- Multi-tenancy using (https://github.com/tenancy/tenancy)

### Frontend
- Nuxtjs
- Axios
- Tailwind CSS
- Vue Notification
- Vue i18n
- vform

### Setup
- composer install
- php artisan migrate
- php artisan tenancy:create tenant1                # this will create your first tenant (https://tenant1.tiny-hands.local/)
- php artisan vendor:publish --tag=tiny-hands::ui   # publishes ui from /ui/build to /public
