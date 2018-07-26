@web
@web_security
@web_security_registration

Feature: As an anonymous user, I need to be able to submit a registration to application

  Background:
    Given I am on "/register"

  Scenario: [Fail] Submit form without datas
    When I press "S'inscrire"
    Then I should be on "/register"
    And I should see "Le nom d'utilisateur doit être indiqué."
    And I should see "L'adresse email doit être indiquée"
    And I should see "Le champ mot de passe ne peut être vide."

  Scenario: [Fail] Submit form with invalid email
    When I fill in "Nom d'utilisateur souhaité" with "johndoe"
    And I fill in "Votre email" with "superemail"
    And I fill in "Mot de passe" with "12345678"
    And I fill in "Confirmer mot de passe" with "12345678"
    And I press "S'inscrire"
    Then I should see "L'adresse email doit être au format email"
    And I should not see "Le nom d'utilisateur doit être indiqué."

  Scenario: [Fail] Submit form with to long username
    When I fill in "Nom d'utilisateur souhaité" with "johndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoejohndoe"
    And I fill in "Votre email" with "john@doe.com"
    And I fill in "Mot de passe" with "12345678"
    And I fill in "Confirmer mot de passe" with "12345678"
    And I press "S'inscrire"
    Then I should see "Le nombre maximum de caractères pour le nom d'utilisateur est de 80 caractères"

  Scenario: [Success] Fill all field of registration form type & submit form
    When I fill in "Nom d'utilisateur souhaité" with "johndoe"
    And I fill in "Votre email" with "john@doe.com"
    And I fill in "Mot de passe" with "12345678"
    And I fill in "Confirmer mot de passe" with "12345678"
    And I press "S'inscrire"
    Then I should see "Votre inscription a été prise en compte."
    And User "johndoe" should be exist into database