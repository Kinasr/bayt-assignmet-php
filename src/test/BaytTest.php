<?php

use Facebook\WebDriver\Chrome\ChromeDriver;
use Facebook\WebDriver\WebDriver;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;

include("src/main/Page.php");

spl_autoload_register(function ($class_name) {
    $fullPath = 'src/main/' . $class_name . '.php';
    if (file_exists($fullPath)) include $fullPath;
});

class BaytTest extends TestCase
{

    private GUIAction $guiAction;
    private static String $email;
    private static String $password = "Aa012345#";

    public static function setUpBeforeClass(): void
    {
        self::$email = "test_" . H::timestamp() . "@email.com";
    }

    public function setUp(): void
    {
        putenv('WEBDRIVER_CHROME_DRIVER=/path/to/chromedriver');
        $driver = ChromeDriver::start();
        $this->guiAction = new GUIAction($driver);
    }

    public function tearDown(): void
    {
        $this->guiAction->quit();
    }

    function testApplyingForAJobWhileNotLoggedIn(): void
    {
        $this->guiAction
            ->navigate(C::BASE_URL)
            ->maximize()
            ->scrollTo(HomePage::linkAboutUs())
            ->screenshot()
            ->click(HomePage::linkAboutUs())
            ->screenshot()
            ->click(AboutUsPage::linkCareers())
            ->screenshot()
            ->click(BaytCompanyPage::linkFirstJob())
            ->focusOnNewTab()
            ->screenshot()
            ->click(BaytJobDescriptionPage::buttonApply())
            ->type(ApplicationFormPage::inputFirstName(), "Ahmed")
            ->type(ApplicationFormPage::inputLastName(), "Ali")
            ->type(ApplicationFormPage::inputEmail(), self::$email)
            ->type(ApplicationFormPage::inputPassword(), self::$password)
            ->type(ApplicationFormPage::inputMobile(), "01234567897")
            ->scrollTo(ApplicationFormPage::buttonApplyNow())
            ->screenshot()
            ->click(ApplicationFormPage::buttonApplyNow())
            ->screenshot()
            ->click(AttachCVPage::buttonSkip())
            ->click(CompleteCVPage::selectorBirthDay())
            ->click(CompleteCVPage::optionSelector("1"))
            ->click(CompleteCVPage::selectorBirthMonth())
            ->click(CompleteCVPage::optionSelector("January"))
            ->click(CompleteCVPage::selectorBirthYear())
            ->type(CompleteCVPage::inputSelectorSearch(), "2000")
            ->click(CompleteCVPage::optionSelector("2000"))
            ->click(CompleteCVPage::radioButtonMale())
            ->click(CompleteCVPage::selectorNationality())
            ->type(CompleteCVPage::inputSelectorSearch(), "Egypt")
            ->click(CompleteCVPage::optionSelector("Egypt"))
            ->scrollTo(CompleteCVPage::radioButtonExperienceNo())
            ->click(CompleteCVPage::radioButtonExperienceNo())
            ->click(CompleteCVPage::selectorDegree())
            ->click(CompleteCVPage::optionSelector("High school or equivalent"))
            ->type(CompleteCVPage::inputUniversity(), "Test University")
            ->click(CompleteCVPage::optionInput("Test University"))
            ->click(CompleteCVPage::selectorEducationCountry())
            ->type(CompleteCVPage::inputSelectorSearch(), "Egypt")
            ->click(CompleteCVPage::optionSelector("Egypt"))
            ->click(CompleteCVPage::selectorEducaitonCity())
            ->type(CompleteCVPage::inputSelectorSearch(), "Cairo")
            ->click(CompleteCVPage::optionSelector("Cairo"))
            ->type(CompleteCVPage::inputFieldOfStudy(), "Automation Test")
            ->click(CompleteCVPage::optionInput("Automation Test"))
            ->click(CompleteCVPage::selectorGraduationMonth())
            ->type(CompleteCVPage::inputSelectorSearch(), "January")
            ->click(CompleteCVPage::optionSelector("January"))
            ->click(CompleteCVPage::selectorGraduationYear())
            ->type(CompleteCVPage::inputSelectorSearch(), "2022")
            ->click(CompleteCVPage::optionSelector("2022"))
            ->scrollTo(CompleteCVPage::buttonSave())
            ->screenshot()
            ->click(CompleteCVPage::buttonSave())
            ->click(VisaStatusPage::selectorVisaStatus())
            ->click(VisaStatusPage::optionSelector("No Visa"))
            ->screenshot()
            ->click(VisaStatusPage::buttonApply())
            ->screenshot();

        $this->assertStringContainsString(
            "Your application has been sent",
            $this->guiAction->getText(ApplicationSentPage::textTitle())
        );
    }

