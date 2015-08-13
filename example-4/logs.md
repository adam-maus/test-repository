# Installing Logs #

This assumes that you are going to only have one domain on your server.

- Run the following commands:
varnishncsa -a -w /var/log/varnish/access.log -D -P /var/run/varnishncsa.pid

- Visit http://localhost:6081/test-varnish/example-3/get-data.php
- Open /var/log/varnish/access.log to see log
