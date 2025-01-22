<img src="/public/prints/print_home.png"/>

This is my flight manager project.

Here is the step-by-step guide to set up and view the Flight Manager project:

- Grant write permissions to the public folder: "chmod -R 755 public"
- Run "npm run build" to compile assets
- Rename the .env.example file to .env
- Run the database migrations and seed the data using:
  "php artisan migrate"
  "php artisan db:seed"
- Finally, run "php artisan serve"
- If there’s an issue with the template, run "npm run dev"

To make a user an admin and access /admin/flight:

- Open the Tinker shell by running "php artisan tinker"
- Find the user by their name, email, or another identifier. For example, if the user's name is "admin", use:
  "$user = App\Models\User::where('name', 'admin')->first();"
- Set the `is_admin` field to `true`:
  "$user->is_admin = true;"
  "$user->save();"
- Verify the change by checking if the user is now an admin:
  "$user->is_admin;"

As a logged-in user, you can purchase tickets, add money to your wallet, access your profile, and check your tickets.

As an administrator, you will have the same access as a user, in addition to the ability to access the CRUD functionality and view all passengers registered for each flight.




