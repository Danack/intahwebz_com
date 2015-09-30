set -eux -o pipefail

environment="centos_guest,dev"

if [ "$#" -ge 1 ]; then
    environment=$1
fi

echo "environment is ${environment}";

if [ "${environment}" != "centos_guest" ]; then
    imagickdemos_github_access_token=`php bin/info.php "github.access_token"`
    [ -z "${imagickdemos_github_access_token}" ] && echo "Need to set imagickdemos_github_access_token" && exit 1;
    composer config -g github-oauth.github.com ${imagickdemos_github_access_token}
    #Run Composer install to get all the dependencies.
    php -d allow_url_fopen=1 /usr/sbin/composer install --no-interaction --prefer-dist
fi

#need to make dir?
mkdir -p ./var/cache/less
mkdir -p autogen

#Generate the config files for nginx, etc.
#vendor/bin/configurate -p data/config.php data/conf/imageTaskRunner.conf.php autogen/imageTaskRunner.conf $environment
vendor/bin/configurate -p data/config.php data/conf/intahwebz.nginx.conf.php autogen/intahwebz.nginx.conf $environment
vendor/bin/configurate -p data/config.php data/conf/intahwebz.php-fpm.conf.php autogen/intahwebz.php-fpm.conf $environment
vendor/bin/configurate -p data/config.php data/conf/intahwebz.php.ini.php autogen/intahwebz.php.ini $environment
vendor/bin/configurate -p data/config.php data/conf/addIntahwebzConfig.sh.php autogen/addIntahwebzConfig.sh $environment

vendor/bin/genenv -p data/config.php data/envRequired.php autogen/appEnv.php $environment

vendor/bin/fpmconv autogen/imagick-demos.php.ini autogen/imagick-demos.php.fpm.ini 



