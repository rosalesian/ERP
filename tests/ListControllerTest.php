<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListControllerTest extends TestCase
{
		use DatabaseMigrations, WithoutMiddleware;

		protected $lists;

		public function __construct()
		{
				$this->lists = new Nixzen\Models\Lists;
		}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->call('GET', 'lists');
				$this->assertViewHas('lists');
    }

		public function testCreate()
		{
				$this->call('GET', 'lists/create');
				$this->assertResponseOk();
		}

		public function testStore()
		{
				$items = [
					['name' => 'List 1'],
					['name' => 'List 2'],
					['name' => 'List 3']
				];
				$request = [
					'name' => 'Test Lists',
					'description' => 'this is a test',
					'items' => json_encode($items)
				];

				$response = $this->call('POST', 'lists', $request);
				//dd($response->original);
				$lists = $this->lists->all()->first();
				$this->assertRedirectedToRoute('lists.show', [$lists]);
		}

		public function testShow()
		{
				$this->call('GET', 'lists/1');
				$this->assertViewHas('lists');
		}

		public function testEdit()
		{
				$this->call('GET', 'lists/1/edit');
				$this->assertViewHas('lists');
		}

		public function testUpdate()
		{
				factory(Nixzen\Models\Lists::class, 5)
						->create()
						->each(function ($list) {
								$list->items()->saveMany(factory(Nixzen\Models\ListItem::class, 5)->create(['lists_id'=>$list->id]));
						});
				$items = [
					['name' => 'List 1'],
					['name' => 'List 2'],
					['name' => 'List 3']
				];
				$request = [
					'name' => 'Test Lists',
					'description' => 'this is a test',
					'items' => json_encode($items)
				];

				$response = $this->call('PATCH', 'lists/1', $request);
				//dd($response->original);
				$this->assertRedirectedToRoute('lists.show', [1]);
		}

		public function testDestroy()
		{
				$this->call('DELETE', 'lists/1');
				$this->assertRedirectedToRoute('lists.index');
		}
}
