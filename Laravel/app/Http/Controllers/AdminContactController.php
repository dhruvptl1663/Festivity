<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }
}
