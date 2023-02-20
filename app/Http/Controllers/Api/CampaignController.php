<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Models\CampaignImage;
use App\Services\CampaignService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    protected $service;

    public function __construct(CampaignService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json( [
            'status' => true,
            'data' => CampaignResource::collection(
                $this->service->getAll()
            )
        ], 200);

    }

    public function store(CampaignRequest $request)
    {
        $campaign = $this->service->savePostData($request->validated());
        return response()->json([
            'status' => true,
            "message" => __('messaeges.created'),
            "data" => $campaign
        ], 201);
    }

    
    public function show(Campaign $campaign)
    {
        return response()->json([
            'status' => true,
            "message" => __('messages.view'),
            "data" => new CampaignResource($campaign)
        ], 200);


    }

    public function update(CampaignRequest $request, Campaign $campaign)
    {
        $campaign = $this->service->update($campaign , $request->validated());
        return response()->json([
            'status' => true,
            "message" => __('messages.updated'),
            "data" => new CampaignResource($campaign)
        ], 200);

    }

    public function destroy(Campaign $campaign)
    {
        $status = $this->service->delete($campaign);
        return response()->json([
            'status' => true,
            "message" => __('messages.deleted'),
        ], 202);
    }
    public function destroyImage(CampaignImage $image)
    {
        $image->delete();
        return response()->json([
            'status' => true,
            "message" => __('messages.deleted'),
        ], 202);
    }
}