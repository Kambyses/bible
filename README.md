# bible

Bible from http://www.gasl.org/refbib/Bible_King_James_Version.pdf

## Setting up apache+php environment

Place project files into `/home/<user>/apache-php` directory.

`cd /home/<user>/apache-php`

`docker build -t apache-php .`

`docker run -d -p 80:8080 --name apache-php apache-php`
