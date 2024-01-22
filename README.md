## Prerequisites
- Make sure you have Node.js and npm installed for the frontend.
- Make sure you have PHP, Composer, and a web server (like Apache or Nginx) installed for the backend.

## Backend Setup (CakePHP)
1. Navigate to the `backend` directory:
```bash
cd backend
```
Install the dependencies:
```
composer install
```
Configure your web server to point to the webroot directory of the CakePHP application.

Start your web server. The method for this will depend on your web server’s configuration.

## Frontend Setup (Next.js)
Navigate to the frontend directory:
```
cd ../frontend
```
Install the dependencies:
```
npm install
```
Create a .env file in the frontend directory:
```
touch .env
```
Open the .env file in a text editor and add the following line:
```
BACKEND_URL="http://localhost/eventmanage"
```
Replace "http://localhost/eventmanage" with the URL of your backend application if it’s different.

Start the Next.js application:
```
npm run dev
```
Now, your backend should be running at the specified URL, and your frontend should be connected to your backend through the BACKEND_URL in the .env file.
