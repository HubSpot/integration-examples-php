# HubSpot-php sample Timeline app

This is a sample app for the [hubspot-php SDK](https://github.com/HubSpot/hubspot-php). 
Currently, this app focuses on demonstrating the functionality of [Timeline API](https://developers.hubspot.com/docs/methods/timeline/timeline-overview).

### Setup App

Make sure you have [Docker Compose](https://docs.docker.com/compose/).

### Configure

1. Copy .env.template to .env
2. Paste your HUBSPOT_CLIENT_ID and HUBSPOT_CLIENT_SECRET

### Running

The best way to run this project (with the least configuration), is using docker compose.  Change to the webroot and start it

```bash
docker-compose up --build
```
You should now be able to navigate to [http://localhost:8999](http://localhost:8999) and use the application.
