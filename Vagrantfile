# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "puphpet/ubuntu1404-x64"

  config.vm.network "private_network", ip: "192.168.33.51"
  #config.vm.synced_folder ".", "/var/www/html", :owner=> 'vagrant', :group=>'vagrant', :mount_options => ['dmode=777', 'fmode=777']
  config.vm.synced_folder ".", "/var/www/html", nfs: true
  config.vm.provider "virtualbox" do |vb|
    vb.memory = "512"
    vb.cpus = "2"  end

  config.vm.provision :shell, path: "provision.sh"

end
