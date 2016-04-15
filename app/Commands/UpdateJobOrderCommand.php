<?php

namespace Nixzen\Commands;

use Nixzen\Commands\Command;


class UpdateJobOrderCommand extends Command 
{
    public $transnumber;
    public $transdate;
    public $asset_id;
    public $requested_by;
    public $maintenancetype_id;
    public $prcategory_id;
    public $purchaserequest_id;
    public $memo;
    public $labor_costs;
    public $joborder;

    /**
     * Create a new command instance.
     *
     * @return void
     */
     public function __construct($transdate, $asset_id, $requested_by, $maintenancetype_id, $prcategory_id, $purchaserequest_id, $memo, $labor_costs, $joborder)
    {
        $this->transdate = $transdate;
        $this->transnumber = rand();
        $this->asset_id = $asset_id;
        $this->requested_by = $requested_by;
        $this->maintenancetype_id = $maintenancetype_id;
        $this->prcategory_id = $prcategory_id;
        $this->purchaserequest_id = $purchaserequest_id;
        $this->memo = $memo;
        $this->joborder = $joborder;
        if(gettype($labor_costs) == "string") {
                $this->labor_costs = json_decode($labor_costs);
        }
        else{
            $this->labor_costs = $labor_costs;
        }
    }
}
