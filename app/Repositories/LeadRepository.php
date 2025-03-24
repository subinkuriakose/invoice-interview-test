<?php

namespace App\Repositories;

use App\Interfaces\LeadRepositoryInterface;
use App\Models\Lead;

class LeadRepository implements LeadRepositoryInterface 
{
    public function createLead($data)
    {
        return Lead::create($data);
    }

    
    
}
