<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
// use Mail;

class ContanctController extends Controller
{
    public function index()
    {
        return view('frontsite.Contact-Us');
    }
    public function send_email(Request $request)
    {
        $contact_data = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "subject" => $request->subject,
            "body" => $request->message,
        ];
        // $adminEmail = "support@daralitqangaza.com";

        Mail::send('email_template', $contact_data, function ($message) use ($contact_data) {
            $message->to("dar.etqan.gaza@gmail.com")
                ->from("no_reply@gmail.com", $contact_data["name"])
                ->subject($contact_data["subject"]);
        });
        // Mail::to($adminEmail)->to($contact_data["email"], $contact_data["name"])->subject($contact_data["subject"]);
        // send(new ContactMail($contact_data));
        return redirect()->route('contact-us')->with("massage_send", "you massage has been sent successfully");
    }
    
    public function send_email_api(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|email",
            "phone" => "nullable|string|max:20",
            "subject" => "required|string|max:255",
            "message" => "required|string",
        ]);
    
        // Return validation errors
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 422);
        }
    
        // Prepare email data
        $contact_data = [
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "subject" => $request->subject,
            "body" => $request->message,
        ];
    
        try {
            // Send email
            Mail::send("email_template", $contact_data, function ($message) use ($contact_data) {
                $message->to("dar.etqan.gaza@gmail.com")
                    ->from("no_reply@gmail.com", $contact_data["name"])
                    ->subject($contact_data["subject"]);
            });
    
            // Return success response
            return response()->json(["message" => "Your message has been sent successfully"], 200);
        } catch (\Exception $e) {
            // Log the detailed error for debugging
            \Log::error('Failed to send email: ' . $e->getMessage());
            
            // Return error response if email fails
            return response()->json([
                "error" => "هناك خطأ في البيانات الخاصة في ال api key", 
                "details" => "Failed to send email"
            ], 500);
        }
    }
}
