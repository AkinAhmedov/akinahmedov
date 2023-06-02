<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $settings = app(MainController::class)->helper('settings');
        return view('contact', compact('settings'));
    }

    public function contact(Request $request)
    {
        try {

            $contact = ContactModel::create(['name' => $request->name, 'email' => $request->email, 'message' => $request->message]);
            $contact->save();

            if ($contact)
                return redirect('/')->with('Title', 'Başarılı!')->with('Message', 'Mesajınız başarıyla iletilmiştir.')->with('Status', 'success');

            return redirect()->back()->with('Title', 'Hata!')->with('Message', 'Abone işlemi başarısız')->with('Status', 'error');

        } catch (\Throwable $th) {
            return redirect()->back()->with('Title', $th->getCode())->with('Message', $th->getMessage())->with('Status', 'error');
        }
    }
}
