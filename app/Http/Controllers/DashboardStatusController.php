<?php

namespace App\Http\Controllers;

use App\PositionReport;
use App\SecurityAlert;
use App\Student;

class DashboardStatusController extends Controller
{
    public function index()
    {
    	return response()->json([
    		'data' => [
    			'totalEnrolled' => Student::count(),
    			'recentNewEnrolled' => Student::where('created_at', '>', \Carbon\Carbon::parse('2 days ago'))->get()->count(),
    			'validDetections' => PositionReport::count(),
    			'invalidDetections' => SecurityAlert::count(),
                'cameras' => App\Camera::withCount('reports', 'alerts')->get()->each(function ($model) {
                    if ($model->alerts_count < 1 || $model->reports_count < 1)
                    {
                        return $model->setAttribute('success_rate', 0);
                    }

                    return $model->setAttribute('success_rate', $model->reports_count / $model->alerts_count);
                });
    		]
    	]);
    }
}