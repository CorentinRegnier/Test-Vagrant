Feature: Default
  As a an visitor I can show an homepage

  Scenario: show a list of users
    Given I am on "/"
    When I scroll vertical to "1"
    Then I should see "Test Vagrant"
    And I click on "user-index"
    And I wait 3 seconds
    And I scroll vertical to "100"
    And I wait 3 seconds

  Scenario: Connect user
    Given I am on "/"
    When I am on "/login"
    And I wait 3 seconds
    When I fill in "username" with "admin"
    And I wait 3 seconds
    When I fill in "password" with "xxx"
    And I wait 3 seconds
    When I press "_submit"
    Then I am on "/"
    And I wait 3 seconds