    /** @depends testApplyingForAJobWhileNotLoggedIn */
    function testApplyingWithARegisteredEmailShouldShowError(): void
    {
        $this->guiAction
            ->navigate(C::BASE_URL)
            ->maximize()
            ->scrollTo(HomePage::linkAboutUs())
            ->screenshot()
            ->click(HomePage::linkAboutUs())
            ->screenshot()
            ->click(AboutUsPage::linkCareers())
            ->screenshot()
            ->click(BaytCompanyPage::linkFirstJob())
            ->focusOnNewTab()
            ->screenshot()
            ->click(BaytJobDescriptionPage::buttonApply())
            ->type(ApplicationFormPage::inputFirstName(), "Ahmed")
            ->type(ApplicationFormPage::inputLastName(), "Ali")
            ->type(ApplicationFormPage::inputEmail(),  self::$email)
            ->type(ApplicationFormPage::inputPassword(), self::$password)
            ->type(ApplicationFormPage::inputMobile(), "01234567897")
            ->scrollTo(ApplicationFormPage::buttonApplyNow())
            ->screenshot()
            ->click(ApplicationFormPage::buttonApplyNow())
            ->screenshot();

        $this->assertTrue(
            $this->guiAction->isElementDisplayed(ApplicationFormPage::errorMsgEmail())
        );
    }

    /** @depends testApplyingForAJobWhileNotLoggedIn */
    function testUserCanLoginSuccessfully(): void
    {
        $this->guiAction
            ->navigate(C::BASE_URL)
            ->maximize()
            ->screenshot()
            ->click(HomePage::linkLogin())
            ->type(LoginPage::inputEmail(), self::$email)
            ->type(LoginPage::inputPassword(), self::$password)
            ->click(LoginPage::buttonLogin())
            ->screenshot();

        assertTrue(
            $this->guiAction->isElementDisplayed(DashboardPage::linkDashboard())
        );
    }

    /** @depends testApplyingForAJobWhileNotLoggedIn */
    function testAfterDeletingAccountShouldRedirectToHomePage() : void {
        $this->guiAction
            ->navigate(C::BASE_URL)
            ->maximize()
            ->screenshot()
            ->click(HomePage::linkLogin())
            ->type(LoginPage::inputEmail(), self::$email)
            ->type(LoginPage::inputPassword(), self::$password)
            ->click(LoginPage::buttonLogin())
            ->screenshot()
            ->click(DashboardPage::linkMenu())
            ->screenshot()
            ->click(DashboardPage::linkAccountSettings())
            ->screenshot()
            ->scrollTo(MyAccountPage::linkDeleteMyAccount())
            ->click(MyAccountPage::linkDeleteMyAccount())
            ->screenshot()
            ->click(DeleteAccountConfirmationPage::buttonDelete())
            ->screenshot()
            ->click(DeleteAccountConfirmationPage::popupButtonDelete());

            $this->assertTrue(
                $this->guiAction->isElementDisplayed(HomePage::linkLogin())
            );
    }

    function testApplyForAJobUsingMobileView() : void {
        $this->guiAction
            ->navigate(C::BASE_URL)
            ->setWindwSize(500, 800)
            ->click(HomePage::inputSearch())
            ->type(HomePage::inputSelectorSearch(), "Quality Assurance Engineer")
            ->click(HomePage::optionInput("quality assurance engineer"))
            ->click(HomePage::selectorSearchCountry())
            ->type(HomePage::inputSelectorSearch(), "United Arab Emirates")
            ->click(HomePage::optionInput("United Arab Emirates"))
            ->screenshot()
            ->click(HomePage::buttonFindJobs())
            ->screenshot()
            ->click(HomePage::linkFirstJob())
            ->screenshot()
            ->click(JobDescriptionPage::buttonApply());

            $this->assertEquals(
                "Let's Start By Creating Your Account",
                $this->guiAction->getText(ApplicationFormPage::textSubTitle())
            );
    }
}
