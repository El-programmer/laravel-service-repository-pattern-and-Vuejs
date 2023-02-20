<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\CampaignImage;
use App\Repositories\CampaignRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use InvalidArgumentException;

class CampaignService
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
    public function __construct(CampaignRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all post.
     *
     * @return String
     */
    public function getAll($cols = ['*'] ,$with = [])
    {
        return $this->repository->getAll($cols ,$with);
    }

    /**
     * Get post by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function savePostData($data)
    {
        $campaign = $this->repository->save($data);
        $images = $this->uploadImages(request()->images , $campaign);
        CampaignImage::insert($images);

        return $campaign;
    }

    /**
     * Update post data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update($campaign , $data)
    {
        DB::beginTransaction();
        try {
            $campaign->update($data);
//            $this->repository->update($data , $campaign->id );
           $images = $this->uploadImages(request()->images , $campaign);
            CampaignImage::insert($images);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update post data');
        }

        DB::commit();

        return $campaign;

    }

    /**
     * Delete post by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $campaign = $this->repository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete post data');
        }

        DB::commit();

        return $campaign;

    }
    public function delete($campaign)
    {
        DB::beginTransaction();

        try {
            $status =  $campaign->delete();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete post data');
        }

        DB::commit();

        return $status;

    }

    public function uploadImages($images , $campaign){
        $imagesData = [];
        foreach (request()->images ??[] as $image){
            $images [] =[
                'slug' => Str::uuid()->getHex(),
                'campaign_id' => $campaign->id ,
                'driver' => 'campaign',
                'file' =>Storage::disk('campaign')->put($campaign->id,$image)
            ];
        }
        return $imagesData;
    }
}