<?php

namespace App\Http\Controllers\Base\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Base\BaseController;
use Config;
use Session;

class FrontController extends BaseController
{
    public function debugLog($e = null)
    {
        if (Config::get('admin.project_mode') == 'live') {
            abort(500);
            Log::debug($e);
        } else {
            return response()->json($e);
        }
    }

    public function success($type, $field)
    {
        if (request()->ajax()) {
            return "<div class='alert alert-success' role='alert'><strong>Great!</strong> " . trans('message.' . $type, ['attribute' => $field]) . "</div>";
        }
        return Session::flash('message', "<div class='alert alert-success' role='alert'><strong>Excellent!</strong> " . trans('message.' . $type, ['attribute' => $field]) . "</div>");
    }

    public function warning($field)
    {
        if (request()->ajax()) {
            return "<div class='alert alert-success' role='alert'><strong>Be aware!</strong> " . trans('message.' . $type, ['attribute' => $field]) . "</div>";
        }

        return Session::flash('message', "<div class='alert alert-success' role='alert'><strong>Be aware!</strong> " . trans('message.' . $type, ['attribute' => $field]) . "</div>");
    }

    public function error($type, $field)
    {
        if (request()->ajax()) {
            return "<div class='alert alert-danger' role='alert'><strong>Success!</strong> " . trans('message.' . $type, ['attribute' => $field]) . "</div>";
        }

        return Session::flash('message', "<div class='alert alert-danger' role='alert'><strong>Success!</strong> " . trans('message.' . $type, ['attribute' => $field]) . "</div>");
    }

    /**
     * [success description]
     * @param  string $type  type of the message
     * @param  string $field name of the  module
     *
     * === there are two type of message ===
     * if request is ajax then display via html rendering.
     * if request is normal then display via the session.
     */
    public function info($type, $field)
    {
        if (request()->ajax()) {
            return "<div class='alert alert-info' role='alert'><strong>Info!</strong> " . trans('message.' . $type, ['attribute' => $field]) . "</div>";
        }

        return Session::flash('message', "<div class='alert alert-info' role='alert'><strong>Info!</strong> " . trans('message.' . $type, ['attribute' => $field]) . "</div>");
    }
}
