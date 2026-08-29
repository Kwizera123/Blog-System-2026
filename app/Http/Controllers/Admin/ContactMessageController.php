<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        return view('admin.contact-messages.index', compact('messages'));
    }
    //End Method

    public function show(ContactMessage $contactMessage)
    {
        if (!$contactMessage->is_read) {

            $contactMessage->update([
                'is_read' => true,
            ]);
        }
        return view('admin.contact-messages.show', compact('contactMessage'));
    }
    //End Method

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Contact message deleted successfully.');
    }
}
