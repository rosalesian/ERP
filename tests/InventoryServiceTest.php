<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Nixzen\Services\InventoryService;
use Nixzen\Repositories\InventoryRepository;
use Illuminate\Support\Collection;
use Nixzen\Models\Inventory;

class InventoryServiceTest extends TestCase
{
		protected $mock;

		protected $inventory;

		public function setUp()
		{
			parent::setUp();

			$this->mock = $this->mock('Nixzen\Repositories\InventoryRepository');
			$this->inventory = new Inventory;

		}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testWriteInForItemNotInTheInventory()
    {
				$this->mock->shouldReceive('findBy')
									->once()
									->andReturn(null);
				$this->mock->shouldReceive('create')->once()->andReturn('hello');
				$inventory = new InventoryService($this->mock);
        $result = $inventory->in(1,1,2,3,4,5);
				$this->assertEquals('hello', $result);
    }

		public function testWriteInForItemExistInTheInventory()
		{
				$this->mock->shouldReceive('findBy->update')
									->once()
									->andReturn('hello');
				$inventory = new InventoryService($this->mock);
				$result = $inventory->in(1,1,2,3,4,5);
				$this->assertEquals('hello', $result);
		}

		public function mock($class)
		{
			$mock = Mockery::mock($class);
			$this->app->instance($class, $mock);
			return $mock;
		}

		public function tearDown()
		{
			Mockery::close();
		}
}
