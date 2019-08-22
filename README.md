hypeApi
=======
![Elgg 3.0](https://img.shields.io/badge/Elgg-3.0-orange.svg?style=flat-square)

JWT token exchange and auth

Make sure Apache handles Authorization headers. Add the following to your `.htaccess`

```
RewriteEngine on
RewriteCond %{HTTP:Authorization} ^(.*)
RewriteRule .* - [e=HTTP_AUTHORIZATION:%1]
```