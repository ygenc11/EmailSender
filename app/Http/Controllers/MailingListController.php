<?php

namespace App\Http\Controllers;

use App\Models\MailingList;
use Illuminate\Http\Request;

class MailingListController extends Controller
{
    public function index()
    {
        $mailLists = MailingList::all();
        return view('maileclipse::mailing-list.index', compact('mailLists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'emails' => 'required|string',
        ]);

        // E-posta adreslerini virgül veya alt satır ile ayır
        $emails = preg_split("/[\r\n,]+/", $request->emails);
        $emails = array_map('trim', $emails); // Fazla boşlukları temizle

        // Geçersiz e-posta adreslerini kontrol et
        $invalidEmails = [];
        foreach ($emails as $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $invalidEmails[] = $email;
            }
        }

        // Geçersiz e-posta adresi varsa hata döndür
        if (!empty($invalidEmails)) {
            return redirect()->back()->withErrors(['emails' => 'Invalid email(s): ' . implode(', ', $invalidEmails)]);
        }

        // E-postaları JSON olarak sakla
        MailingList::create([
            'name' => $request->name,
            'emails' => json_encode($emails),
        ]);

        return redirect()->back()->with('success', 'Mail List Created Successfully!');
    }

    public function destroy(Request $request)
    {
        $mailingList = MailingList::findOrFail($request->id);
        $mailingList->delete();

        return response()->json(['status' => 'ok']);
    }
}
