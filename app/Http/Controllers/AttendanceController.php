<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        $getYear = Attendance::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('year', 'asc')->get();
        $years = $getYear->pluck('year');

        $bulan = request()->segment(3);
        $tahun = request()->segment(4);
        $hari = cal_days_in_month(CAL_GREGORIAN,$bulan,$tahun);

        $datamaster = User::all();
        
        $datas = "";
        foreach($datamaster as $master){
            $bulanis1 = "";
            for($i=1;$i<=$hari;$i++){
                $cek1 = Attendance::where('user_id',$master->id)->whereDay('clock_in_time', $i)->whereMonth('clock_in_time', $bulan)->whereYear('clock_in_time', $tahun)->count();
                $current = date("Y-m-d");
                if($cek1 > 0){
                    $dataBulan1 = "<td><i class='fas fa-check-circle text-success'></i></td>";
                }else if($i > date("d") && $bulan >= date("m")){
                    $dataBulan1 = "<td>-</td>";
                }else{
                    $dataBulan1 = "<td><i class='fas fa-times-circle text-danger'></i></td>";
                }
                $bulanis1 = $bulanis1.$dataBulan1;
            }
            $datass = "<tr><th>".$master->name."</th>
                    ".$bulanis1."
                </tr>";
            $datas = $datas.$datass;
        }
        
        $data = [
            'attendances'   => $attendances,
            'years'         => $years,
            'datas'         => $datas
        ];

        return view('admin.attendance.index')->with($data);
    }

    public function filter(Request $request)
    {
        $bulan = $request->f_bulan;
        $tahun = $request->f_tahun;
        $hari = cal_days_in_month(CAL_GREGORIAN,$bulan,$tahun);
        $datamaster = User::all();

        $datas = "";
        foreach($datamaster as $master){
            $bulanis1 = "";
            for($i=1;$i<=$hari;$i++){
                $cek1 = Attendance::where('user_id',$master->id)->whereDay('clock_in_time', $i)->whereMonth('clock_in_time', $bulan)->whereYear('clock_in_time', $tahun)->count();
                if($cek1 > 0){
                    $dataBulan1 = "<td><i class='fas fa-check-circle text-success'></i></td>";
                }else if($i > date("d") && $bulan >= date("m")){
                    $dataBulan1 = "<td>-</td>";
                }else{
                    $dataBulan1 = "<td><i class='fas fa-times-circle text-danger'></i></td>";
                }
                $bulanis1 = $bulanis1.$dataBulan1;
            }
            $datass = "<tr><th>".$master->name."</th>
                    ".$bulanis1."
                </tr>";
            $datas = $datas.$datass;
        }
  
        echo "<table id='empTable' class='table table-bordered table-striped table-hover'>
                <thead class='thead-light'>
                 <tr>
                    <th>Name</th>";
                    for($i=1;$i<=$hari;$i++){
                     echo"
                    <th>".$i."</th>";}echo"
                 </tr>
                 </thead>
                 <tbody>
                    ".$datas."
                </tbody>
              </table>";
    }
}
