<?php
// To make this file, run code below:
// sail php artisan make:controller CalenderController
// reference:
// https://www.webslesson.info/2021/03/how-to-implement-fullcalendar-in-laravel-8-using-ajax.html

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Request $request)
    {   
        // calendar.blade.phpを返す
        return view('calendar');
    }
}
