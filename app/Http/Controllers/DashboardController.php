<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use PDOException;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index(Request $request) {

        try {
            $dashboard = [];
            $dashboard['today_user']= User::whereDate('created_at', Carbon::today())->count();
            $dashboard['previous_day_user']= User::whereDate('created_at', Carbon::yesterday())->count();
            $dashboard['last_seven_day_user']= User::whereDate('created_at', '>=', Carbon::today()->subDays(7))->count();
            $dashboard['this_month_user']= User::whereMonth('created_at', Carbon::now()->month)->count();

    
            $dashboard['today_task']= Task::whereDate('created_at', Carbon::today())->count();
            $dashboard['previous_day_task']= Task::whereDate('created_at', Carbon::yesterday())->count();
            $dashboard['last_seven_day_task']= Task::whereDate('created_at', '>=', Carbon::today()->subDays(7))->count();
            $dashboard['this_month_task']= Task::whereMonth('created_at', Carbon::now()->month)->count();
    
            $dashboard['last_seven_day_paid']= Withdraw::where('status', 2)->whereDate('created_at', '>=', Carbon::today()->subDays(7))->sum('amount');
            $dashboard['last_seven_day_pending']= Withdraw::where('status', 1)->whereDate('created_at', '>=', Carbon::today()->subDays(7))->sum('amount');
            $dashboard['total_paid']= Withdraw::where('status', 2)->sum('amount');
            $dashboard['total_pending']= Withdraw::where('status', 1)->sum('amount');
            $dashboard['this_month_paid']= Withdraw::whereMonth('created_at', Carbon::now()->month)->sum('amount');

            return respondWithSuccess('Setting fetched successfully', $dashboard);

        } catch (PDOException $e) {
            
            return respondWithError($e->getMessage(), 422);
        }
    }
}
