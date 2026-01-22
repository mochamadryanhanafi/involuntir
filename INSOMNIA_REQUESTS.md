# Insomnia Request Bodies

Here are the request bodies for importing into Insomnia (or any API client).

## 1. Register User

*   **Method:** `POST`
*   **URL:** `http://localhost:8000/api/register`
*   **Body Type:** `JSON`

```json
{
	"name": "John Doe",
	"email": "john.doe@example.com",
	"password": "password",
	"password_confirmation": "password"
}
```

## 2. Login User

*   **Method:** `POST`
*   **URL:** `http://localhost:8000/api/login`
*   **Body Type:** `JSON`

```json
{
	"email": "john.doe@example.com",
	"password": "password"
}
```

## 3. Create Event

*   **Method:** `POST`
*   **URL:** `http://localhost:8000/api/events`
*   **Body Type:** `JSON`
*   **Headers:**
    *   `Authorization`: `Bearer YOUR_AUTH_TOKEN` (obtained from login)

```json
{
	"title": "My Awesome Event",
	"description": "This is a description of my awesome event.",
	"event_date": "2026-03-15"
}
```

## 4. Join Event

*   **Method:** `POST`
*   **URL:** `http://localhost:8000/api/events/{event_id}/join` (replace `{event_id}` with an actual event ID)
*   **Body Type:** `JSON` (empty, or can send an empty object `{}`)
*   **Headers:**
    *   `Authorization`: `Bearer YOUR_AUTH_TOKEN` (obtained from login)

```json
{}
```

## Example Responses

### Successful Response

```json
{
    "success": true,
    "data": {
        "access_token": "YOUR_GENERATED_TOKEN",
        "token_type": "Bearer"
    },
    "message": "User registered successfully."
}
```

### Error Response (e.g., Validation Error)

```json
{
    "success": false,
    "message": "Validation Error.",
    "data": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```
