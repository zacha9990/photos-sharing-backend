## API Documentation

This document provides documentation for the API endpoints available in the application.

### .env Configuration

Below is the configuration for the `.env` file in the Laravel application:

```plaintext
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:He+xYMwx19SFNDdFBvYiOA3N4AN/tHbNDwGUwv9IFrE=
APP_DEBUG=true
APP_URL=http://your-url

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_username
DB_PASSWORD=your_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

Please make sure to configure the `.env` file with the appropriate values based on your environment and requirements.


### Auth Endpoints

#### Register

Registers a new user.

- **URL**: `/api/register`
- **Method**: `POST`
- **Request Body**:
    - `name` (required, string): The name of the user.
    - `email` (required, string): The email address of the user.
    - `password` (required, string): The password of the user.
    - `password_confirmation` (required, string): The confirmation of the password.
- **Response**:
    - `user` (object): The user object containing user details.
    - `access_token` (string): The access token for authentication.
- **Status Codes**:
    - `201`: Successful registration.
    - `422`: Validation error.
    - `500`: Server error.

#### Login

Authenticates a user and returns an access token.

- **URL**: `/api/login`
- **Method**: `POST`
- **Request Body**:
    - `email` (required, string): The email address of the user.
    - `password` (required, string): The password of the user.
- **Response**:
    - `user` (object): The user object containing user details.
    - `access_token` (string): The access token for authentication.
- **Status Codes**:
    - `200`: Successful login.
    - `401`: Invalid credentials.
    - `500`: Server error.

### Photo Endpoints

#### Get All Photos

Retrieves all photos.

- **URL**: `/api/photos`
- **Method**: `GET`
- **Response**:
    - Array of photo objects.
- **Status Codes**:
    - `200`: Successful retrieval.
    - `500`: Server error.

#### Create Photo

Creates a new photo.

- **URL**: `/api/photos`
- **Method**: `POST`
- **Authentication**: Required
- **Request Body**:
    - `caption` (string): The caption of the photo.
    - `tags` (string): The tags associated with the photo.
    - `photo` (file): The photo file to upload.
- **Response**:
    - Created photo object.
- **Status Codes**:
    - `201`: Successful creation.
    - `400`: Photo file is missing.
    - `401`: Unauthorized.
    - `500`: Server error.

#### Get Photo by ID

Retrieves a specific photo by ID.

- **URL**: `/api/photos/{id}`
- **Method**: `GET`
- **Parameters**:
    - `id` (integer): The ID of the photo.
- **Response**:
    - Photo object.
- **Status Codes**:
    - `200`: Successful retrieval.
    - `404`: Photo not found.
    - `500`: Server error.

#### Update Photo

Updates an existing photo.

- **URL**: `/api/photos/{id}`
- **Method**: `PUT`
- **Authentication**: Required
- **Parameters**:
    - `id` (integer): The ID of the photo.
- **Request Body**:
    - `caption` (string): The updated caption of the photo.
    - `tags` (string): The updated tags associated with the photo.
    - `photo` (file): The updated photo file to upload.
- **Response**:
    - Updated photo object.
- **Status Codes**:
    - `200`: Successful update.
    - `401`: Unauthorized.
    - `404`: Photo not found.
    - `500`: Server error.

#### Delete Photo

Deletes a photo.

- **URL**: `/api/photos/{id}`
- **Method

**: `DELETE`
- **Authentication**: Required
- **Parameters**:
    - `id` (integer): The ID of the photo.
- **Response**:
    - Message indicating successful deletion.
- **Status Codes**:
    - `200`: Successful deletion.
    - `401`: Unauthorized.
    - `404`: Photo not found.
    - `500`: Server error.

#### Like Photo

Likes a photo.

- **URL**: `/api/photos/{id}/like`
- **Method**: `POST`
- **Authentication**: Required
- **Parameters**:
    - `id` (integer): The ID of the photo.
- **Response**:
    - Message indicating successful like.
- **Status Codes**:
    - `200`: Successful like.
    - `401`: Unauthorized.
    - `404`: Photo not found.
    - `500`: Server error.

#### Unlike Photo

Removes a like from a photo.

- **URL**: `/api/photos/{id}/unlike`
- **Method**: `POST`
- **Authentication**: Required
- **Parameters**:
    - `id` (integer): The ID of the photo.
- **Response**:
    - Message indicating successful unlike.
- **Status Codes**:
    - `200`: Successful unlike.
    - `401`: Unauthorized.
    - `404`: Photo not found.
    - `500`: Server error.

Note: 
1. All endpoints that require authentication should include the `Authorization` header with the value `Bearer {access_token}`. 
2. The header should include Accept: application/json, or it will be redirected/show error instead of unauthenticated message.

