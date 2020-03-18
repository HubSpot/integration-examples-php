# HubSpot PHP Retry Middleware Sample App

This is a sample app for the [hubspot-php SDK](https://github.com/hubspot/hubspot-php). 
Currently, this app focuses on demonstrating the retry middleware mechanism. It will be useful for you if you often reach rate limit (429 http error).

### HubSpot Public API endpoints used in this application

  - [Contacts](https://developers.hubspot.com/docs/methods/lists/contact-lists-overview)
  - [OAuth](https://developers.hubspot.com/docs/methods/oauth2/oauth2-overview)

### Setup App

Make sure you have [Docker Compose](https://docs.docker.com/compose/) installed.

### Configure

1. Copy .env.template to .env
2. Paste your HUBSPOT_CLIENT_ID and HUBSPOT_CLIENT_SECRET

### Running

The best way to run this project (with the least configuration), is using docker compose.  Change to the webroot and start it

```bash
docker-compose up --build
```
You should now be able to navigate to [http://localhost:8999](http://localhost:8999). 
Firstly you will need to authorize via OAuth there.
Than you can to go to the terminal window and start the following command in the application root

```bash
docker-compose exec web php /app/src/console/example.php
```

Please note this app starts a few workers in order to reach rate limit.

Pay attention on [HubspotClientHelper](src/Helpers/HubspotClientHelper.php).
It generates a custom client with reties middlewares and pass this client to HubSpot Factory.
