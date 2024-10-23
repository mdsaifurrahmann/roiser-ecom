<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\websiteInformation as WebsiteInformationModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use App\Services\Permission;

class WebsiteInformationController extends Controller
{

    public $decodeBasicInfo, $decodeSeo, $decodeSocialMedia, $decodeInject;

    public function __construct()
    {
        //retrieve
        $basicInfo = WebsiteInformationModel::where('target', 'basicInfo')->select('data')->first();
        $socialMedia = WebsiteInformationModel::where('target', 'socialMedia')->select('data')->first();
        $seo = WebsiteInformationModel::where('target', 'seo')->select('data')->first();
        $inject = WebsiteInformationModel::where('target', 'inject')->select('data')->first();

        //decode
        $this->decodeBasicInfo = $basicInfo ? json_decode($basicInfo->data, true) : null;
        $this->decodeSocialMedia = $socialMedia ? json_decode($socialMedia->data, true) : null;
        $this->decodeSeo = $seo ? json_decode($seo->data, true) : null;
        $this->decodeInject = $inject ? json_decode($inject->data, true) : null;
    }

    public function index()
    {

        // check permission
        if ($response = Permission::check('view_website_information')) {
            return $response;
        }

        return view('panel.information', [
            'basicInfo' => $this->decodeBasicInfo,
            'socialMedia' => $this->decodeSocialMedia,
            'seo' => $this->decodeSeo,
            'inject' => $this->decodeInject,
        ]);
    }


