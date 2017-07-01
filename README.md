# Bible


## Environment

* Windows 10 Home 64-bit
* VMWare Workstation 12 Player https://www.vmware.com/products/player/playerpro-evaluation.html
* Ubuntu 16.04 LTS https://www.ubuntu.com/download/desktop
* Docker https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04
* Apache
* PHP 5.6.30
* PostgreSQL 9 + PostGIS


## Data

Bible from http://www.gasl.org/refbib/Bible_King_James_Version.pdf


## Setting up Apache + PHP + PostgreSQL environment with Docker

* VMWare Workstation 12 Player
* Setup virtual machine + Ubuntu 16.04
* Install Docker
* Place project files into `/home/$USER/apache-php` directory.
```
# go to project directory
cd /home/$USER/apache-php

# build apache-php docker image
docker build -t apache-php .

# run apache-php docker container
docker run -d -p 80:8080 --name apache-php apache-php

# install & run PostgreSQL + PostGIS
docker run --name postgresql -e POSTGRES_PASSWORD=mysecretpassword -d mdillon/postgis
```

## Usage




## Useful commands

```
# Copy files into apache-php docker container
docker cp -a /home/$USER/apache-php/www/ apache-php:/var/www/html/

# Browse apache-php docker container files & directories
docker exec apache-php ls /var/www/html/

# Stop apache-php
docker stop apache-php

# Start apache-php
docker start apache-php

# Inspect apache-php
docker inspect apache-php

# List docker containers
docker ps -a

# Remove apache-php docker container
docker rm apache-php

# Remove apache-php docker image
docker rmi apache-php
```
