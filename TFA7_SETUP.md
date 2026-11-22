# TFA7 setup (continued from TFA6)

This project preserves the TFA6 pages and adds customer/user create and edit forms plus prepared user avatars.

## Install / update dependencies

Run in the project folder:

```powershell
composer update intervention/image --with-all-dependencies
php artisan migrate
php artisan storage:link
php artisan serve
```

The new image dependency is Intervention Image v3, using its GD driver. Ensure PHP's `gd` extension is enabled in XAMPP php.ini. If your instructor requires a specific image package, obtain approval for Intervention Image before submission.

If this is a fresh machine, copy `.env.example` to `.env`, configure the existing TFA6 database settings, run `composer install` after the lock file is updated, then `php artisan key:generate` and `php artisan migrate`.

## Test

- /customers/create: blank name and invalid email should fail; valid data should save.
- /customers/{id}/edit: existing data should appear and save changes.
- /users/create: blank username/full name and duplicate username should fail.
- /users/{id}/edit: unchanged username should pass; duplicate of another user should fail.
- Upload a JPG/PNG/WebP below 2 MB: an image at most 256 x 256 is saved as JPEG on the public disk and its relative path is saved in users.avatar.
- An oversized/non-image upload should fail; users without avatars show the placeholder.

Note: `composer.lock` was supplied with TFA6 and is not regenerated in this package. Run the Composer update command above to synchronize it before installing or deploying. Do not upload `.env` or vendor directories to GitHub.
