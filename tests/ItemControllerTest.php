<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemControllerTest extends TestCase
{
		use DatabaseMigrations, WithoutMiddleware;

		public function __construct()
		{
			$this->item = new Nixzen\Models\Item;
		}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
      $response = $this->call('GET', 'item');
			$this->assertViewHas('items');
			$items = $response->original->getData()['items'];
			$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $items);
    }

		public function testCreate()
		{
			$response = $this->call('GET', 'item/create');
			$this->assertResponseOk();
		}

		public function testStore()
		{
			$request = $this->makeRequestData();
			$response = $this->call('POST', 'item', $request);
			$item = $this->item->all()->last();
			$this->assertRedirectedToRoute('item.show', [$item]);
		}

		public function testShow()
		{
			$response = $this->call('GET', 'item/1');
			$this->assertResponseOk();
			$this->assertViewHas('item');
		}

		public function testEdit()
		{
			$response = $this->call('GET', 'item/1/edit');
			$this->assertViewHas('item');
		}

		public function testUpdate()
		{
			$this->makeItemFactory();
			$request = $this->makeRequestData();
			$response = $this->call('PATCH', 'item/1', $request);
			$this->assertRedirectedToRoute('item.show', [1]);
		}

		public function testDestroy()
		{
			$response = $this->call('DELETE', 'item/1');
			$this->assertRedirectedToRoute('item.index');
		}

		public function makeRequestData()
		{
			$request = [
				'itemcode' => 1,
				'description' => 'this is a test',
				'unittype_id' => 1,
				'itemtype_id' => 1,
				'default_purchaseunit_id' => 1,
				'default_salesunit_id' => 1,
				'default_stockunit_id' => 1,
				'itemcategory_id' => 1,
				'expensecategory_id' => 1,
				'taxcode_id' => 1,
				'account_id' => 1,
			];

			return $request;
		}

		public function makeItemFactory()
		{
			factory(Nixzen\Models\Item::class, 5)->create();
		}
}
