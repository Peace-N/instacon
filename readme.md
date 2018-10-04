## Welcome to Instacon Media Tool
### Installation
1. Download or clone this repo to your local dev environment
2. Open your Vhosts.conf file and add instacons.localhost an example is below.


        `<VirtualHost *:80>
                ServerName "instacons.localhost"
                DocumentRoot "/Users/peace/Documents/instacons/public/"
                <Directory "/Users/peace/Documents/instacons/public/">
                        Allow From All
                        AllowOverride All
                </Directory>
            </VirtualHost>`

3. Go to the root directory of this project and run ```composer install```
4. Once Composer is done installing dependecies, update the .env file and update the `INSTAGRAM_CLIENT_ID` and `INSTAGRAM_CLIENT_SECRET`
5. Note: You can get the client id and secret from `https://www.instagram.com/developer/clients/manage/`
6. Visit http://instacons.localhost to view the app.

If not Interested in updating your vhosts.conf please run `php artisan serve` from the root of the project

