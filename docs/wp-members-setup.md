# Setup of WP-Members
*Settings->WP-Members*

## WP-Members options

* Setup Content Blocking for Specials as ```Do not block```
* Show Login Form ```Specials```
* Notify admin ```yes```
* Enable Captcha ```reCAPTCHA```
* Create pages for Login ```/vip```, Register Page ```/vip/register```, and User Profile Page ```/vip/profile```
* Update Pages: Login, Register and User Profile Page in wp-members options to the pages that was just created.
* Update stylesheet to Use Custom URL Below and don't add any url

## Emails

* set custom email address and email name.

### New Registration

Subject : ```Your Registration Info for the [blogname] VIP Club```
Body:
```
Thank you for registering for the [blogname] VIP Club!

Your registration was successful and your account credentials are below. We suggest you save this information in a place that will be handy for future reference.

username: [username]


You can log into the VIP Club through this link:
[login]

You can also change your password through this link:
[user-profile]

We look forward to seeing you soon!

The team at [blogname]
```

### Password Reset

Subject: ```Password Reset for the [blogname] VIP Club```
Body:
```
Thank you for your inquiry! Your password for the [blogname] VIP Club has been reset. Your new password is included below:

Password: [password]

Sincerely,

The team at [blogname]

```

### Retrive Username

Subject: ```Your Username for the [blogname] VIP Club```
Body:
```
Thank you for your inquiry! Your username for the [blogname] VIP Club is below:

Username: [username]

Sincerely,

The team at [blogname]
```

### Admin Notification

Subject: ```New User Registration for the [blogname] VIP Club ```
Body:
```
The following user registered for the [blogname] VIP Club:

Username: [username]
Email: [email]

[fields]

This user registered here:
[reglink]

User IP Address: [user-ip]
```

## Captcha
*Setup site key and secret key*
