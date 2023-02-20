<?php

namespace App\Repositories;

use App\Models\Campaign;

class CampaignRepository extends Repository
{
    /**
     * @var Campaign
     */
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Campaign $Campaign
     */
    public function __construct(Campaign $campaign)
    {
        $this->model = $campaign;
    }

}