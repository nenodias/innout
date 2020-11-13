# In 'n Out
Sistema de ponto web desenvolvido ao longo do curso de php da Cod3r.
[Link Cod3r](https://www.cod3r.com.br/courses/php) [Link Udemy](https://www.udemy.com/course/php-7-completo)

#### Config
No arquivo config.php existe a constante PREFIX a mesma é usada para setar o contexto da aplicação.
Porém tabém é necessário um ajuste no arquivo .htaccess dentro da pasta public

```
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . innout/ [L]
</IfModule>
```

Onde o innout/ deverá ser alterado para o contexto da sua aplicação.
Por exemplo se a aplicação for hospedada em localhost/app o .htaccess seria.

```
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . app/ [L]
</IfModule>
```
