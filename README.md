## Prerequisites
- Make sure you have Node.js and npm installed for the frontend.
- Make sure you have PHP, Composer, and a web server (like Apache or Nginx) installed for the backend. Or you can install Xampp if using Windows OS.
- Make sure you have MySQL installed for the database.

## Database Setup

1. Start your MySQL server. The method for this will depend on your MySQL installation.

2. Import the `eventmanage.sql` file located in the `backend` directory to your MySQL server:

```bash
mysql -u username -p database_name < backend/eventmanage.sql
```

## Backend Setup (CakePHP)
1. Navigate to the `backend` directory:
```bash
cd backend
```
2. Install the dependencies:
```
composer install
```
3. Configure your web server to point to the `webroot` directory of the CakePHP application.

4. Start your web server. The method for this will depend on your web server’s configuration.

## Frontend Setup (Next.js)
1. Navigate to the  `frontend` directory:
```
cd ../frontend
```
2. Install the dependencies:
```
npm install
```
3. Create a `.env` file in the `frontend` directory:
```
touch .env
```
4. Open the `.env` file in a text editor and add the following line:
```
BACKEND_URL="http://localhost/eventmanage"
```
Replace  `"http://localhost/eventmanage"` with the URL of your backend application if it’s different.

5. Start the Next.js application:
```
npm run dev
```
Now, your backend should be running at the specified URL, and your frontend should be connected to your backend through the `BACKEND_URL` in the `.env` file.