    public function basicInfo(Request $request)
    {

        if ($response = Permission::check('update_website_information')) {
            return $response;
        }

        $request->validate([
            'website_name' => 'string|nullable',
            'website_slug' => 'string|nullable',
            'logo' => 'image|mimes:jpeg,png,jpg,svg|max:1024|nullable',
            'favicon' => 'image|mimes:jpeg,png,jpg|max:1024|nullable',
            'url' => 'string|nullable',
            'contact_mobile' => 'string|nullable',
            'contact_email' => 'email|nullable',
            'contact_address' => 'string|nullable',
        ]);


        $retrieve = WebsiteInformationModel::where('target', 'basicInfo')->select('data')->first();

        $decodeRetrieve = $retrieve ? json_decode($retrieve->data, true) : null;

        $data = [
            'website_name' => Purifier::clean($request->website_name),
            'website_slug' => Purifier::clean($request->website_slug),
            'url' => Purifier::clean($request->url),
            'contact_mobile' => Purifier::clean($request->contact_mobile),
            'contact_email' => Purifier::clean($request->contact_email),
            'contact_address' => Purifier::clean($request->contact_address)
        ];

        try {
            if ($request->hasFile('logo')) {

                if (Storage::disk('public')->exists('site__info/' . $decodeRetrieve['logo'])) {
                    Storage::disk('public')->delete('site__info/' . $decodeRetrieve['logo']);
                }

                $file = $request->file('logo');
                $fileName = time() . Str::random('16') . '.' . Str::replace(' ', '-', $file->getClientOriginalExtension());

                $data['logo'] = $fileName;

                Storage::disk('public')->putFileAs('site__info', $file, $fileName);
            } else {
                $data['logo'] = $decodeRetrieve['logo'] ?? null;
            }

            if ($request->hasFile('favicon')) {

                if (Storage::disk('public')->exists('site__info/' . $decodeRetrieve['favicon'])) {
                    Storage::disk('public')->delete('site__info/' . $decodeRetrieve['favicon']);
                }

                $fav = $request->file('favicon');
                $fav_name = time() . Str::random('16') . '.' . Str::replace(' ', '-', $fav->getClientOriginalExtension());

                $data['favicon'] = $fav_name;

                Storage::disk('public')->putFileAs('site__info', $fav, $fav_name);
            } else {
                $data['favicon'] = $decodeRetrieve['favicon'] ?? null;
            }


            if (WebsiteInformationModel::where('target', 'basicInfo')->first()) {
                WebsiteInformationModel::where('target', 'basicInfo')
                    ->update([
                        'data' => json_encode($data),
                        'updated_at' => now(),
                    ]);
            } else {
                WebsiteInformationModel::create([
                    'target' => 'basicInfo',
                    'data' => json_encode($data),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Website Information has been updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something disaster like things going on! Here is the trace ' . $e->getMessage());
        }
    }

    public function socialMedia(Request $request)
    {

        if ($response = Permission::check('update_website_information')) {
            return $response;
        }


        $request->validate([
            'social_x' => 'string|nullable',
            'social_fb' => 'string|nullable',
            'social_yt' => 'string|nullable',
            'social_linkedin' => 'string|nullable',
            'social_insta' => 'string|nullable',
            'social_quora' => 'string|nullable'
        ]);

        $data = [
            'social_x' => Purifier::clean($request->social_x),
            'social_fb' => Purifier::clean($request->social_fb),
            'social_yt' => Purifier::clean($request->social_yt),
            'social_linkedin' => Purifier::clean($request->social_linkedin),
            'social_insta' => Purifier::clean($request->social_insta),
            'social_quora' => Purifier::clean($request->social_quora)
        ];

        try {
            if (WebsiteInformationModel::where('target', 'socialMedia')->first()) {
                WebsiteInformationModel::where('target', 'socialMedia')->update([
                    'data' => json_encode($data),
                    'updated_at' => now(),
                ]);
            } else {
                WebsiteInformationModel::create([
                    'target' => 'socialMedia',
                    'data' => json_encode($data),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Social Media has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something disaster like things going on! Here is the trace ' . $e->getMessage());
        }
    }

    public function seo(Request $request)
    {

        if ($response = Permission::check('update_website_information')) {
            return $response;
        }

        $request->validate([
            'og__desc' => 'string|nullable',
            'og__type' => 'string|nullable',
            'og__image' => 'image|mimes:jpeg,png,jpg|max:1024|nullable',
            // 'keywords' => 'array'
        ]);

        $retrieve = WebsiteInformationModel::where('target', 'seo')->select('data')->first();

        $decodeRetrieve = $retrieve ? json_decode($retrieve->data, true) : null;

        $data = [
            'og__desc' => Purifier::clean($request->og__desc),
            'og__type' => Purifier::clean($request->og__type),
            'keywords' => Purifier::clean($request->keywords)
        ];


        try {
            if ($request->hasFile('og__image')) {

                if (Storage::disk('public')->exists('site__info/' . $decodeRetrieve['og__image'])) {
                    Storage::disk('public')->delete('site__info/' . $decodeRetrieve['og__image']);
                }

                $file = $request->file('og__image');
                $fileName = time() . Str::random('16') . '.' . Str::replace(' ', '-', $file->getClientOriginalExtension());

                $data['og__image'] = $fileName;

                Storage::disk('public')->putFileAs('site__info', $file, $fileName);
            } else {
                $data['og__image'] = $decodeRetrieve['og__image'] ?? null;
            }

            if (WebsiteInformationModel::where('target', 'seo')->first()) {
                WebsiteInformationModel::where('target', 'seo')
                    ->update([
                        'data' => json_encode($data),
                        'updated_at' => now(),
                    ]);
            } else {
                WebsiteInformationModel::create([
                    'target' => 'seo',
                    'data' => json_encode($data),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'SEO data has been updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something disaster like things going on! Here is the trace ' . $e->getMessage());
        }
    }

    public function injector(Request $request)
    {

        if ($response = Permission::check('update_website_information')) {
            return $response;
        }

        $request->validate([
            'inject_head' => 'nullable',
            'inject_bottom' => 'nullable',
        ]);

        $data = [
            'inject_head' => $request->inject_head,
            'inject_bottom' => $request->inject_bottom
        ];

        try {
            if (WebsiteInformationModel::where('target', 'inject')->first()) {
                WebsiteInformationModel::where('target', 'inject')
                    ->update([
                        'data' => json_encode($data),
                        'updated_by' => Auth::user()->name,
                        'updated_at' => now(),
                    ]);
            } else {
                WebsiteInformationModel::create([
                    'target' => 'inject',
                    'data' => json_encode($data),
                    'updated_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'SEO data has been updated!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something disaster like things going on! Here is the trace ' . $e->getMessage());
        }
    }
}
