<?php

namespace App\Http\Controllers;

use App\Models\Shedule;
use PDF;
use DB;
use App\Models\Group;
use App\Models\Teacher;
use App\Models\Items;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ScheduleExport;

class ScheduleController extends Controller
{
    public function index()
    {
        $shedules = Shedule::orderBy('couple_number','asc')->get();
        $teachers = Teacher::pluck('surname','id')->all();
        $groups = Group::pluck('name_group','id')->all();

        return View('schedule/index',['shedules' => $shedules,'groups' => $groups,'teachers'=>$teachers]);
    }
    public function teacher()
    {
        $shedules = Shedule::orderBy('couple_number','asc')->get();
        $teachers = Teacher::pluck('surname','id')->all();
        return View('schedule/teacher',['shedules' => $shedules,'teachers'=>$teachers]);
    }

    public function lecture()
    {
        $shedules = Shedule::orderBy('couple_number','asc')->get();
        $lectures =Shedule::pluck('lecture_hall','id')->all();
        return View('schedule/lecture',['shedules' => $shedules,'lectures'=>$lectures]);
    }

    public function item()
    {
        $shedules = Shedule::orderBy('couple_number','asc')->get();
        $items =Items::pluck('name','id')->all();
        $groups = Group::pluck('name_group','id')->all();
        return View('schedule/item',['shedules' => $shedules,'items'=>$items,'groups' => $groups]);
    }
}
