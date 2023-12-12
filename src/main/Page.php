<?php

use Facebook\WebDriver\WebDriverBy;

class Common
{
    public static function inputSelectorSearch()
    {
        return WebDriverBy::cssSelector("div.is-active .list-menu-title input");
    }

    public static function optionSelector(String $locator)
    {
        return WebDriverBy::cssSelector("div.is-active .list-menu-group [data-text='" . $locator . "']");
    }

    public static function optionInput(String $locator)
    {
        return WebDriverBy::cssSelector("[data-text='" . $locator . "']");
    }
}

class HomePage extends Common
{

    public static function linkLogin(): WebDriverBy
    {
        return WebDriverBy::linkText('Log In');
    }

    public static function inputSearch(): WebDriverBy
    {
        return WebDriverBy::id('text_search');
    }

    public static function selectorSearchCountry(): WebDriverBy
    {
        return WebDriverBy::id('search_country__r');
    }

    public static function linkAboutUs(): WebDriverBy
    {
        return WebDriverBy::linkText("About Us");
    }

    public static function buttonFindJobs()
    {
       return WebDriverBy::cssSelector("[data-js-aid='search']");
    }

    public static function linkFirstJob()
    {
       return WebDriverBy::cssSelector("[data-js-job]:nth-child(2)");
    }
}

class AboutUsPage
{
    public static function linkCareers()
    {
        return WebDriverBy::linkText("Careers");
    }
}

class BaytCompanyPage
{
    public static function linkFirstJob()
    {
        return WebDriverBy::cssSelector(".is-4-d.is-12-m:first-child a[data-js-aid='jobTitle']");
    }
}

class BaytJobDescriptionPage
{
    public static function buttonApply()
    {
        return WebDriverBy::id("applyButton");
    }
}

class ApplicationFormPage
{
    public static function textSubTitle()
    {
        return WebDriverBy::tagName("h5");
    }

    public static function inputFirstName()
    {
        return WebDriverBy::id("JsApplicantRegisterForm_firstName");
    }

    public static function inputLastName()
    {
        return WebDriverBy::id("JsApplicantRegisterForm_lastName");
    }

    public static function inputEmail()
    {
        return WebDriverBy::id("JsApplicantRegisterForm_email");
    }

    public static function errorMsgEmail()
    {
        return WebDriverBy::id("JsApplicantRegisterForm_email_em_");
    }

    public static function inputPassword()
    {
        return WebDriverBy::id("JsApplicantRegisterForm_password");
    }

    public static function inputMobile()
    {
        return WebDriverBy::id("JsApplicantRegisterForm_mobPhone");
    }

    public static function buttonApplyNow()
    {
        return WebDriverBy::id("register");
    }
}

class AttachCVPage
{
    public static function buttonSkip()
    {
        return WebDriverBy::id("skip-btn");
    }
}

class CompleteCVPage extends Common
{
    public static function selectorBirthDay()
    {
        return WebDriverBy::id("personalInformationForm_birthDay__r");
    }

    public static function selectorBirthMonth()
    {
        return WebDriverBy::id("personalInformationForm_birthMonth__r");
    }

    public static function selectorBirthYear()
    {
        return WebDriverBy::id("personalInformationForm_birthYear__r");
    }

    public static function radioButtonMale()
    {
        return WebDriverBy::cssSelector("[for='personalInformationForm_gender_0']");
    }

    public static function selectorNationality()
    {
        return WebDriverBy::id("personalInformationForm_nationalityCitizenAc__r");
    }

    public static function radioButtonExperienceNo()
    {
        return WebDriverBy::cssSelector("[for='experienceForm_hasExperience_1']");
    }

    public static function selectorDegree()
    {
        return WebDriverBy::id("EducationForm_degree__r");
    }

    public static function inputUniversity()
    {
        return WebDriverBy::id("EducationForm_institution");
    }

    public static function selectorEducationCountry()
    {
        return WebDriverBy::id("EducationForm_educationCountry__r");
    }

    public static function selectorEducaitonCity()
    {
        return WebDriverBy::id("EducationForm_educationCity__r");
    }

    public static function inputFieldOfStudy()
    {
        return WebDriverBy::id("EducationForm_major");
    }

    public static function selectorGraduationMonth()
    {
        return WebDriverBy::id("EducationForm_completionMonth__r");
    }

    public static function selectorGraduationYear()
    {
        return WebDriverBy::id("EducationForm_completionYear__r");
    }

    public static function buttonSave()
    {
        return WebDriverBy::name("submit");
    }
}

class VisaStatusPage extends Common
{
    public static function selectorVisaStatus()
    {
        return WebDriverBy::id("applyToJobForm_visa_status__r");
    }

    public static function buttonApply()
    {
        return WebDriverBy::name("submit");
    }
}

class ApplicationSentPage
{
    public static function textTitle()
    {
        return WebDriverBy::cssSelector("h1.t-danger");
    }
}

class LoginPage
{
    public static function inputEmail()
    {
        return WebDriverBy::id("LoginForm_username");
    }

    public static function inputPassword()
    {
        return WebDriverBy::id("LoginForm_password");
    }

    public static function buttonLogin()
    {
        return WebDriverBy::id("login-button");
    }
}

class DashboardPage
{
    public static function linkDashboard()
    {
        return WebDriverBy::linkText("Dashboard");
    }

    public static function linkMenu()
    {
        return WebDriverBy::xpath("//li[@data-popover='{\"trigger\":\"click\"}']//a[@href='#']");
    }

    public static function linkAccountSettings()
    {
        return WebDriverBy::linkText("Account Settings");
    }
}

class MyAccountPage {
    public static function linkDeleteMyAccount() {
            return WebDriverBy::linkText("Delete My Account");
        }
}

class DeleteAccountConfirmationPage {
    public static function buttonDelete()
    {
       return WebDriverBy::cssSelector(".btn.is-danger");
    }

    public static function popupButtonDelete()
    {
       return WebDriverBy::cssSelector("[data-js-aid='delete']");
    }
}

class JobDescriptionPage {
    public static function buttonApply() {
            return WebDriverBy::xpath("//div[@id='view_inner'] //a[@class='btn  is-small  u-expanded-m m' and contains(., 'Apply on company site')]");
        }
}
