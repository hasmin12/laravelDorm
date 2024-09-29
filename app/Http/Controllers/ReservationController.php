<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ReservationsDataTable;
use App\Helpers\AuthHelper;
use App\Models\Reservation;

class ReservationController extends Controller
{
    //
    public function reservations(ReservationsDataTable $dataTable)
    {
        $pageTitle = trans('global-message.list_form_title',['form' => trans('Reservations')] );
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add User</a>';
        return $dataTable->render('admin.reservations.index', compact('pageTitle','auth_user','assets'));
    }

    public function updateReservation(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update($request->all());
        return redirect()->back()->with('success', 'Reservation updated successfully!');

    }
}
