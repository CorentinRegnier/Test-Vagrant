## Test Vagrant (SYMFONY 3)
### Installattion

- $ git clone git@github.com:MWCorentin/Test-vagrant.git

- in your project folder run `composer install`

- add `192.168.33.7    test-vagrant.sf` in your hosts file
    - `/etc/hosts` on Linux and MAC
    - `C:\WINDOWS\system32\drivers\etc\hosts` on Windows

- in your project folder run `vagrant up`

- in your project folder run `vendor/bin/phing update:dev`

- go to http://test-vagrant.sf/app_dev.php/

- accces to vm phpmyadmin : http://test-vagrant.sf/phpmyadmin