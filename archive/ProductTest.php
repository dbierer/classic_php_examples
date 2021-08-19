<?php

require_once 'db_pdo_fetch_class.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * Product test case.
 */
class ProductTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var Product
	 */
	private $Product;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		// TODO Auto-generated ProductTest::setUp()
		
		$this->Product = new Product(/* parameters */);
	
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated ProductTest::tearDown()
		
		$this->Product = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests Product->__construct()
	 */
	public function test__construct() {
		// TODO Auto-generated ProductTest->test__construct()
		$this->markTestIncomplete ( "__construct test not implemented" );
		
		$this->Product->__construct(/* parameters */);
	
	}
	
	/**
	 * Tests Product->__set()
	 */
	public function test__set() {
		// TODO Auto-generated ProductTest->test__set()
		$this->markTestIncomplete ( "__set test not implemented" );
		
		$this->Product->__set(/* parameters */);
	
	}
	
	/**
	 * Tests Product->__get()
	 */
	public function test__get() {
		// TODO Auto-generated ProductTest->test__get()
		$this->markTestIncomplete ( "__get test not implemented" );
		
		$this->Product->__get(/* parameters */);
	
	}
	
	/**
	 * Tests Product->calc()
	 */
	public function testCalc() {
		// TODO Auto-generated ProductTest->testCalc()
		$this->markTestIncomplete ( "calc test not implemented" );
		
		$this->Product->calc(/* parameters */);
	
	}

}

