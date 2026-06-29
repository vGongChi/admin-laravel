<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index(Request $request)
    {
        $language = $request->get('language', 'zh');
        $contacts = ContactInfo::where('language', $language)->get();

        foreach ($contacts as $contact) {
            $contact->qr_code = $contact->qr_code ? url($contact->qr_code) : null;
        }
        return response()->json([
            'success' => true,
            'data' => $contacts
        ]);
    }
}