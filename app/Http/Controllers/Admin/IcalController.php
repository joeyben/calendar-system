<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Room;
use App\Customer;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoomsRequest;
class IcalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = \App\Booking::all();
        $vCalendar = new \Eluceo\iCal\Component\Calendar('www.example.com');

        $booking_arr = [];
        foreach ($bookings as $book){
            $start = new \DateTime($book['time_from']);
            $end = new \DateTime($book['time_to']);
            array_push($booking_arr, array(
                'room_id' => $book->getRoom()[0]->room_number,
                'name' => $book->getRoom()[0]->name,
                'startDate'=> $start,
                'endDate'=> $end,
            ));
        }

        foreach ($booking_arr as $booking){
            $vEvent = new \Eluceo\iCal\Component\Event();
            $vEvent
                ->setDtStart($booking['startDate'])
                ->setDtEnd($booking['endDate'])
                ->setNoTime(true)
                ->setSummary($booking['room_id'])
                ->setDescription($booking['name'])
            ;
            $vEvent->setUseTimezone(true);
            $vCalendar->addComponent($vEvent);

        }

        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');

        echo $vCalendar->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = \App\Booking::findOrFail($id);
        $vCalendar = new \Eluceo\iCal\Component\Calendar('www.example.com');

        $start = new \DateTime($booking['time_from']);
        $end = new \DateTime($booking['time_to']);
        $booking_arr = array(
            'room_id' => $booking->getRoom()[0]->room_number,
            'name' => $booking->getRoom()[0]->name,
            'startDate'=> $start,
            'endDate'=> $end,
        );
        $vEvent = new \Eluceo\iCal\Component\Event();
        $vEvent
            ->setDtStart($booking_arr['startDate'])
            ->setDtEnd($booking_arr['endDate'])
            ->setNoTime(true)
            ->setSummary($booking_arr['room_id'])
            ->setDescription($booking_arr['name'])
        ;
        $vEvent->setUseTimezone(true);
        $vCalendar->addComponent($vEvent);


        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal.ics"');

        echo $vCalendar->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
