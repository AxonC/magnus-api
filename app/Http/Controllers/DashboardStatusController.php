<?php

namespace App\Http\Controllers;

use App\Camera;
use App\PositionReport;
use App\SecurityAlert;
use App\Student;

class DashboardStatusController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'totalEnrolled'     => Student::count(),
                'recentNewEnrolled' => Student::where('created_at', '>', \Carbon\Carbon::parse('2 days ago'))->get()->count(),
                'validDetections'   => PositionReport::count(),
                'invalidDetections' => SecurityAlert::count(),
                'cameras'           => Camera::withCount('reports', 'alerts')->get()->each(function (Camera $model) {
                    $success_rate = 0;
                    if ($model->alerts_count > 1 && $model->reports_count > 1) {
                        $success_rate = $model->alerts_count / $model->reports_count;
                    }

                    return $model->setAttribute('success_rate', $success_rate);
                }),
            ],
        ]);
    }
}
