# Bible

## Description

This is a _how to_ project for learning purposes with little practical outcome.
* How to setup virtual machine on a Windows 10 with Ubuntu 16.
* How to setup web server Apache + PHP + PostgreSQL on Ubuntu with Docker.
* How to import data from text file to database.


## Environment

* Windows 10 Home 64-bit
* VMWare Workstation 12 Player https://www.vmware.com/products/player/playerpro-evaluation.html
* Ubuntu 16.04 LTS https://www.ubuntu.com/download/desktop
* Docker https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-16-04
* Apache + PHP 5.6.30 https://hub.docker.com/_/php/
* PostgreSQL 9 + PostGIS  https://hub.docker.com/r/mdillon/postgis/


## Data

Bible from http://www.gasl.org/refbib/Bible_King_James_Version.pdf


## Setting up Apache + PHP + PostgreSQL environment with Docker

[Contribution guidelines for this project](docs/CONTRIBUTING.md)

* Install VMWare Workstation 12 Player.
* Setup VMWare virtual machine.
* Install Ubuntu 16.04 on virtual machine.
* Create project folder on Windows
* [Share this folder to Ubuntu]:[help/03. Sharing between Windows host and Ubuntu VM.md]
* Install Docker on Ubuntu.
* Place project files into Ubuntu `/home/$USER/apache-php` directory.
* Install Apache + PHP + PostgreSQL on Ubuntu:
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

## Usage

* What's my web address and port?
```
# Inspect apache-php
docker inspect apache-php

# locate parameters:
# IP aadress: HostConfig -> PortBindings -> HostIp  or  NetworkSettings -> Networks -> bridge -> IPAddress
# Port:       HostConfig -> PortBindings -> HostPort
```

* What's my database host, port, name, user and password?
```
# Inspect postgresql
docker inspect postgresql

# locate parameters:
# host:      NetworkSettings -> Networks -> bridge -> IPAddress
# port:      NetworkSettings -> Ports
# database:  Config -> Env -> POSTGRES_DB
# username:  Config -> Env -> POSTGRES_USER
# password:  Config -> Env -> POSTGRES_PASSWORD
```
