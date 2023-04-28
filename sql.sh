server {
    listen 80;
    listen [::]:80 default_server;
    root /home/MYUSERNAME/site/;
    index index.php index.html;
    server_name example.com;
    access_log /home/MYUSERNAME/access.log;
    error_log /home/MYUSERNAME/error.log;
    location / {
        try_files $uri $uri/ =404;
    
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.4-fpm.sock;
        