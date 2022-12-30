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

### Out of the box Setup
- `composer install`
- `php artisan migrate`
- `php artisan tenancy:create tenant1`                  # this will create your first tenant (https://tenant1.tiny-hands.local/)
- `php artisan vendor:publish --tag=tiny-hands::ui`     # publishes ui from `/ui/build` to `/public`

### Compiling and publishing UI assets
UI assets resides in the `/ui` directory. It's a Nuxtjs installation. You can read more about Nuxtjs on their website (https://nuxtjs.org).
You can modify the UI to your liking which you will then need to rebuild and regenerate them.
- `cd ui`
- `yarn`
- `yarn build`
- `yarn generate`                                       # the generated assets will now reside in `/ui/build`
- `cd ../public`                                        # remove the following files and directory if they existed
                                                        # `/_nuxt`, `favicon.ico`, `index.html`, `README.md`
- `cd ..`                                               # cd back to the root of the project
- `php artisan vendor:publish --tag=tiny-hands::ui`     # publishes ui from `/ui/build` to `/public`
