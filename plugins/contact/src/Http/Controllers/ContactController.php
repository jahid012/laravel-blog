<?php

namespace Plugins\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Plugins\Contact\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Plugins\Contact\Mail\ReplayContactMessage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('contacts.viewAny');

        $contacts = Contact::whereNull('parent_id')->paginate(30);
        return view('contact::admin.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('contacts.create');

        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'nullable|max:255',
            'subject' => 'required|max:255',
            'address' => 'nullable|max:255',
            'message' => 'required|max:500',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'address' => $request->address,
            'message' => $request->message,
        ]);

        if($request->ajax()){
            return response()->json([
                'message' => 'Message sent successfully.'
            ],201);
        }

        alert()->success("Message sent successfully.");

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $this->authorize('contacts.show');

        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $this->authorize('contacts.update');

        $children = Contact::where('parent_id', $contact->id)->get();
        return view('contact::admin.edit', compact('contact', 'children'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->authorize('contacts.update');

        $request->validate([
            'is_read' => 'boolean'
        ]);

        $contact->update([
            'is_read' => $request->is_read,
        ]);

        $status = $request->is_read==1?'Read.': 'Unread.';
        toastr()->primary("Contact message mark as ".$status );
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('contacts.delete');

        if($contact != null){
            $contact->delete();
        }
        toastr()->primary("Contact message delete successfully.");
        return back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function replay(Request $request, Contact $contact)
    {
        $this->authorize('contacts.update');

        $request->validate([
            'message' => 'required|max:500',
        ]);

        Mail::to($contact->email)->send(new ReplayContactMessage($contact, $request->message));

        Contact::create([
            'parent_id' => $contact->id,
            'email' => $contact->email,
            'message' => $request->message,
        ]);

        toastr()->primary("Message Send.");
        return back();
    }

}
