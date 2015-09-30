
set -eux -o pipefail

environment="centos_guest,dev"

find . -name "*.sh" -exec chmod 755 {} \;

su intahwebz -c "./scripts/deployAsUser.sh ${environment}"

sh ./autogen/addIntahwebzConfig.sh