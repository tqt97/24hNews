<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('web.contact');
    }
    public function store(ContactStoreRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->back()->with([
            'alert-type' => 'success',
            'message' => 'Cảm ơn bạn đã gửi liện hệ cho chúng tôi. Chúng tôi sẽ phản hối sớm nhất có thể.',
        ]);
    }
}
