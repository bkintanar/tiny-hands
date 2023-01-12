## About Tiny Hands

Tiny hands is a Laravel multi-tenant boilerplate with SPA and i18n using the following technology stack:

### Backend
- Laravel 9.0 
- API with Passport Token
- Roles and Permission using (https://github.com/spatie/laravel-permission)
- Multi-tenancy using (https://github.com/tenancy/tenancy)

### Frontend
- Nuxtjs v3
- Vue 3
- Fetch
- Tailwind CSS
- Vue Notification
- Vue i18n
- Pinia

### Out of the box Setup
- `composer install`
- `php artisan migrate`
- `php artisan tenancy:create tenant1`                  # this will create your first tenant (https://tenant1.tiny-hands.test/)
- `php artisan vendor:publish --tag=tiny-hands::ui`     # publishes ui from `/ui/.output/public` to `/public`

### Compiling and publishing UI assets
UI assets resides in the `/ui` directory. It's a Nuxtjs installation. You can read more about Nuxtjs on their website (https://nuxtjs.org).
You can modify the UI to your liking which you will then need to rebuild and regenerate them.
- `cd ui`
- `yarn`
- `yarn build`
- `yarn generate`                                       # the generated assets will now reside in `/ui/.output`
- `cd ../public`                                        # remove the files you see inside this directory that is also in the directory `/ui/.output/public`
- `cd ..`                                               # cd back to the root of the project
- `php artisan vendor:publish --tag=tiny-hands::ui`     # publishes ui from `/ui/.output/public` to `/public`
