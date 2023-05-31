# HubSpot-php sample Webhooks app

This is a sample app for the [hubspot-php SDK](https://github.com/hubspot/hubspot-php). 
Currently, this app focuses on demonstrating the functionality of [Webhooks API](https://developers.hubspot.com/docs/methods/webhooks/webhooks-overview), contact creation/deletion in particular.

Please note that the Webhooks events are not sent in chronological order with respect to the creation time. Events might be sent in large numbers, for example when the user imports large number of contacts or deletes a large list of contacts.
The application demonstrates the use of Queues (Kafka in case of this application - see [KafkaHelper.php](https://git.hubteam.com/HubSpot/hubspot-integration-samples-php/blob/master/webhooks-contacts-app/src/Helpers/KafkaHelper.php)) to process webhooks events.
Common webhook processing practice consists of few steps:
1. Handle methods receive the request sent by the webook and immediately place payload on the queue [handle.php](https://git.hubteam.com/HubSpot/hubspot-integration-samples-php/blob/master/webhooks-contacts-app/src/actions/webhooks/handle.php)
2. Message consumer instance(s) is running in a separate process, typically on multiple nodes in a cloud, such as AWS [consumer.php](https://git.hubteam.com/HubSpot/hubspot-integration-samples-php/blob/master/webhooks-contacts-app/src/console/webhooks/consumer.php)
3. Consumer stores webhook events in the database potentially calling an API to get full record of the object that triggered the event
   - This application uses MySQL, the methods working with the database can be seen in [EventsRepository.php](https://git.hubteam.com/HubSpot/hubspot-integration-samples-php/blob/master/webhooks-contacts-app/src/Repositories/EventsRepository.php)
4. Other services/objects fetch the events data from the database sorted by timestamp of the event [EventsRepository.php](https://git.hubteam.com/HubSpot/hubspot-integration-samples-php/blob/master/webhooks-contacts-app/src/Repositories/EventsRepository.php#L38)


### Note on the Data Base
This application uses MySQL database to store the events coming from Webhooks. There is a single events table:
```
create table if not exists events
(
    id          INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    event_type  VARCHAR(255),
    object_id   int        default null,
    event_id    int        default null,
    occurred_at bigint     default null,
    shown       tinyint(1) default 0,
    created_at  datetime   default CURRENT_TIMESTAMP
);
```
Please note that event_id sent by HubSpot needs to be stored as int

### Setup App

Make sure you have:
- [Docker Compose](https://docs.docker.com/compose/) installed
- [Ngrok account](https://ngrok.com/)

### Configure

1. Copy .env.template to .env
2. Paste your HUBSPOT_CLIENT_ID and HUBSPOT_CLIENT_SECRET
3. Paste your Ngrok authtoken to NGROK_AUTHTOKEN in .env

### Running

The best way to run this project (with the least configuration), is using docker compose.  Change to the webroot and start it

```bash
docker-compose up --build
```

Copy Ngrok url from console and designate this on your app's Auth settings page. Now you should now be able to navigate to that url and use the application.

### Configure OAuth

Required redirect URL should look like https://***.ngrok-free.app/oauth/callback
Every time the app is § you should update the redirect URL.
[Learn more.](https://developers.hubspot.com/docs/api/oauth-quickstart-guide)

### NOTE about Ngrok Too Many Connections error

If you are using Ngrok free plan and testing the application with large amount of import/deletions of Contacts you are likely to see Ngrok "Too Many Connections" error.
This is caused by a large amount of weebhooks events being sent to Ngrok tunnel. To avoid it you can deploy sample applications on your server w/o Ngrok or upgrade to Ngrok Enterprise version

### Configure webhooks

Required webhooks url should look like https://***.ngrok-free.app/webhooks/handle

Following [Webhooks Setup](https://developers.hubspot.com/docs/methods/webhooks/webhooks-overview) guide please note:
- Every time the app is restarted you should update the webhooks url
- The app supports `contact.creation` and `contact.deletion` subscription types only
- Subscription are paused by default. You need to activate them manually after creating
