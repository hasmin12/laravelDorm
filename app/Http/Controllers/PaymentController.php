<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PaymentsDataTable;
use App\DataTables\UserPaymentsDataTable;
use App\Models\Payment;
use App\Models\User;
use App\Models\Notification;

use App\Helpers\AuthHelper;
use Auth;
class PaymentController extends Controller
{
    //
    public function payments(PaymentsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Payments')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.payments.index', compact('pageTitle','auth_user','assets'));
    }

    public function myPayments()
    {
        $userId = Auth::user()->id;
        $pendingPayments = Payment::where('user_id',$userId)->where('status',"pending")->get();
        // Manually create an instance of the UserPaymentsDataTable with the user ID
        $dataTable = new UserPaymentsDataTable($userId);

        $pageTitle = trans('global-message.list_form_title', ['form' => trans('My Payment')]);
        $assets = ['data-table'];

        // Render the DataTable view
        return $dataTable->render('residents.payment', compact('pageTitle', 'assets','pendingPayments'));
    }

    public function notifyResidents()
    {
        $users = User::where('branch', "Dormitory")->where('status', "active")->where('user_type', "user")->get();

        foreach ($users as $user) {
            $totalAmount = 1000;
            $currentMonth = now()->format('F Y');




            // Check if userProfile exists
            $laptop = $user->userProfile->laptop ?? 0; // Default to 0 if userProfile is null
            $electricfan = $user->userProfile->electricfan ?? 0; // Default to 0 if userProfile is null

            if ($laptop == 1) {
                $totalAmount += 150;
            }

            if ($electricfan == 1) {
                $totalAmount += 150;
            }

            $invoiceNumber = "INV-" . strtoupper($user->id) . "-" . now()->format('Ym'); // e.g., INV-1-202309

            Payment::create([
                'invoice' => $invoiceNumber,
                'user_id' => $user->id,
                'laptop' => $laptop,
                'electricfan' => $electricfan,
                'amount' => $totalAmount,
                'current_month' => $currentMonth,
            ]);

            Notification::create([
                'user_id' => $user->id,
                'title' => "Payment",
                'message' => "You have a pending payment of $totalAmount this $currentMonth.",
                'is_read' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Residents notified successfully!');
    }

    public function updateUserPayment(Request $request)
    {
        $request->validate([
            'payment_id' => 'required',
            'or_number' => 'required|string|max:255',
            'or_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the payment record
        $payment = Payment::findOrFail($request->payment_id);

        // Store the uploaded image
        $imagePath = $request->file('or_image')->store('or_images', 'public');

        // Update the payment record
        $payment->or_number = $request->or_number;
        $payment->or_image = $imagePath;
        $payment->payment_date = now();

        $payment->status = "paid";

        $payment->save();

        return redirect()->back()->with('success', 'Payment details submitted successfully!');
    }

    public function viewpayment($id)
    {
        $payment = Payment::findOrFail($id);
        return view('residents.views.payment',compact('payment'));
    }




}
