# EchoSign API
Adobe Sign Oauth and basic functions

Authorizes OAuth for Adobe Sign API and performs basic API functions (currently sends an agreement via email from Document Library).

## Prerequisites

An [Adobe Sign Developer Account](https://acrobat.adobe.com/us/en/sign/developer-form.html)
[Create an Adobe Sign Application](https://www.adobe.io/apis/documentcloud/sign/docs.html#!adobeio/adobeio-documentation/master/sign/gstarted/create_app.md)

## Installing

Edit **credentials.php** to define your app's CLIENT_ID, CLIENT_SECRET, and REDIRECT_URI

Edit **oauth.php** to define your app's scope by modifying the *$scope* variable appropriately

Upload all files to your server

Navigate to the **oauth.php** file in your browser and follow the link. You will be sent to an Echo Sign interstitial page to authorize the app. Authorizing the app will return you to your callback.php.

Copy the values for the **Access Token**, **Refresh Token**, and **API URL** into **credentials.php**

You can now use the Echo Sign functions from **echosignfunctions.php** to refresh access tokens and send agreements from your library. At the time of writing only *sendAgreement($signer_email)* exists in the functions. 
