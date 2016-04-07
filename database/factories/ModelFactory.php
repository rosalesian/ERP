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
$factory->define(Nixzen\Models\Lists::class, function ($faker) {
		return [
				'name' => $faker->word,
				'description' => $faker->text
		];
});
$factory->define(Nixzen\Models\Inventory::class, function ($faker) {
		return [
				'item_id' => $faker->numberBetween(1, 5),
				'company_id' => $faker->numberBetween(1, 5),
				'branch_id' => $faker->numberBetween(1, 5),
				'location_id' => $faker->numberBetween(1, 5),
				'bin_id' => $faker->numberBetween(1, 5),
				'lot_id' => $faker->numberBetween(1, 5),
				'quantity' => $faker->numberBetween(1, 5),
		];
});
$factory->define(Nixzen\Models\ListItem::class, function ($faker) {
		return [
				'name' => $faker->word,
				'inactive' => false
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
$factory->define(Nixzen\Models\VendorPaymentItem::class, function ($faker) {
	return [
		'apply' => true,
		'bill_id' => 1
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
		'unit_id'=> $faker->numberBetween(1, 5),
		'amount' => $faker->randomFloat(100, 500)
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
		'deliver_to'=> $faker->word,
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


$factory->define(Nixzen\Models\Lists\Branch::class, function ($faker) {
	return [
		'name'	=> $faker->unique()->randomElement(['tagunol', 'pakanaan', 'bohol', 'tacloban', 'hq']),
		'description'	=> $faker->text,
		'company_id'	=> $faker->numberBetween(1, 3),
		'created_by' => $faker->numberBetween(1, 3),
		'updated_by' => $faker->numberBetween(1, 3)
	];
});

$factory->define(Nixzen\Models\Lists\Department::class, function ($faker) {
	return [
		'name'	=> $faker->randomElement(['IT', 'FINANCE', 'OPERATION']),
		'description'	=> $faker->text,
		'company_id'	=> $faker->numberBetween(1, 3),
		'created_by' => $faker->numberBetween(1, 3),
		'updated_by' => $faker->numberBetween(1, 3)
	];
});

$factory->define(Nixzen\Models\Lists\Division::class, function ($faker) {
	return [
		'name'	=> $faker->randomElement(['PG', 'MONDELEZ', 'NUTRI-ASIA']),
		'description'	=> $faker->text,
		'company_id'	=> $faker->numberBetween(1, 3),
		'created_by' => $faker->numberBetween(1, 3),
		'updated_by' => $faker->numberBetween(1, 3)
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


$factory->define(Nixzen\Models\VendorBill::class, function ($faker) {
	return [
		'vendor_id' => $faker->numberBetween(1, 2),
		'transno' => $faker->numerify('###'),
		'suppliers_inv_no' => $faker->numerify('###'),
		'date' => $faker->dateTime('now'),
		'duedate' => $faker->dateTime('now'), //date('Y/m/d')
		'billtype_id' => 2,
		'billtype_nontrade_subtype_id' => $faker->numberBetween(1, 2),
		'coa_id' => $faker->numberBetween(1, 2),
		'terms_id' => $faker->numberBetween(1, 2),
		'posting_period_id' => $faker->numberBetween(1, 2),
		'department_id' => $faker->numberBetween(1, 2),
		'division_id' => $faker->numberBetween(1, 2),
		'branch_id' => $faker->numberBetween(1, 2),
		'memo' =>  $faker->text()
	];
});

$factory->define(Nixzen\Models\VendorBillItem::class, function ($faker) {
	return [
		'item_id' => $faker->numberBetween(1, 3),
		'quantity' => $faker->numberBetween(10,15 ),
		'uom_id' => $faker->numberBetween(1, 3),
		'unit_cost' => $faker->numberBetween(100, 200),
		'amount' => $faker->numberBetween(100, 200),
		'taxcode_id' => $faker->numberBetween(1, 3),
		'tax_amount' => $faker->numberBetween(1, 3),
		'gross_amount' => $faker->numberBetween(1, 3)
	];
});

$factory->define(Nixzen\Models\VendorBillExpenses::class, function ($faker) {
	return [
		'coa_id' => $faker->numberBetween(1, 3),
		'amount' => $faker->numberBetween(100, 300),
		'taxcode_id' => $faker->numberBetween(1, 3),
		'tax_amount' => $faker->numberBetween(1, 3),
		'gross_amount' => $faker->numberBetween(100, 300),
		'department_id' => $faker->numberBetween(1, 2),
		'division_id' => $faker->numberBetween(1, 2),
		'branch_id' => $faker->numberBetween(1, 2),
		'vendor_id' => $faker->numberBetween(1, 2)
	];
});

$factory->define(Nixzen\Models\BillType::class, function ($faker) {
	return [
		'name'	=> $faker->randomElement(['Trade', 'Non-Trade'])
	];
});

$factory->define(Nixzen\Models\BillTypeNonTradeSubType::class, function ($faker) {
	return [
		'bill_type_id' => 2,
		'name'	=> $faker->randomElement(['Payroll', 'Branch-Expense']),
		'description'	=> $faker->text
	];
});
$factory->define(Nixzen\Models\Canvass::class, function ($faker) {
	return [
		'vendor_id' => $faker->numberBetween(1, 50),
		'cost' => $faker->numberBetween(100, 1000),
		'terms_id' => $faker->numberBetween(0, 2)
	];
});
$factory->define(Nixzen\Models\UnitType::class, function ($faker) {
	return [
		'name' => $faker->word
	];
});
$factory->define(Nixzen\Models\Unit::class, function ($faker) {
	return [
		'name' => $faker->word,
		'pluralname' => $faker->word,
		'abbreviation' => $faker->word,
		'conversion_rate' => 1,
		'base_unit' => true,
	];
});

$factory->define(Nixzen\Models\ItemTypes::class, function ($faker) {
	return [
		'name' => $faker->word,
		'description' => $faker->word,
		'company_id' => 0,
		'created_by' => 0,
		'updated_by' => 0
	];
});

$factory->define(Nixzen\Models\ChartOfAccount::class, function ($faker) {
	return [
		'title' => $faker->word,
		'code' => $faker->word
	];
});

$factory->define(Nixzen\Models\Taxcode::class, function ($faker) {
	return [
		'name' => $faker->word,
		'description' => $faker->word,
		'rate' => $faker->numberBetween(0, 2),
		'inactive' => 0,
		'created_by' => 1,
		'updated_by' => 1
	];
});
