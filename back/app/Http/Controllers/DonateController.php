<?php

namespace App\Http\Controllers;

use App\Models\Donate;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;
use Illuminate\Support\Facades\Cache;

class DonateController extends Controller
{

    public function index()
    {
        $donate = Donate::all();
    }
    
    public function api_index()
    {
        $donates = Donate::all();
        $donates->each(function ($item) {
            if ($item->image) {
                $item->image = url('storage/' . str_replace('\\', '/', $item->image));
            }
        });
        return response()->json($donates);
    }
    
     public function api_index_active()
    {
        return response()->json(Donate::where('status', 'active')->get());
    }

    public function create()
    {
        $donate = Donate::all();
        return view('backsite.create_donate', compact('donate'));
    }
    
    public function api_store(Request $request)
    {
        $data = $request->all();
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            $filename = date("Y-m-d_H-i") . " - " . rand(1000, 9999) . " - " . $image->getClientOriginalName();
            $path = 'donate/' . $filename;
    
            $image->move(public_path('storage/donate'), $filename);
    
            $data['image'] = $path;
        }
    
        $donate = Donate::create($data);
    
        Cache::forget('home_api_data');

        if ($donate->image) {
            $donate->image = url('storage/' . str_replace('\\', '/', $donate->image));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Donation record created successfully',
            'data' => $donate
        ], 201);
    }

    
    public function store(Request $request)
    {
        $image = $request->file('image');
        $data = $request->all();
        if ($request->hasFile('image')) {
            $url = 'donate\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $request->image->move(public_path('storage/donate'), $url);

            $data['image'] = $url;
        }
        Donate::create($data);
        return redirect()->route('donate-show');
    }

     public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:active,inactive',
        ]);
    
        $donate = Donate::findOrFail($id);
    
        $donate->status = $data['status'];
        $donate->save();
    
        return response()->json([
            'message' => 'Status updated successfully.',
            'donate' => $donate,
        ]);
    }

    public function show(Donate $donate)
    {
        $donate = Donate::orderBy('created_at','desc')->paginate();
        return view('backsite.donate_table', compact('donate'));
    }


    public function edit(Request $request, Donate $donate, $id)
    {
        $donate = Donate::find($id);
        return view('backsite.update_donate', compact('donate'));
    }


    public function update(Request $request, Donate $donate)
    {
        $data = $request->validate([
            'title' => 'required',
            'details' => 'required',
            'date' => 'required'
        ]);
        $donate = Donate::find($request->hidden_id);
        $donate->title = $data['title'];
        $donate->details = $data['details'];
        $donate->date = $data['date'];
        $image = $request->file('image');
        $mainImage = $donate->image;
        $mainPath = public_path('storage/' . $mainImage);

        if ($request->hasFile('image')) {
            $url = 'donate\\' . date("Y-M-d H:i", time()) . " - " . rand(00000, 9999) . " - " . $image->getClientOriginalName();
            $request->image->move(public_path('storage/donate'), $url);
            $data['image'] = $url;
            $donate->image = $data['image'];
            
            if ($mainImage != null) {
            unlink(str_replace('\\', '/', $mainPath));
            }
        }

        $donate->save();
        return redirect()->route('donate-show');
    }

   public function api_update(Request $request, $id)
    {
        $donate = Donate::findOrFail($id);
    
        $donate->title = $request->input('title', $donate->title);
        $donate->details = $request->input('details', $donate->details);
        $donate->date = $request->input('date', $donate->date);
        $donate->status = $request->input('status', $donate->status);
    
        if ($request->hasFile('image')) {
            if ($donate->image) {
                $oldPath = public_path('storage/' . str_replace('\\', '/', $donate->image));
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
    
            $image = $request->file('image');
            $filename = date("Y-m-d_H-i") . " - " . rand(1000, 9999) . " - " . $image->getClientOriginalName();
            $path = 'donate/' . $filename;
            $image->move(public_path('storage/donate'), $filename);
            $donate->image = $path;
        }
    
        $donate->save();
    
        Cache::forget('home_api_data');

        if ($donate->image) {
            $donate->image = url('storage/' . str_replace('\\', '/', $donate->image));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Donation record updated successfully',
            'data' => $donate
        ]);
    }


    public function destroy(Donate $donate, $id)
    {
        $file = Donate::find($id);
        $mainImage = $file->image;
        $mainPath = public_path('storage/' . $mainImage);
        
          if ($mainImage != null) {
            unlink(str_replace('\\', '/', $mainPath));
            Donate::destroy($id);
            }
            else{
            Donate::destroy($id);
            }
        return redirect()->route('donate-show');
    }

    public function api_destroy($id)
    {
        $donate = Donate::findOrFail($id);
    
        if ($donate->image) {
            $path = public_path('storage/' . str_replace('\\', '/', $donate->image));
            if (file_exists($path)) {
                unlink($path);
            }
        }
    
        $donate->delete();
    
        Cache::forget('home_api_data');

        return response()->json([
            'status' => 'success',
            'message' => 'Donation record deleted successfully'
        ]);
    }

    // ─── Stripe Checkout ────────────────────────────────────────────────
    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donor_name'  => 'required|string|max:255',
            'donor_email' => 'required|email|max:255',
            'donor_phone' => 'nullable|string|max:20',
            'amount'      => 'required|numeric|min:1|max:999999',
            'plan'        => 'required|string|in:one-time,monthly,yearly',
            'project_id'  => 'required|exists:donates,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data    = $validator->validated();
        $project = Donate::findOrFail($data['project_id']);

        // Save donation record as pending
        $donation = Donation::create([
            'donate_id'    => $project->id,
            'donor_name'   => $data['donor_name'],
            'donor_email'  => $data['donor_email'],
            'donor_phone'  => $data['donor_phone'] ?? null,
            'amount'       => $data['amount'],
            'plan'         => $data['plan'],
            'donated_at'   => now()->toDateString(),
            'status'       => 'pending',
        ]);

        // Configure Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amountCents = (int) round($data['amount'] * 100);
        $currency    = 'usd';

        $frontendUrl = env('FRONTEND_URL', 'http://localhost:5173');

        // Build line item
        $priceData = [
            'currency'     => $currency,
            'product_data' => [
                'name'        => $project->title,
                'description' => mb_substr($project->details, 0, 200),
            ],
            'unit_amount'  => $amountCents,
        ];

        $sessionParams = [
            'customer_email' => $data['donor_email'],
            'line_items'     => [[
                'price_data' => $priceData,
                'quantity'   => 1,
            ]],
            'metadata' => [
                'donation_id' => $donation->id,
                'project_id'  => $project->id,
            ],
            'success_url' => $frontendUrl . '?donation=success&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => $frontendUrl . '?donation=cancelled',
        ];

        // One-time vs subscription
        if ($data['plan'] === 'one-time') {
            $sessionParams['mode'] = 'payment';
        } else {
            $interval = $data['plan'] === 'monthly' ? 'month' : 'year';
            $sessionParams['mode'] = 'subscription';
            $sessionParams['line_items'][0]['price_data']['recurring'] = [
                'interval' => $interval,
            ];
        }

        try {
            $session = StripeSession::create($sessionParams);

            $donation->update(['stripe_session_id' => $session->id]);

            return response()->json([
                'status'       => 'success',
                'checkout_url' => $session->url,
                'donation_id'  => $donation->id,
            ]);
        } catch (\Exception $e) {
            $donation->update(['status' => 'failed']);

            // Log the detailed error for debugging
            \Log::error('Stripe checkout session creation failed: ' . $e->getMessage());
            
            // Return sanitized error message to prevent API key exposure
            return response()->json([
                'status'  => 'error',
                'message' => 'هناك خطأ في البيانات الخاصة في ال api key',
            ], 500);
        }
    }

    // ─── Stripe Webhook ─────────────────────────────────────────────────
    public function stripeWebhook(Request $request)
    {
        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret    = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            // Log the detailed error for debugging
            \Log::error('Stripe webhook signature verification failed: ' . $e->getMessage());
            
            // Return sanitized error message to prevent API key exposure
            return response()->json([
                'error' => 'هناك خطأ في البيانات الخاصة في ال api key'
            ], 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session    = $event->data->object;
                $donationId = $session->metadata->donation_id ?? null;

                if ($donationId) {
                    Donation::where('id', $donationId)->update([
                        'status'            => 'completed',
                        'stripe_session_id' => $session->id,
                    ]);
                }
                break;

            case 'checkout.session.expired':
            case 'checkout.session.async_payment_failed':
                $session    = $event->data->object;
                $donationId = $session->metadata->donation_id ?? null;

                if ($donationId) {
                    Donation::where('id', $donationId)->update(['status' => 'failed']);
                }
                break;
        }

        return response()->json(['status' => 'ok']);
    }
}
