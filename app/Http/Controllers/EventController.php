<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Events;
use DateTime;
use DatePeriod;
use DateInterval;

class EventController extends Controller
{
    //

    public function index() {
      
        $event_data = Events::all()->toArray();
        $object = json_encode($event_data);
        $allEvents = json_decode($object);
        // dd($allEvents);
        return view('main', compact('allEvents'));

    }

    public function store(Request $request)
    {
        //Validation
        $this->validate($request, [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        
        //get the 'name' from html and assign to a variable
        $monday = $request->get('Monday');
        $tuesday = $request->get('Tuesday');
        $wednesday = $request->get('Wednesday');
        $thursday = $request->get('Thursday');
        $friday = $request->get('Friday');
        $saturday = $request->get('Saturday');
        $sunday = $request->get('Sunday');
        
        //to get date range from 2 dates
        $dateArray = $this->getDatesFromRange($request->get('start_date'), $request->get('end_date'));
        
        //declare empty array, all selected dates will be pushed to this array
        $selectedDates = array();
        
        //loop through $dataArray to get the equivalent days of the daterange
        foreach($dateArray as $key => $value) {
            $date = strtotime($value);
            $day = date('l', $date);

            //SWITCH --- to compare the days(of selected date range) to the ticked days in html
            //whichever matched will be saved to the database
            switch ($day) {
                case "Monday":{
                    if($monday != null) {
                        array_push($selectedDates, $value);    
                    }
                    break;
                }

                case "Tuesday":{
                    if($tuesday != null) {
                        array_push($selectedDates, $value);    
                    }
                    break;
                }

                case "Wednesday":{
                    if($wednesday != null) {
                        array_push($selectedDates, $value);    
                    }
                    break;
                }

                case "Thursday":{
                    if($thursday != null) {
                        array_push($selectedDates, $value);    
                    }
                    break;
                }

                case "Friday":{
                    if($friday != null) {
                        array_push($selectedDates, $value);    
                    }
                    break;
                }

                case "Saturday":{
                    if($saturday != null) {
                        array_push($selectedDates, $value);    
                    }
                    break;
                }

                case "Sunday":{
                    if($sunday != null) {
                        array_push($selectedDates, $value);    
                    }
                    break;
                }
                    
            }
        }

        // dd($selectedDates);
        
        //since $selectedDates array are now filled 
        foreach($selectedDates as $key => $value) {
            $events = new Events([
                'title' => $request->get('title'),
                'start' => $value,
                'end' => $value
            ]);
        
             ///save data to mysql table
             $events->save();
        }
       
    
        return redirect('/')->with('success', 'Event Added');       
    }
    
        // Function to get all the dates in given range 
       
        public function getDatesFromRange($start, $end) { 
            $format = 'Y-m-d';

            // Declare an empty array 
            $array = array(); 
            
            // Variable that store the date interval of period 1 day 
            $interval = new DateInterval('P1D'); 
        
            $realEnd = new DateTime($end); 
            $realEnd->add($interval); 
        
            $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
        
            // Use loop to store date into array 
            foreach($period as $date) {                  
                $array[] = $date->format($format);  
            } 
        
            // Return the array elements 
            return $array; 
        } 
}
       

