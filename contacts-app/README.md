# HubSpot-php sample app

This is a sample app for the [hubspot-php SDK](https://github.com/ryanwinchester/hubspot-php). Currently, this app focuses on demonstrating the functionality of [Contacts API](https://developers.hubspot.com/docs/methods/contacts/contacts-overview) endpoints and their related actions.

### HubSpot Public API links are used in this application

### Setup App
  - [Create or update a contact](https://developers.hubspot.com/docs/methods/contacts/create_or_update)
  - [Get a contact record by its vid](https://developers.hubspot.com/docs/methods/contacts/get_contact)
  - [Get all contacts](https://developers.hubspot.com/docs/methods/contacts/get_contacts)
  - [Get All Contacts Properties](https://developers.hubspot.com/docs/methods/contacts/v2/get_contacts_properties)
  - [Get List of Owners](https://developers.hubspot.com/docs/methods/owners/get_owners)
  - [Update a contact property](https://developers.hubspot.com/docs/methods/contacts/v2/update_contact_property)
  - [Create a contact property](https://developers.hubspot.com/docs/methods/contacts/v2/create_contacts_property)
  - [Search for contacts by email, name, or company name](https://developers.hubspot.com/docs/methods/contacts/search_contacts)


Make sure you have [Docker Compose](https://docs.docker.com/compose/) installed.

### Configure

1. Copy .env.template to .env
2. Specify authorization data in .env:
    
    - Paste your HubSpot API Key as the value for HUBSPOT_API_KEY
    
    or
    
    - Paste HUBSPOT_CLIENT_ID and HUBSPOT_CLIENT_SECRET for OAuth

### Running

The best way to run this project (with the least configuration), is using docker compose.  Change to the webroot and start it

```bash
docker-compose up
```
You should now be able to navigate to [http://localhost:8999](http://localhost:8999) and use the application.
