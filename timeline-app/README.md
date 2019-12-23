# HubSpot-php sample Timeline app

This is a sample app for the [hubspot-php SDK](https://github.com/HubSpot/hubspot-php). 
Currently, this app is focused on demonstrating of [Timeline API](https://developers.hubspot.com/docs/methods/timeline/timeline-overview)
integration with [Telegram](https://telegram.org/).

Please see the documentation on:
- [How do I create an app in HubSpot?](https://developers.hubspot.com/docs/faq/how-do-i-create-an-app-in-hubspot)
- [How do I find the app ID for a HubSpot app?](https://developers.hubspot.com/docs/faq/how-do-i-find-the-app-id)
- [Developer HAPIkeys](https://developers.hubspot.com/docs/faq/developer-hapikeys)
- [Telegram bots: An introduction for developers](https://core.telegram.org/bots)

### Setup App

Make sure you have [Docker Compose](https://docs.docker.com/compose/).

### Configure

1. Copy .env.template to .env
2. Specify HubSpot authorization data in .env:

   - Paste your Developer HAPI Key as the value for HUBSPOT_DEVELOPER_API_KEY

   and

   - Paste HUBSPOT_CLIENT_ID, HUBSPOT_CLIENT_SECRET and HUBSPOT_APPLICATION_ID for OAuth
    
3. Register telegram bot using [this guide](https://core.telegram.org/bots). Specify received bot data in .env:
   
    - Paste TELEGRAM_BOT_API_TOKEN and TELEGRAM_BOT_USERNAME
    
### Running

The best way to run this project (with the least configuration), is using docker compose.  Change to the webroot and start it

```bash
docker-compose up --build web
```
You should now be able to navigate to [http://localhost:8999](http://localhost:8999) and use the application.

To test the application proceed as follows:

1. There is an initialization script init.php invoked by the user 
on the initial Application page. It is designed to create event types which will be used
for creating timeline events later.

2. After the initialization is done authorize the applications via OAuth2.

3. The next page will suggest to generate telegram bot link
. [Telegram deep linking](https://core.telegram.org/bots#deep-linking) is used to connect
a HubSpot contact with telegram chat by email. Generate bot link, share it with the contact.

4. Telegram bot sends invitations to participate in events. If a contact agrees - corresponding 
timeline event will be created.

### Debugging

To see telegram bot logs execute

```bash
docker-compose exec web cat /var/log/supervisor/telegram-handle-updates-out.log
```

### Project structure:

- A background job listens for telegram updates, handles users replies. It is implemented by 
`src/console/telegram/handleUpdates.php`
- CRUD actions for invitations, event types, oauth are located in `src/actions`
