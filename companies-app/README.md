# HubSpot-php sample Companies app

This is a sample app for the [hubspot-php SDK](https://github.com/ryanwinchester/hubspot-php). Currently, this app focuses on demonstrating the functionality of [Companies API](https://developers.hubspot.com/docs/methods/companies/companies-overview) endpoints and their related actions.

### HubSpot Public API links used in this application

  - [Get all companies](https://developers.hubspot.com/docs/methods/companies/get-all-companies)

### Setup App

Make sure you have [Docker Compose](https://docs.docker.com/compose/) installed.

### Configure

1. Copy .env.template to .env
2. Paste your HUBSPOT_CLIENT_ID and HUBSPOT_CLIENT_SECRET

### Running

The best way to run this project (with the least configuration), is using docker compose.  Change to the webroot and start it

```bash
docker-compose up
```
You should now be able to navigate to [http://localhost:8999](http://localhost:8999) and use the application.
