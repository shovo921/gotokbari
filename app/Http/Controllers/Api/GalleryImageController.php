<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\GalleryImageResource;
use App\Models\GalleryImage;
use App\Models\Member;
use App\Upload;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $gallery_image_id = GalleryImage::where('user_id', request()->user()->id)->latest()->get();
        return GalleryImageResource::collection($gallery_image_id)->additional([
            'result' => true
        ]);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (package_validity(auth()->user()->id)) {
            if (get_remaining_package_value(auth()->user()->id, 'remaining_photo_gallery') > 0) {
                // image upload
                $photo = null;
                if ($request->hasFile('gallery_image')) {
                    $photo = upload_api_file($request->file('gallery_image'));
                }
                // $gallery_images = [];
                // if ($request->hasFile('gallery_images')) {             
                //     foreach ($request->file('gallery_images') as $key => $gallery_image) {
                //         $photo = upload_api_file($gallery_image);
                //         $gallery_images[] = $photo;
                //     }                  
                // }
                // $gallery_images = implode(',', $gallery_images);

                GalleryImage::create([
                    'user_id' => auth()->user()->id,
                    'image'   => $photo
                ]);

                $member = Member::where('user_id', auth()->user()->id)->first();
                $member->remaining_photo_gallery = $member->remaining_photo_gallery - 1;
                $member->save();
                return $this->success_message('Gallery image uploaded successfully.');
            }
            return $this->failure_message('You have 0 remaining gallery photo upload. Please update your package.');
        }
        return $this->failure_message('Your package has been expired. Please update your package.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (GalleryImage::destroy($id)) {
            return $this->success_message('Image deleted successfully.');
        }
        return $this->failure_message('Sorry! Something went wrong.');
    }
}
