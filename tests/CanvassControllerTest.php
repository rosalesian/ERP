<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CanvassControllerTest extends TestCase
{
		use DatabaseMigrations, WithoutMiddleware;

		public $canvass;

		public function __construct()
		{
			$this->canvass = new Nixzen\Models\Canvass;
		}
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
			//create mock data to database
			$pr = $this->makePurchaseRequestFactory();

			//get first line of pr
			$prItem = $pr->first()->items()->first();

			$canvasses = $this->canvass->where('purchaserequisition_id', $prItem->id)->get();

			//assertion
      $this->get('api/1.0/pritem/'. $prItem->id .'/canvass')
					->seeJson([
						'canvasses' => $canvasses
					]);
    }

		public function testSave()
		{
			//create mock data to database
			$pr = $this->makePurchaseRequestFactory();

			$canvasses = [
				['vendor_id' => 1, 'cost' => 1000.00, 'terms_id' => 1],
				['vendor_id' => 2, 'cost' => 1100.00, 'terms_id' => 1],
				['vendor_id' => 3, 'cost' => 1010.00, 'terms_id' => 1],
			];

			//mock input data
			$data = ['canvasses' => json_encode($canvasses)];
			//get first item from pr
			$prItem = $pr->first()->items()->first();
			//assertion
			$this->post('api/1.0/pritem/1/canvass', $data)
					->seeJson([
						'message' => 'canvass was created'
					]);
		}

		public function makePurchaseRequestFactory()
		{
			$pr = factory(Nixzen\Models\PurchaseRequest::class, 3)
					->create()
					->each(function($pr){
							$item = factory(Nixzen\Models\PurchaseRequestItem::class)->create(['purchaserequisition_id' => $pr->id]);
							$pr->save([$item]);
					});

			return $pr;
		}
}
