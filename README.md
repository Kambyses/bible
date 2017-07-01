# Bible


## Environment

* Windows 10 Home 64-bit
* VMWare Workstation 12 Player https://www.vmware.com/products/player/playerpro-evaluation.html
* Ubuntu 16.04 LTS https://www.ubuntu.com/download/desktop
* Docker https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04


## Data

Bible from http://www.gasl.org/refbib/Bible_King_James_Version.pdf


## Setting up Apache + PHP environment with Docker

Place project files into `/home/$USER/apache-php` directory.

`cd /home/$USER/apache-php`

`docker build -t apache-php .`

`docker run -d -p 80:8080 --name apache-php apache-php`
