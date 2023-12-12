<?php

use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverDimension;
use Facebook\WebDriver\WebDriverExpectedCondition;

class GUIAction
{
    /** @var Webdirver */
    private WebDriver $driver;

    function __construct(Webdriver $driver)
    {
        $this->driver = $driver;
    }

    function navigate(String $url): GUIAction
    {
        $this->driver->get($url);
        return $this;
    }

    function maximize(): GUIAction
    {
        $this->driver->manage()->window()->maximize();

        return $this;
    }

    function setWindwSize(int $width, int $hight) : GUIAction {
        $this->driver->manage()->window()->setSize(new WebDriverDimension($width, $hight));

        return $this;
    }

    function click(WebDriverBy $by): GUIAction
    {
        $this->driver->wait()->until(
            WebDriverExpectedCondition::elementToBeClickable($by)
        )->click();

        return $this;
    }

    function type(WebDriverBy $by, String $text): GUIAction
    {
        $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated($by)
        )->sendKeys($text);

        return $this;
    }

    function scrollTo(WebDriverBy $by): GUIAction
    {
        $element = $this->driver->wait()->until(
            WebDriverExpectedCondition::presenceOfElementLocated($by)
        );
        $this->driver->executeScript(
            "arguments[0].scrollIntoView({ behavior: 'auto', block: 'center', inline: 'nearest' });",
            [$element]
        );
        sleep(1);

        return $this;
    }

    function focusOnNewTab(): GUIAction
    {
        $tabs = $this->driver->getWindowHandles();
        $this->driver->switchTo()->window(end($tabs));

        return $this;
    }

    function screenshot(): GUIAction
    {
        $screenshot = $this->driver->takeScreenshot();
        $currentPageTitle = $this->driver->getTitle();

        file_put_contents("src/output/" . $currentPageTitle . "_" . H::timestamp() . ".png", $screenshot);

        return $this;
    }

    function getText(WebDriverBy $by): String
    {
        return $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated($by)
        )->getText();
    }

    function isElementDisplayed(WebDriverBy $by) : bool {
        $element =  $this->driver->wait()->until(
            WebDriverExpectedCondition::visibilityOfElementLocated($by)
        );

        return $element->isDisplayed();
    }

    function quit(): void
    {
        $this->driver->quit();
    }
}
