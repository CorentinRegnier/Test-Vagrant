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
