# HubSpot-php sample app

This is a sample app for the [hubspot-php SDK](https://github.com/ryanwinchester/hubspot-php). Currently, this app focuses on demonstrating the functionality of [Contacts API](https://developers.hubspot.com/docs/methods/contacts/contacts-overview) endpoints and their related actions.

### Setup App

Make sure you have [Docker Compose](https://docs.docker.com/compose/) installed.

### Configure

- Copy .env.template to .env
- Paste your HubSpot API Key as the value for HUBSPOT_API_KEY in .env

### Running

The best way to run this project (with the least configuration), is using docker compose.  Change to the webroot and start it

```bash
docker-compose up
```
You should now be able to navigate to [http://localhost:8999](http://localhost:8999) and use the application.
