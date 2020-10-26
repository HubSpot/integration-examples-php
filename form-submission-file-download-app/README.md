# HubSpot-php sample app

This is a sample app for the [hubspot-php SDK](https://github.com/hubspot/hubspot-php).

Please see the documentation on [How do I create an app in HubSpot?](https://developers.hubspot.com/docs/faq/how-do-i-create-an-app-in-hubspot)

This Application demonstrates the recommended approach to working with file uploads via HubSpot form submission. For security reasons HubSpot makes uploaded files available to the Users only if they are logged in. If you want not logged in Users to access the file you may do the following:

1. Listen for a webhook for the file upload field (customer-defined, but similar to this https://github.com/HubSpot/integration-examples-php/tree/master/webhooks-contacts-app)
2. Grab the file by hitting the URL stored by the form in Contact property
   - This URL can only be accessed by authenticated caller - see [OAuth 2.0 example](https://github.com/HubSpot/integration-examples-php/tree/master/oauth2-app) for an example of OAuth 2.0 authentication PHP code
3. Upload the file to the file-manager via https://developers.hubspot.com/docs/methods/files/post_files
4. Put the resulting file URL to a new contact property, something like "file public link" as an example

This design is implemented in this Application

1. There is an initialization script [init.php](https://github.com/HubSpot/integration-examples-php/tree/master/form-submission-file-download-app/src/actions/forms/init.php) invoked by the user on the initial Application page. It is designed to create a form for file upload and custom properties specified by environment variables PUBLIC_FILE_LINK_PROPERTY and PROTECTED_FILE_LINK_PROPERTY for uploaded protected file link and public file link storage
2. After the initialization is done the form is created using JavaScript script provided by HubSpot to embed forms on your website. (src="//js.hsforms.net/forms/shell.js) - this is done in [form.php](https://github.com/HubSpot/integration-examples-php/tree/master/form-submission-file-download-app/src/views/forms/form.php)
3. When User uploads the file via the form webhook event is posted to [handle.php](https://github.com/HubSpot/integration-examples-php/tree/master/form-submission-file-download-app/src/actions/webhooks/handle.php) that does two things:
   - calls [hubspot-php SDK](https://github.com/hubspot/hubspot-php) method to get the file link from Protected Property https://github.com/HubSpot/hubspot-integration-samples-php/blob/master/form-submission-file-download-app/src/actions/webhooks/handle.php#L25
   - calls [hubspot-php SDK](https://github.com/hubspot/hubspot-php) method to update Public Property with publicly viewable location of the file https://github.com/HubSpot/hubspot-integration-samples-php/blob/master/form-submission-file-download-app/src/actions/webhooks/handle.php#L45
4. [list.php](https://github.com/HubSpot/hubspot-integration-samples-php/blob/master/form-submission-file-download-app/src/views/contacts/list.php) displays the list of contacts with PROTECTED_FILE_LINK_PROPERTY and PUBLIC_FILE_LINK_PROPERTY

### Setup App

Make sure you have [Docker Compose](https://docs.docker.com/compose/) installed.

### Configure

1. Copy .env.template to .env
2. Specify authorization data in .env:
   - Paste HUBSPOT_CLIENT_ID and HUBSPOT_CLIENT_SECRET for OAuth
   - Paste HUBSPOT_DEVELOPER_API_KEY and HUBSPOT_APPLICATION_ID for webhook's creation
   - Paste PUBLIC_FILE_LINK_PROPERTY and PROTECTED_FILE_LINK_PROPERTY

### Running

The best way to run this project (with the least configuration), is using docker compose. Change to the webroot and start it

```bash
docker-compose up --build
```

Copy Ngrok url from console. Now you should now be able to navigate to that url and use the application.

### NOTE about Ngrok Too Many Connections error

If you are using Ngrok free plan and testing the application with large amount of import/deletions of Contacts you are likely to see Ngrok "Too Many Connections" error.
This is caused by a large amount of weebhooks events being sent to Ngrok tunnel. To avoid it you can deploy sample applications on your server w/o Ngrok or upgrade to Ngrok Enterprise version

### Configure webhooks

Required webhooks url should look like https://***.ngrok.io/webhooks/handle.php

Following [Webhooks Setup](https://developers.hubspot.com/docs/methods/webhooks/webhooks-overview) guide please note:

- Every time the app is restarted you should update the webhooks url
- The app requires `contact.propertyChange` subscription type
- Subscription is paused by default. You need to activate it manually after creating
