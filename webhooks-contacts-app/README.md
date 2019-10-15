# HubSpot-php sample Webhooks app

This is a sample app for the [hubspot-php SDK](https://github.com/ryanwinchester/hubspot-php). 
Currently, this app focuses on demonstrating the functionality of [Webhooks API](https://developers.hubspot.com/docs/methods/webhooks/webhooks-overview), contact creation/deletion in particular.

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

### Configure webhooks

Required webhooks url should look like https://***.ngrok.io/webhooks/handle.php

Following [Webhooks Setup](https://developers.hubspot.com/docs/methods/webhooks/webhooks-overview) guide please note:
- Every time the app is restarted you should update the webhooks url
- The app supports `contact.creation` and `contact.deletion` subscription types only
- Subscription are paused by default. You need to activate them manually after creating
