# HubSpot-php sample OAuth 2.0 app

This is a sample app for the [hubspot-php SDK](https://github.com/hubspot/hubspot-php). Currently, this app focuses on demonstrating the functionality of [Companies API](https://developers.hubspot.com/docs/methods/companies/companies-overview) endpoints and their related actions.

Please see the documentation on [How do I create an app in HubSpot?](https://developers.hubspot.com/docs/faq/how-do-i-create-an-app-in-hubspot)

## HubSpot Public API links used in this application

- [Initiate an Integration with OAuth 2.0](https://developers.hubspot.com/docs/methods/oauth2/initiate-oauth-integration)
- [Get OAuth 2.0 Access Token and Refresh Tokens](https://developers.hubspot.com/docs/methods/oauth2/get-access-and-refresh-tokens)
- [Refresh OAuth 2.0 Access Token](https://developers.hubspot.com/docs/methods/oauth2/refresh-access-token)
- [Get all contacts](https://developers.hubspot.com/docs/methods/contacts/get_contacts)

## Note on Application Scopes

HubSpot provides a way to restrict application users access to the system to certain scopes. In order to do that it is a good practice to make a set of scopes required by your applicatuion.
Please refer to [Initiate an Integration with OAuth 2.0](https://developers.hubspot.com/docs/methods/oauth2/initiate-oauth-integration) for documentation on the scope parameter passed to `https://app.hubspot.com/oauth/authorize` to make a set of scopes required. [Scopes](https://developers.hubspot.com/docs/methods/oauth2/initiate-oauth-integration#scopes) explains how to make optional scopes and talks about scopes available in HubSpot system

### Setup App

Make sure you have [Docker Compose](https://docs.docker.com/compose/) installed.

### Configure

1. Copy `.env.template` to `.env`.
2. Paste your `HUBSPOT_CLIENT_ID` and `HUBSPOT_CLIENT_SECRET`.

### Running

The best way to run this project (with the least configuration), is using docker compose. Change to the webroot and start it

```bash
docker-compose up --build web
```

You should now be able to navigate to [http://localhost:8999](http://localhost:8999) and use the application.

## Configure OAuth

Copy redirect url from login page and designate this on your app's Auth settings page.
