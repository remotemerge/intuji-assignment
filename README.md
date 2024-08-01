# Intuji PHP Assignment

## Connecting to Google Calendar with Core PHP

### Installation

Clone the repository to your local machine and install the dependencies by running:

```bash
composer install
```

### Create Google Project

- Visit the [Google Cloud Console](https://console.cloud.google.com) and create a new project.
- Enable the [Google Calendar API](https://console.developers.google.com/apis/library/calendar-json.googleapis.com).

### Set Up OAuth 2.0 Client

- Navigate to the [Google Credentials](https://console.cloud.google.com/apis/credentials) section and create an OAuth 2.0 Client.
- Duplicate the `.env.dev` file and rename it to `.env`.
- Update the `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET` with the credentials obtained from the OAuth 2.0 Client.
- Set `GOOGLE_REDIRECT_URI` to the application's redirect URI. For local development, use `http://localhost:8080/callback.php` and ensure this URI is added to your OAuth 2.0 Client configuration.

### Running the Application

After completing the configuration, start the PHP server with the following command:

```bash
php -S localhost:8080 -t public
```

Visit `http://localhost:8080` in your browser to connect to Google Calendar.

### Login Flow

Click on the "Login with Google" button to initiate the OAuth 2.0 flow. You will be redirected to Google's authorization page to grant access to your Google Calendar. After granting access, you will be redirected back to the application.

### Logout

To logout from the application, click on the "Logout" button. This will clear the session and revoke the access token from Google.
