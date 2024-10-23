<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use Mews\Purifier\Facades\Purifier;

class PolicyController extends Controller
{
    public function index()
    {
        $privacy = Pages::where('page', 'privacy_policy')->where('section', 'privacy_policy')->first();
        $refund = Pages::where('page', 'refund_policy')->where('section', 'refund_policy')->first();

        // dd($privacy);

        return view('panel.pages.policy', [
            'privacy' => $privacy ? $privacy->data : null,
            'refund' => $refund ? $refund->data : null
        ]);
    }

    public function tos()
    {
        $tos = Pages::where('page', 'tos')->where('section', 'tos')->first();

        // dd($privacy);

        return view('panel.pages.tos', [
            'tos' => $tos ? $tos->data : null
        ]);
    }

    public function privacy(Request $request)
    {
        try {

            $request->validate([
                'privacy_policy' => 'string|required'
            ]);


            if (!Pages::where('page', 'privacy_policy')->where('section', 'privacy_policy')->exists()) {

                Pages::create([
                    'page' => 'privacy_policy',
                    'section' => 'privacy_policy',
                    'data' => Purifier::clean($request->privacy_policy),
                    'updated_by' => auth()->user()->id,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
            } else {
                Pages::where('page', 'privacy_policy')->where('section', 'privacy_policy')->update([
                    'data' => Purifier::clean($request->privacy_policy),
                    'updated_by' => auth()->user()->id,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
            }


            return back()->with('success', 'Privacy policy updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function refund(Request $request)
    {
        try {

            $request->validate([
                'refund_policy' => 'string|required'
            ]);


            if (!Pages::where('page', 'refund_policy')->where('section', 'refund_policy')->exists()) {

                Pages::create([
                    'page' => 'refund_policy',
                    'section' => 'refund_policy',
                    'data' => Purifier::clean($request->refund_policy),
                    'updated_by' => auth()->user()->id,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
            } else {
                Pages::where('page', 'refund_policy')->where('section', 'refund_policy')->update([
                    'dada' => Purifier::clean($request->refund_policy),
                    'updated_by' => auth()->user()->id,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
            }


            return back()->with('success', 'Refund & Return policy updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function tosUpdate(Request $request)
    {
        try {

            $request->validate([
                'tos' => 'string|required'
            ]);


            if (!Pages::where('page', 'tos')->where('section', 'tos')->exists()) {

                Pages::create([
                    'page' => 'tos',
                    'section' => 'tos',
                    'data' => Purifier::clean($request->tos),
                    'updated_by' => auth()->user()->id,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
            } else {
                Pages::where('page', 'getTos')->where('section', 'getTos')->update([
                    'dada' => Purifier::clean($request->tos),
                    'updated_by' => auth()->user()->id,
                    'updated_at' => now(),
                    'created_at' => now()
                ]);
            }


            return back()->with('success', 'Terms of service updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
