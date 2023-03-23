# One-Hospital
## Description:
A website made using Laravel/ PHP that simulates a hospital reservation system in which the user may schedule a doctor appointment on a
specified day and receive an email response with acceptance or rejection, and the admin can control the list of physicians by Creating, Reading,
Updating, or Deleting any of the doctors. Moreover, admin is tasked with permitting or rejecting any user reservations.
### - User Can:
1. Register using the conventional registering information (Name - Email - Password) and, for assurance, an email confirmation will be sent to
the user's email to confirm the registering process.
2. Reserve a medical appointment with the desired field and will receive an automatic email confirming the reservation details and a request
to wait for an email from the admin approving or rejecting the reservation to respond accordingly.
3. To gain access to personalized data, log in with the registered email address and password.
4. access to the appointments list, where the user may verify the appointments that they reserved and cancel them if anything changes.
### - Admin Can:
1. Login using the assigned credentials (Email - Password)
2. Control the available doctors list by adding, editing, removing any doctor's information
3. Review and respond to the user reserved appointment by rejection or approving and user will recevie an automated email with the
approval or rejection describing the next step

## Packages Used:
• Jetstream: provides the implementation for your application's login, registration, email verification, two-factor authentication, session
management, API via Laravel Sanctum
<br>
• Carbon: provides some nice functionality to deal with dates in PHP. Specifically things like: Dealing with timezones. Getting current time
easily.
