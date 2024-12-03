<?php

namespace App\Http\Controllers;

use App\Models\Idea\standardData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Dashboard extends Controller
{
    public function index()
    {

        $leaderboardNoVAA = DB::table('users')
        ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
        ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
        ->leftjoin('categories', 'categories.id', '=', 'ideas.category_id')
        ->select('users.name', DB::raw('count(ideas.id) as idea_count'))
        ->where('categories.name', 'NoVA-A Elimination')
        ->groupBy('users.name')
        ->orderBy('idea_count', 'DESC')
        ->take(10)
        ->get(); // Ganti dengan logika yang sesuai

        $leaderboardBestpractice = DB::table('users')
        ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
        ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
        ->leftjoin('categories', 'categories.id', '=', 'ideas.category_id')
        ->select('users.name', DB::raw('count(ideas.id) as idea_count'))
        ->where('categories.name', 'Best Practice Implementation')
        ->groupBy('users.name')
        ->orderBy('idea_count', 'DESC')
        ->take(10)
        ->get(); // Ganti dengan logika yang sesuai

        $leaderboardImprovment = DB::table('users')
        ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
        ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
        ->leftjoin('categories', 'categories.id', '=', 'ideas.category_id')
        ->select('users.name', DB::raw('count(ideas.id) as idea_count'))
        ->where('categories.name', 'Improvement Implementation')
        ->groupBy('users.name')
        ->orderBy('idea_count', 'DESC')
        ->take(10)
        ->get(); // Ganti dengan logika yang sesuai

        $leaderboardArtificialIntelegents = DB::table('users')
        ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
        ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
        ->leftjoin('categories', 'categories.id', '=', 'ideas.category_id')
        ->select('users.name', DB::raw('count(ideas.id) as idea_count'))
        ->where('categories.name', 'AI Implementation')
        ->groupBy('users.name')
        ->orderBy('idea_count', 'DESC')
        ->take(10)
        ->get(); // Ganti dengan logika yang sesuai



        $results = DB::table('users')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
            ->select(DB::raw('count(ideas.id) as idea_count'), DB::raw('date(ideas.created_at) as created_date'), 'departments.name as department_name')
            ->groupBy('created_date', 'department_name')
            ->orderBy('created_date', 'ASC')
            ->get();

            $months = DB::table('ideas')
            ->select(DB::raw('DISTINCT MONTH(created_at) as month'))
            ->orderBy('month', 'ASC')
            ->pluck('month');

            $years = DB::table('ideas')
            ->select(DB::raw('DISTINCT YEAR(created_at) as year'))
            ->orderBy('year', 'ASC')
            ->pluck('year');



        $pieChart = DB::table('users')
        ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
        ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
        ->select(DB::raw('count(ideas.id) as idea_count'), 'departments.name as department_name')
        ->groupBy('department_name')
        ->get();

        $barChart = DB::table('users')
        ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
        ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
        ->select(DB::raw('count(ideas.id) as idea_count'), 'departments.name as department_name')
        ->groupBy('department_name')
        ->get();

        // Persiapkan data untuk grafik
        $dates = $results->pluck('created_date');
        $ideaCounts = $results->pluck('idea_count');
        $departmentNames = $results->pluck('department_name');

        // Hitung Target Data
        $standardData = standardData::select('name','value')
        ->get();

        $actualData = DB::table('ideas')
        ->leftJoin('categories', 'categories.id', '=', 'ideas.category_id')
        ->select('categories.name as name',DB::raw('count(ideas.id) as idea_count'))
        ->whereNotNull('name')
        ->groupBy('name',)
        ->get();

        $dataPercentages = [];
        foreach ($standardData as $index => $standard) {
            $actualValue = $actualData[$index]->idea_count;

            // Menghitung persentase
            $percentage = $actualValue != 0 ? ($actualValue / $standard->value) * 100 : 0;

            $dataPercentages[] = [
                'name' => $standard->name,
                'actual' => $actualValue,
                'standard' => $standard->value,
                'percentage' => number_format($percentage, 0),
            ];
        }

        // Hitung Data Effectiveness
        $countUsers = DB::table('departments')
        ->leftJoin('users', 'users.department_id', '=', 'departments.id')
        ->select('departments.name as name', DB::raw('count(users.id) as count_user'))
        ->whereNotNull('departments.name')
        ->groupBy('name')
        ->get();

        $countIdeas = DB::table('ideas')
        ->leftJoin('users', 'users.id', '=', 'ideas.user_id')
        ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
        ->select('departments.name as name', DB::raw('count(ideas.id) as idea_count'))
        ->groupBy('name')
        ->get();


        // dd($countUsers, $countIdeas->firstWhere('name', 'Engineering & Maintainance'));

        $effectiveDatas = [];
        foreach($countUsers as $index => $data){
            // $relatedIdeas = $countIdeas->where('name', $data->name)->first();
            $effectiveDatas[] = [
                'name' => $data->name,
                'users' => $data->count_user,
                'ideas' => $countIdeas->firstWhere('name', $data->name) ? $countIdeas->firstWhere('name', $data->name)->idea_count : 0
            ];
        }

        // dd($countUsers, $countIdeas, $temp);

        // dd($dataPercentages);

        return view('dashboard', compact('results', 'dates', 'ideaCounts', 'departmentNames', 'pieChart', 'barChart', 'leaderboardNoVAA', 'leaderboardBestpractice',
        'leaderboardImprovment', 'leaderboardArtificialIntelegents', 'months', 'years', 'dataPercentages', 'effectiveDatas'));
    }

        public function getleaderboardImprovment(Request $request)
    {
        $month = $request->input('month_leaderboard');
        $year = $request->input('year_leaderboard');


        $leaderboardImprovment = DB::table('users')
            ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
            ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
            ->select('users.name', DB::raw('count(ideas.id) as idea_count'))
            ->whereBetween('ideas.created_at', [$month, $year]) // Filter berdasarkan tanggal
            ->groupBy('users.name')
            ->orderBy('idea_count', 'DESC')
            ->get();



        return response()->json($leaderboardImprovment);
    }

    public function getleaderboardNoVAA(Request $request)
    {
        $month = $request->input('month_leaderboard');
        $year = $request->input('year_leaderboard');

        $leaderboardNoVAA = DB::table('users')
            ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
            ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
            ->select('users.name', DB::raw('count(ideas.id) as idea_count'))
            ->whereBetween('ideas.created_at', [$month, $year]) // Filter berdasarkan tanggal
            ->groupBy('users.name')
            ->orderBy('idea_count', 'DESC')
            ->get();

        return response()->json($leaderboardNoVAA);
    }

    public function getleaderboardBestpractice(Request $request)
    {
        $month = $request->input('month_leaderboard');
        $year = $request->input('year_leaderboard');

        $leaderboardBestpractice = DB::table('users')
            ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
            ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
            ->select('users.name', DB::raw('count(ideas.id) as idea_count'))
            ->whereBetween('ideas.created_at', [$month, $year]) // Filter berdasarkan tanggal
            ->groupBy('users.name')
            ->orderBy('idea_count', 'DESC')
            ->get();

        return response()->json($leaderboardBestpractice);
    }

    public function getleaderboardArtificialIntelegents(Request $request)
    {
        $month = $request->input('month_leaderboard');
        $year = $request->input('year_leaderboard');

        $leaderboardArtificialIntelegents = DB::table('users')
            ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
            ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
            ->select('users.name', DB::raw('count(ideas.id) as idea_count'))
            ->whereBetween('ideas.created_at', [$month, $year]) // Filter berdasarkan tanggal
            ->groupBy('users.name')
            ->orderBy('idea_count', 'DESC')
            ->get();


        return response()->json($leaderboardArtificialIntelegents);
    }

    public function getLeaderboardData(Request $request)
    {
        $year =$request->query('year');
        $month =$request->query('month');
        $leaderboardName =$request->query('name');

        $query =  DB::table('users')
        ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
        ->leftJoin('idea_approvals', 'ideas.id', '=', 'idea_approvals.idea_id')
        ->leftjoin('categories', 'categories.id', '=', 'ideas.category_id')
        ->where('categories.name', $leaderboardName);

        if($month){
            $query->whereMonth('ideas.created_at', $month);
        }

        if($year){
            $query->whereYear('ideas.created_at', $year);
        }

        $query->select('users.name', DB::raw('count(ideas.id) as idea_count'), 'ideas.created_at')
        ->groupBy('users.name', 'ideas.created_at')
        ->orderBy('idea_count', 'DESC')
        ->take(10);



        $leaderboardData = $query->get();

        return response()->json($leaderboardData);
    }

    public function getBarChart(Request $request)
    {
        $year = $request->query('year');
        $category = $request->query('name');

        $query = DB::table('users')
        ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
        ->leftJoin('ideas', 'users.id', '=', 'ideas.user_id')
        ->leftJoin('categories', 'categories.id', '=', 'ideas.category_id')
        ->select(DB::raw('count(ideas.id) as idea_count'), 'departments.name as department_name', DB::raw('month(ideas.created_at) as created_at'), DB::raw('MONTHNAME(ideas.created_at) as month_name'))
        ->where('categories.name', $category)
        ->groupBy('department_name', 'ideas.created_at')
        ->orderBy('created_at', 'asc');

        if($year){
            $query->whereYear('ideas.created_at', $year);
        }
        $BarChartData = $query->get();

        //Test

        // Data bulan
        $barNames = array_unique($query->pluck('department_name')->toArray());


        // Menyiapkan data untuk ECharts
        $data = [];

        // Membuat array sesuai jumlah bulan dalam satu tahun
        foreach($barNames as $name){
            $data[$name]= array_fill(0, 12, 0);
        }
        foreach($BarChartData as $chartData){
            $data[$chartData->department_name][$chartData->created_at-1] = $chartData->idea_count;
        }


        return response()->json($data);
    }

    public function getTargetData(Request $request){

        $year = $request->query('year');

        $standardData = standardData::select('name','value');
        if($year){
            $standardData->where('year', $year);
        }
        $standardData = $standardData->get();

        $actualData = DB::table('ideas')
        ->leftJoin('categories', 'categories.id', '=', 'ideas.category_id')
        ->select('categories.name as name',DB::raw('count(ideas.id) as idea_count'), 'ideas.created_at as created_at')
        ->whereNotNull('name');
        if($year){
            $actualData->whereYear('ideas.created_at', $year)->groupBy('name', 'created_at');
        }else{
            $actualData->groupBy('name');
        }
        $actualData = $actualData->get();

        $dataPercentages = [];
        foreach ($standardData as $index => $standard) {
            $actualValue = $actualData[$index]->idea_count;

            // Menghitung persentase
            $percentage = number_format($actualValue != 0 ? ($actualValue / $standard->value) * 100 : 0, 0);

            $dataPercentages[] = [
                'name' => $standard->name,
                'actual' => $actualValue,
                'standard' => $standard->value,
                'percentage' => number_format($percentage, 0),
            ];
        }


        return response()->json($dataPercentages);
    }

    public function targetIndex(){
        $standardData = standardData::get();

         // Dialog Sweet Alert
         $title = 'Delete User!';
         $text = "Are you sure you want to delete?";

         confirmDelete($title, $text);

        return view('page.master.Target.index', ['standardData' => $standardData]);
    }

    public function targetDestroy($id){
        $user = standardData::findOrFail($id);
        $user->delete();

        return redirect('/targets')->with('status','Target Delete Successfully');
    }

    public function targetUpdate(Request $request, $targetId){

        $standardData = standardData::find($targetId);
        $standardData->name = $request->input('name');
        $standardData->value = $request->input('value');
        $standardData->year = $request->input('year');
        $standardData->save();

        return redirect('/targets')->with('status','Target Update Successfully');
    }

    public function targetStore(Request $request){

        $standardData = standardData::Create([
            'name' => $request->input('name'),
            'value' => $request->input('value'),
            'year' => $request->input('year')
        ]);

        return redirect('/targets')->with('status','Target Created Successfully');
    }
}
