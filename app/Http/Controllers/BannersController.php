<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Banner;
use Image;

class BannersController extends Controller
{
    public function addBanner(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $banner = new Banner;
            $banner->title = $data['title'];
            $banner->link = $data['link'];

            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banner/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->resize(1140, 440)->save($banner_path);

                    // Store image name in products table
                    $banner->image = $filename;
                }
            } else {
                return redirect()->back()->with('flash_message_error', 'Banner Image has not been chosen!');
            }

            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            $banner->status = $status;

            $banner->save();
            return redirect()->back()->with('flash_message_success', 'Banner has been added successfully!');
        }
        return view('admin.banners.add_banner');
    }

    public function viewBanners()
    {
        $banners = Banner::get();
        return view('admin.banners.view_banners')->with(compact('banners'));
    }

    public function editBanner(Request $request, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/banner/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->resize(1140, 440)->save($banner_path);

                    // Get Banner Image Name
                    $bannerImage = $data['current_image'];

                    // Get Banner Image Paths
                    $banner_image_path = 'images/frontend_images/banner/';

                    // Delete Banner Image if not exists in folder
                    if(file_exists($banner_image_path.$bannerImage)){
                        unlink($banner_image_path.$bannerImage);
                    }

                }
            } else {
                $filename = $data['current_image'];
            }

            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            if (empty($data['title'])) {
                $data['title'] = "";
            } 
            if (empty($data['link'])) {
                $data['link'] = "";
            }

            Banner::where('id', $id)->update(['status' => $status, 'title' => $data['title'], 'link' => $data['link'], 'image' => $filename]);
            return redirect()->back()->with('flash_message_success', 'Banner has been updated Successfully!');
        }
        $bannerDetails = Banner::where('id', $id)->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));
    }

    public function deleteBanner($id = null)
    {
        // Get Banner Image Name
        $bannerImage = Banner::where(['id' => $id])->first();

        // Get Banner Image Paths
        $banner_image_path = 'images/frontend_images/banner/';

        // Delete Banner Image if not exists in folder
        if(file_exists($banner_image_path.$bannerImage->image)){
            unlink($banner_image_path.$bannerImage->image);
        }

        Banner::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Banner has been deleted Successfully!');
    }
}
