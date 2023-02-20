<?php

namespace App\Services;

use App\Repositories\CampaignRepository;
use App\Repositories\Repository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class Service
{
    /**
     * @var $repository
     */
    protected $repository;

    /**
     * PostService constructor.
     *
     * @param CampaignRepository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function savePostData($data)
    {


        return $result;
    }
}