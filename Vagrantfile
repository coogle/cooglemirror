# -*- mode: ruby -*-
# vi: set ft=ruby :

# Usage: ENV=staging vagrant up

VAGRANTFILE_API_VERSION = "2"

require 'json'

localConf = JSON.parse(File.read('VagrantConfig.json'))

environment = "development"
if ENV["ENV"] && ENV["ENV"] != ''
    environment = ENV["ENV"].downcase
end

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.provision :shell, :path => "puppet_bootstrap.sh"
    config.vm.provision "shell", inline: <<-SHELL
     sudo apt-get update
     sudo apt-get -y install dkms
    
     #https://wiki.ubuntu.com/Audio/UpgradingAlsa/DKMS
     wget http://ppa.launchpad.net/ubuntu-audio-dev/alsa-daily/ubuntu/pool/main/o/oem-audio-hda-daily-dkms/oem-audio-hda-daily-dkms_0.201509251532~ubuntu14.04.1_all.deb
     sudo dpkg -i oem-audio-hda-daily-dkms_0.201509251532~ubuntu14.04.1_all.deb
     rm oem-audio-hda-daily-dkms_0.201509251532~ubuntu14.04.1_all.deb
     sudo apt-get -y install python-dev ipython python-numpy python-matplotlib python-scipy cython alsa-utils paman
     sudo usermod -a -G audio vagrant
  SHELL
    
    if environment == 'development'
      config.vm.box = "ubuntu/trusty64"
      config.vm.box_url = "http://files.vagrantup.com/precise64.box"
    
      config.vm.network :forwarded_port, guest: 80,    host: 10080    # apache http
      config.vm.network :forwarded_port, guest: 3306,  host: 3306  # mysql
      config.vm.network :forwarded_port, guest: 10081, host: 10081 # zend http
      config.vm.network :forwarded_port, guest: 10082, host: 10082 # zend https
    
      config.vm.network :private_network, ip: localConf['ipAddress']
    
        config.vm.provider :virtualbox do |vb, override|
            
            vb.gui = false
            vb.customize ["modifyvm", :id, "--memory", localConf['vmMemory']]
            vb.customize ["modifyvm", :id, "--cpuexecutioncap", "90"]
			vb.customize ["modifyvm", :id, '--audio', 'coreaudio', '--audiocontroller', 'hda']
            vb.customize ["setextradata", :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/vagrant-root", "1"]


            host = RbConfig::CONFIG['host_os']

            if host =~ /darwin/
               cpus = `sysctl -n hw.ncpu`.to_i
            elsif host =~ /linux/
               cpus = `nproc`.to_i
            else
               cpus = 2
            end

            vb.customize ["modifyvm", :id, "--cpus", cpus]
            config.vm.synced_folder ".", "/vagrant",  nfs: true    
        end
    
        config.vm.provision :puppet do |puppet|
            puppet.options        = "--verbose --debug"
            puppet.manifests_path = "puppet/manifests"
            puppet.module_path    = "puppet/modules"
            puppet.manifest_file  = "site.pp"
            puppet.facter         = {
                "vagrant"     => true,
                "environment" => environment,
                "site_domain" => localConf['siteDomain'],
                "role"        => "local",
                "awsAccessKey" => localConf['aws']['accessKey'],
                "awsSecretKey" => localConf['aws']['secretKey'],
                "php_version" => localConf['phpVersion']
            }
        end
    end
    
    if environment == 'ec2'
        config.vm.provision :shell, :path => "aws_bootstrap.sh"
        config.vm.box = "dummy"

        config.vm.provider :aws do |aws, override|
            aws.access_key_id     = localConf['aws']['accessKey']
            aws.secret_access_key = localConf['aws']['secretKey']
            aws.instance_type     = localConf['aws']['instanceType']
            aws.region            = localConf['aws']['region']
            aws.security_groups   = localConf['aws']['securityGroups']
            aws.tags              = {
                "environment" => environment,
                "elastic_ip"  => localConf['aws']['elasticIP'],
                "Name"        => localConf['aws']['name']
            }

            aws.region_config localConf['aws']['region'] do |region|
                region.ami          = localConf['aws']['ami']
                region.keypair_name = localConf['aws']['keyPair']
            end

            override.ssh.username         = "ubuntu"
            override.ssh.private_key_path = "~/.ssh/appdemos.pem"
        end

        config.vm.provision :puppet do |puppet|
            puppet.options        = "--verbose --debug"
            puppet.manifests_path = "puppet/manifests"
            puppet.module_path    = "puppet/modules"
            puppet.manifest_file  = "site.pp"
            puppet.facter         = {
                "site_domain" => localConf['siteDomain'],
                "environment" => environment,
                "aws_access_key" => localConf['aws']['accessKey'],
                "aws_secret_key" => localConf['aws']['secretKey'],
                "php_version" => localConf['phpVersion']
            }
        end
    end
end

$BOOTSTRAP_SCRIPT = <<EOF
  set -e # Stop on any error
  # --------------- SETTINGS ----------------
  # Other settings
  export DEBIAN_FRONTEND=noninteractive
  sudo apt-get update
  # ---- OSS AUDIO
  sudo usermod -a -G audio vagrant
  sudo apt-get install -y oss4-base oss4-dkms oss4-source oss4-gtk linux-headers-3.2.0-23 debconf-utils
  sudo ln -s /usr/src/linux-headers-$(uname -r)/ /lib/modules/$(uname -r)/source || echo ALREADY SYMLINKED
  sudo module-assistant prepare
  sudo module-assistant auto-install -i oss4 # this can take 2 minutes
  sudo debconf-set-selections <<< "linux-sound-base linux-sound-base/sound_system select  OSS"
  echo READY.
  # have to reboot for drivers to kick in, but only the first time of course
  if [ ! -f ~/runonce ]
  then
    sudo reboot
    touch ~/runonce
  fi
EOF
