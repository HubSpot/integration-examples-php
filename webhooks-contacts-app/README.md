# HubSpot-php sample Webhooks app

This is a sample app for the [hubspot-php SDK](https://github.com/ryanwinchester/hubspot-php). Currently, this app focuses on demonstrating the functionality of [Webhooks API](https://developers.hubspot.com/docs/methods/webhooks/webhooks-overview) endpoints and their related actions.

### HubSpot Public API links used in this application

### Setup App

Make sure you have [Docker Compose](https://docs.docker.com/compose/) and [Ngrok](https://ngrok.com/) installed.

### Configure

1. Copy .env.template to .env
2. Paste your HUBSPOT_CLIENT_ID and HUBSPOT_CLIENT_SECRET

### Running

The best way to run this project (with the least configuration), is using docker compose.  Change to the webroot and start it

```bash
docker-compose up
```

Copy Ngrok url from console. Now you should now be able to navigate to that url and use the application.
Required web hooks url should look like https://***.ngrok.io/webhooks/handle.php
