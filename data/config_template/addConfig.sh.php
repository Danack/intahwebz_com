<?php

$config = <<< END

rm -f /etc/nginx/sites-enabled/intahwebz.nginx.conf
rm -f /etc/php-fpm.d/intahwebz.php-fpm.conf
rm -f /etc/php-fpm.d/intahwebz.php.fpm.ini

ln -sfn ${'intahwebz.root.directory'}/autogen/nginx.conf /etc/nginx/sites-enabled/intahwebz.nginx.conf
ln -sfn ${'intahwebz.root.directory'}/autogen/php-fpm.conf /etc/php-fpm.d/intahwebz.php-fpm.conf
ln -sfn ${'intahwebz.root.directory'}/autogen/php.fpm.ini /etc/php-fpm.d/intahwebz.php.fpm.ini

END;

return $config;
