<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contact;
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
    public function index()
    {
        $contacts = $this->contact->all();
        return view('admin.contact.index', compact('contacts'));
    }
}
