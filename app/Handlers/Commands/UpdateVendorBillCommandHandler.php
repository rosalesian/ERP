<?php

namespace Nixzen\Handlers\Commands;

use Nixzen\Commands\UpdateVendorBillCommand;
use Illuminate\Queue\InteractsWithQueue;

class UpdateVendorBillCommandHandler
{
    /**
     * Create the command handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the command.
     *
     * @param  UpdateVendorBillCommand  $command
     * @return void
     */
    public function handle(UpdateVendorBillCommand $command)
    {
        $command->vendorbill->update((array)$command);

        if($command->items)
        {

            $item_ids = array_map(function($i) {
                return is_object($i) ? $i->id : $i['id'];
            }, $command->items);

            $command->vendorbill->removeitems($item_ids);

            foreach($command->items as $item){

                $vendorbillitem = $command->vendorbill->items()->firstOrNew([
                        'id' => $item->id
                ]);
                $vendorbillitem->item_id = $item->item_id;
                $vendorbillitem->quantity = $item->quantity;
                $vendorbillitem->uom_id = $item->uom_id;
                $vendorbillitem->unit_cost = $item->unit_cost;
                $vendorbillitem->amount = $item->amount;
                $vendorbillitem->taxcode_id = $item->taxcode_id;
                $vendorbillitem->tax_amount = $item->tax_amount;
                $vendorbillitem->gross_amount = $item->gross_amount;
                $vendorbillitem->save();
            }
        }

        if($command->expenses)
        {

            $expense_ids = array_map(function($e) {
                return is_object($e) ? $e->id : $e['id'];
            }, $command->expenses);

            $command->vendorbill->removeexpenses($expense_ids);

            foreach($command->expenses as $expense){

                $vendorbillexpense = $command->vendorbill->expenses()->firstOrNew([
                        'id' => $expense->id
                ]);
                $vendorbillexpense->coa_id = $expense->coa_id;
                $vendorbillexpense->amount = $expense->amount;
                $vendorbillexpense->taxcode_id = $expense->taxcode_id;
                $vendorbillexpense->tax_amount = $expense->tax_amount;
                $vendorbillexpense->gross_amount = $expense->gross_amount;
                $vendorbillexpense->department_id = $expense->department_id;
                $vendorbillexpense->division_id = $expense->division_id;
                $vendorbillexpense->branch_id = $expense->branch_id;
                $vendorbillexpense->vendor_id = $expense->vendor_id;
                $vendorbillexpense->save();
            }
        }
    }
}
