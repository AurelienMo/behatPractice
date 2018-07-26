@api
@api_article

Feature: As an authenticated user, I need to be able to create an article

  Background:
    Given I load following fixture file "base.yml"

  Scenario: [Success] Create an article
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/secured/articles" with body:
    """
    {
        "title": "Titre article 1",
        "content": "Contenu Article 1"
    }
    """
    Then the response status code should be 201
    And the header "Location" should be equal to "/api/articles/titre-article-1"

  Scenario: [Fail] Submit request with no payload
    When After authentication on url "/api/login_check" with method "POST" as user "johndoe" with password "12345678", I send a "POST" request to "/api/secured/articles" with body:
    """
    {
    }
    """
    Then the response status code should be 400
    And the JSON should be valid according to this schema:
    """
    {
        "type": "object"
    }
    """