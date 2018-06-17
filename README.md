# seat-groups
With this [SeAT](https://github.com/eveseat/seat) Package you can create `auto`, `opt-in`, `managed` and `hidden` groups 
which correlate to SeAT-Roles.

[![Latest Stable Version](https://poser.pugx.org/herpaderpaldent/seat-groups/v/stable)](https://packagist.org/packages/herpaderpaldent/seat-groups)
[![Maintainability](https://api.codeclimate.com/v1/badges/ec32c88b40e1407ede38/maintainability)](https://codeclimate.com/github/herpaderpaldent/seat-groups/maintainability)
[![License](https://poser.pugx.org/herpaderpaldent/seat-groups/license)](https://packagist.org/packages/herpaderpaldent/seat-groups)
[![Total Downloads](https://poser.pugx.org/herpaderpaldent/seat-groups/downloads)](https://packagist.org/packages/herpaderpaldent/seat-groups)

***Important**: seat-groups are work in progress and certainly have some bugs
please do report any findings to seat-slack and report it as an issue*

## Installation

1. cd to `/var/www/seat`
2. enter `composer require KingVoodoo/careers`
3. Publish `php artisan vendor:publish --force --all`
4. run migration `php artisan migrate`

## Screenshots

![GroupSetup](https://i.imgur.com/7qElUyB.png)

![Overview](https://i.imgur.com/Yo6Ugyk.png)

## SeAT Groups

### auto group
Members of set corporation are getting assigned the corresponding roles

### A.L.O.T.S
Members of set corporation can opt-in into a seat group and get then assigned
the corresponding roles

### Omega Careers
Members may apply for these groups. Managers may accept or deny the application
![Managed](https://i.imgur.com/mYB30rZ.png)

### hidden groups
This seat group is for hidden groups f.e. CEO. This group is only shown on the overview for users with `seatgroup.create` and `superuser` Permission.
![Hidden](https://i.imgur.com/mh3I714.png)


