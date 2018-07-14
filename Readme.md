# Behat Practice

## Context

Project created as part of a training session to set up and use the Behat functional test tool

## Guideline

Project consisting of an Article entity and a User entity

Article definition:
* Id: Uuid
* Title: string
* Content: string
* CreatedAt: \DateTime

User definition:
* Id: Uuid
* Username: string
* Email: string
* Password: string
* Roles: Array

### Use case list

1. As an anonymous user, I need to be able to register (Web Context)
2. As an anonymous user, I need to be able to get detail of an given article (API Context)
3. As an authenticated user, I need to be able to post a new article (API Context)

## Authentication

* Authentication is managed through a JWT token
* The LexikJWTAuthenticationBundle library has been used for setting up JWT authentication.
* To obtain a valid token for a given user, you must call following route `/api/login_check` with following payload:
```
{
	"username":"johndoe",
	"password":"12345678"
}
```

## Test case
1. [WEB] Registration feature:  
-- [Success] Fill all field of registration form type & submit form  
-- [Fail] Submit form with no datas  
-- [Fail] Submit form with invalid email  
-- [Fail] Submit form with to long username  

2. [API] Get an article:  
-- [Success] Obtain article information  
-- [Fail]  Not found article

3. [API] Post an article:  
-- [Success] Create an article  
-- [Fail] Submit request with no payload  
-- [Fail] Submit request with incomplete payload  
-- [Fail] Submit request with invalid token  
-- [Fail] Submit request without token