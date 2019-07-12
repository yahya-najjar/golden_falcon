<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function set_editable($model, $editable)
    {

        if ($model->$editable) {
            $model->update([
                $editable => 0,
            ]);

            return response()->json([
                'status' => 0,
                'type' => $editable,
            ]);
        }

        $model->update([
            $editable => 1,
        ]);

        return response()->json([
            'status' => 1,
            'type' => $editable,
        ]);
    }
}
