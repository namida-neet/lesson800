<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StarsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StarsTable Test Case
 */
class StarsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StarsTable
     */
    public $Stars;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Stars',
        'app.Users',
        'app.Posts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Stars') ? [] : ['className' => StarsTable::class];
        $this->Stars = TableRegistry::getTableLocator()->get('Stars', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stars);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
