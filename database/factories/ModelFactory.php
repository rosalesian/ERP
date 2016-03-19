<?php

/*
|---  -----------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Nixzen\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Nixzen\Models\VendorPayment::class, function ($faker) {
		return [
				'transno' => $faker->numberBetween(1, 5),
				'coa_id' => $faker->numberBetween(1, 5),
				'payee_id' => $faker->numberBetween(1, 5),
				'date' => $faker->dateTime('now'),
				'posting_period_id' => $faker->numberBetween(1, 5),
				'checkno' => $faker->numberBetween(1, 5),
				'checkdate' => $faker->dateTime('now'),
				'principal_id' => $faker->numberBetween(1, 5),
				'branch_id' => $faker->numberBetween(1, 5)
		];
});
$factory->define(Nixzen\Models\Item::class, function ($faker) {
		return [
				'itemcode' => $faker->numerify('#######'),
				'description' => $faker->text,
				'unittype_id' => $faker->numberBetween(1, 5),
				'itemtype_id' => $faker->numberBetween(1, 5),
				'default_purchaseunit_id' => $faker->numberBetween(1, 5),
				'default_salesunit_id' => $faker->numberBetween(1, 5),
				'default_stockunit_id' => $faker->numberBetween(1, 5),
				'itemcategory_id' => $faker->numberBetween(1, 5),
				'expensecategory_id' => $faker->numberBetween(1, 5),
				'taxcode_id' => $faker->numberBetween(1, 5),
				'account_id' => $faker->numberBetween(1, 5)
		];
});
$factory->define(Nixzen\Models\PurchaseOrder::class, function ($faker) {
		return [
				'vendor_id'	=> $faker->numberBetween(1, 5),
				'terms_id'	=> $faker->numberBetween(1, 5),
				'type_id'	=>	$faker->numberBetween(1, 5),
				'date'	=> $faker->dateTime('now'),
				'paymenttype_id'	=> $faker->numberBetween(1, 5),
				'memo'	=> $faker->text(),
		];
});

$factory->define(Nixzen\Models\PurchaseOrderItem::class, function ($faker) {
		return [
			'item_id'=> $faker->numberBetween(1, 5),
			'quantity'=> $faker->numberBetween(1, 10),
			'uom_id'=> $faker->numberBetween(1, 5)
		];
});

$factory->define(Nixzen\Models\ItemReceipt::class, function ($faker) {
		return [
				'created_by'	=> $faker->numberBetween(1, 5),
				'date'	=> $faker->dateTime('now'),
				'remarks'	=> $faker->text
		];
});

$factory->define(Nixzen\Models\ItemReceiptItem::class, function ($faker) {
		return [
			'purchaseorderitem_id'=> $faker->numberBetween(1, 2),
			'quantity_received'=> $faker->numberBetween(1, 10),
		];
});

$factory->define(Nixzen\Models\PurchaseRequest::class, function ($faker) {
		return [
				'requester' => $faker->numberBetween(1, 5),
				'type_id' => $faker->numberBetween(1, 5),
				'date' => $faker->dateTime('now'),
				'deliver_to'=> $faker->numberBetween(1, 5),
				'remarks' => $faker->text
		];
});

$factory->define(Nixzen\Models\PurchaseRequestItem::class, function ($faker) {
		return [
				'item_id' => $faker->numberBetween(1, 3),
				'quantity' => $faker->numberBetween(10,15 ),
				'unit_id' => $faker->numberBetween(1, 3)
		];
});
$factory->define(Nixzen\Models\Vendor::class, function ($faker) {
		return [
				'name'	=>	$faker->company,
				'description'	=> $faker->text,
				'email'	=> $faker->email,
				'phone'	=> $faker->phoneNumber,
				'faxno'	=> $faker->phoneNumber,
				'contact_person'	=> $faker->name,
				'auto_apply_wtax' => $faker->boolean($chanseofGettingTrue = 50),
				'vendorcategories_id'	=> $faker->numberBetween(1, 5),
				'tin'	=> $faker->numerify('###-###-###'),
				'branch_id'	=> $faker->numberBetween(1, 3),
				'taxcode_id'	=> $faker->numberBetween(1, 3),
				'term_id'	=> $faker->numberBetween(1, 5),
				'inactive'	=> false,
				'created_by'	=> $faker->numberBetween(1, 3),
				'updated_by'	=> $faker->numberBetween(1, 3)
		];
});

$factory->define(Nixzen\Models\VendorCategory::class, function ($faker) {
		return [
				'name'	=> $faker->randomElement(['cat1', 'cat2', 'cat3']),
				'description'	=> $faker->text
		];
});


$factory->define(Nixzen\Models\Branch::class, function ($faker) {
		return [
				'name'	=> $faker->randomElement(['tagunol', 'pakanaan', 'bohol', 'tacloban', 'hq']),
				'description'	=> $faker->text,
				'company_id'	=> $faker->numberBetween(1, 3)
		];
});
$factory->define(Nixzen\Models\Terms::class, function ($faker) {
		return [
				'name'	=> $faker->randomElement(['1 day', '15 days', '25 days']),
				'description'	=> $faker->text
		];
});

$factory->define(Nixzen\Models\PaymentType::class, function ($faker) {
		return [
				'name'	=> $faker->randomElement(['cash', 'check']),
				'description'	=> $faker->text
		];
});
