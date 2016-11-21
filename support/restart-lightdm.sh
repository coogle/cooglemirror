#!/bin/bash

# To be able to restart LightDM from Apache make sure you add the following
# to /etc/sudoers
#
# www-data ALL=(ALL) NOPASSWD:/usr/local/bin/restart-lightdm.sh
#
# and place this script in /usr/local/bin with +x permissions

/usr/bin/nohup /usr/sbin/service lightdm restart