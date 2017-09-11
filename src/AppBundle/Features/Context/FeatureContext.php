<?php

/*
 * This file is part of the Test Vagrant.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Features\Context;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext as BaseMinkContext;

/**
 * Class FeatureContext
 */
class FeatureContext extends BaseMinkContext implements SnippetAcceptingContext
{
    /**
     * @BeforeStep
     */
    public function beforeStep()
    {
        $this->getSession()->getDriver()->maximizeWindow();
    }

    /**
     * @param string $scrollValue
     *
     * @When /^I scroll vertical to "([^"]*)"$/
     */
    public function scrollVertical($scrollValue)
    {
        $this->getSession()->executeScript("window.scrollTo(0, ".$scrollValue.");");
    }

    /**
     * @param string $class
     *
     * @When /^I click on "([^"]*)"$/
     */
    public function iClickOn($class)
    {
        $this->getSession()->executeScript("$(location).attr('href', $('.".$class."').first().attr('href'))");
    }

    /**
     * @param int $second
     *
     * @Given /^(?:|I )wait (?P<second>[\d]+) seconds$/
     */
    public function iWait($second)
    {
        $this->getSession()->wait($second * 1000);
    }
}
