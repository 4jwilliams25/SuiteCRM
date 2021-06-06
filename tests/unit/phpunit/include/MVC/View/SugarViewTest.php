<?php

use SuiteCRM\Tests\SuiteCRM\Test\SuitePHPUnitFrameworkTestCase;

class SugarViewTest extends SuitePHPUnitFrameworkTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        global $current_user;
        get_sugar_config_defaults();
        $current_user = BeanFactory::newBean('Users');
    }

    public function testinit()
    {
        //error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $SugarView = new SugarView();

        //execute the method and check if it works and doesn't throws an exception
        try {
            $SugarView->init();
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }

        self::assertTrue(true);
    }

    public function testprocess()
    {
        // test
        $SugarView = new SugarView();
        $SugarView->module = 'Users';
        $GLOBALS['app'] = new SugarApplication();

        //execute the method and check if it works and doesn't throws an exception
        //secondly check if it outputs any content to browser
        try {
            ob_start();

            $SugarView->process();

            $renderedContent = ob_get_contents();
            ob_end_clean();

            self::assertGreaterThan(0, strlen($renderedContent));
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }
    }

    public function testdisplayErrors()
    {
        $SugarView = new SugarView();

        //execute the method and check if it works and doesn't throws an exception
        try {
            $errors = $SugarView->displayErrors();
            self::assertEmpty($errors, print_r($SugarView, true));
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }

        self::assertTrue(true);
    }

    public function testpreDisplay()
    {
        $SugarView = new SugarView();

        //execute the method and check if it works and doesn't throws an exception
        try {
            $SugarView->preDisplay();
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }

        self::assertTrue(true);
    }

    public function testdisplay()
    {
        $SugarView = new SugarView();

        //execute the method and check if it works and doesn't throws an exception
        try {
            $SugarView->display();
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }

        self::assertTrue(true);
    }

    public function testdisplayHeader()
    {
        $SugarView = new SugarView();
        $SugarView->module = 'Users';
        $GLOBALS['app'] = new SugarApplication();

        //execute the method and check if it works and doesn't throws an exception
        //secondly check if it outputs any content to browser
        try {
            ob_start();

            $SugarView->displayHeader();

            $renderedContent = ob_get_contents();
            ob_end_clean();

            self::assertGreaterThan(0, strlen($renderedContent));
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }
    }

    public function testgetModuleMenuHTML()
    {
        $SugarView = new SugarView();

        //execute the method and check if it works and doesn't throws an exception
        try {
            $SugarView->getModuleMenuHTML();
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }

        self::assertTrue(true);
    }

    public function testincludeClassicFile()
    {
        $SugarView = new SugarView();

        //execute the method and check if it works and doesn't throws an exception
        //use any valid file path, we just need to avoid failing require_once
        try {
            $SugarView->includeClassicFile('config.php');
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }

        self::assertTrue(true);
    }

    public function testgetJavascriptValidation()
    {
        //check if it returns any text i-e JS code
        $js = SugarView::getJavascriptValidation();
        self::assertGreaterThan(0, strlen($js));
    }

    public function testdisplayFooter()
    {
        $SugarView = new SugarView();

        //execute the method and check if it works and doesn't throws an exception
        //secondly check if it outputs any content to browser
        try {
            ob_start();

            $SugarView->displayFooter();

            $renderedContent = ob_get_contents();
            ob_end_clean();

            self::assertGreaterThan(0, strlen($renderedContent));
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }
    }

    public function testrenderJavascript()
    {
        $SugarView = new SugarView();

        //execute the method and check if it works and doesn't throws an exception
        //secondly check if it outputs any content to browser
        try {
            ob_start();

            $SugarView->renderJavascript();

            $renderedContent = ob_get_contents();
            ob_end_clean();

            self::assertGreaterThan(0, strlen($renderedContent));
        } catch (Exception $e) {
            self::fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
        }
    }

    public function testgetMenu()
    {
        ////error_reporting(E_ALL);

        //execute the method and check if it works and throws an exception if no module is provided
        //it creates memory Fatal errors which causes PHPunit to crash so we will skip this scenario
        /*
    	try {
    		//check first with invalid value and test if it throws an exception
    		$menu = $SugarView->getMenu();
    		//$this->assertTrue(is_array($menu));

    	} catch (Exception $e) {
    		$this->assertTrue(TRUE);
    		//$this->fail($e->getMessage() . "\nTrace:\n" . $e->getTraceAsString());
    	} */

        //check with valid value and check if it returns an array.
        $menu = (new SugarView())->getMenu('Users');
        self::assertIsArray($menu);
    }

    public function testgetModuleTitle()
    {
        $SugarView = new SugarView();

        //first execute the method with default value
        $moduleTitle = $SugarView->getModuleTitle();
        self::assertGreaterThan(0, strlen($moduleTitle));

        //second execute the method with true value
        $moduleTitle = $SugarView->getModuleTitle(true);
        self::assertGreaterThan(0, strlen($moduleTitle));

        //third execute the method with false value
        $moduleTitle = $SugarView->getModuleTitle(false);
        self::assertGreaterThan(0, strlen($moduleTitle));
    }

    public function testgetMetaDataFile()
    {
        $SugarView = new SugarView();

        //first execute the method with missing attributes. it should return Null.
        $metaDataFile = $SugarView->getMetaDataFile();
        self::assertEquals(null, $metaDataFile);

        //second execute the method with valid attributes set. it should return a file path string.
        $SugarView->type = 'detail';
        $SugarView->module = 'Users';

        $metaDataFile = $SugarView->getMetaDataFile();
        self::assertGreaterThan(0, strlen($metaDataFile));
    }

    public function testgetBrowserTitle()
    {
        //execute the method. it should return a title string.
        $browserTitle = (new SugarView())->getBrowserTitle();
        self::assertGreaterThan(0, strlen($browserTitle));
    }

    public function testgetBreadCrumbSymbol()
    {
        //execute the method. it should return a string.
        $breadCrumbSymbol = (new SugarView())->getBreadCrumbSymbol();
        self::assertGreaterThan(0, strlen($breadCrumbSymbol));
    }

    public function testcheckPostMaxSizeError()
    {
        //execute the method. it should return False because Request parameters are not available.
        $postMaxSizeError = (new SugarView())->checkPostMaxSizeError();
        self::assertFalse($postMaxSizeError);
    }
}
