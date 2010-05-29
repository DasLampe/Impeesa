<?php
if (! defined('SIMPLE_TEST')) {
	define('SIMPLE_TEST', '../simpletest/');
}
require_once(SIMPLE_TEST . 'unit_tester.php');
require_once(SIMPLE_TEST . 'reporter.php');
require_once(SIMPLE_TEST . 'browser.php');

define( 'BASE_URL', 'http://localhost/Freizeit/impeesa/' );

class TestErrorPages extends UnitTestCase {
	function test_main_dispatch() {
		$browser = &new SimpleBrowser();
		$html = $browser->get( BASE_URL.'diese-seite-gibts-nicht' );
		$this->assertEqual( "404", $browser->getResponseCode() );

		$html = $browser->get( BASE_URL.'content/diese-seite-gibts-nicht' );
		$this->assertEqual( "404", $browser->getResponseCode() );
	}
}

if( isset($_SERVER['argv']) ){
	$test = new TestErrorPages();
	$test->run(new TextReporter());
}
