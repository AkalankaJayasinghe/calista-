<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function submit(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'newsletter' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Save contact message to database
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'newsletter_subscription' => $request->has('newsletter'),
                'status' => 'pending',
            ]);

            // Send email notification to admin
            $this->sendAdminNotification($contact);

            // Send confirmation email to user
            $this->sendUserConfirmation($contact);

            // Redirect with success message
            return redirect()->route('contact')
                ->with('success', 'Thank you for contacting us! We will get back to you soon.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while sending your message. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Send email notification to admin.
     */
    private function sendAdminNotification($contact)
    {
        try {
            Mail::send('emails.contact-admin', ['contact' => $contact], function ($message) use ($contact) {
                $message->to(env('MAIL_ADMIN_ADDRESS', 'admin@calista.lk'))
                    ->subject('New Contact Form Submission - ' . $contact->subject);
                $message->replyTo($contact->email, $contact->name);
            });
        } catch (\Exception $e) {
            // Log the error but don't fail the request
            \Log::error('Failed to send admin notification email: ' . $e->getMessage());
        }
    }

    /**
     * Send confirmation email to user.
     */
    private function sendUserConfirmation($contact)
    {
        try {
            Mail::send('emails.contact-confirmation', ['contact' => $contact], function ($message) use ($contact) {
                $message->to($contact->email, $contact->name)
                    ->subject('Thank you for contacting Calista');
            });
        } catch (\Exception $e) {
            // Log the error but don't fail the request
            \Log::error('Failed to send user confirmation email: ' . $e->getMessage());
        }
    }
}
