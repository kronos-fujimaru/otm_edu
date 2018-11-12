<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SelectMenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $index = $this->getSelectMenuIndex($request);
        view()->share('selectMenuIndex', $index );
        return $next($request);
    }

    private function getSelectMenuIndex($request)
    {
        if ($request->is('participant/*')) {
            return $this->getSelectMenuIndexForParticipant($request);
        }else if($request->is('manager/*')){
            return $this->getSelectMenuIndexForManager($request);
        }else if ($request->is('admin/*')) {
            return $this->getSelectMenuIndexForAdmin($request);
        }
        return '0';
    }

    private function getSelectMenuIndexForParticipant($request)
    {
        if ($request->is('participant/dailyreport')) {
            return "1";
        } else if ($request->is('participant/exam')) {
            return "2";
        } else if($request->is('participant/question'))  {
            return "3";
        } else if($request->is('participant/report'))  {
            return "4";
        }
        return '0';
    }

    private function getSelectMenuIndexForManager($request)
    {
        if ($request->is('manager/support')) {
            return "2";
        }
        return '0';
    }

    private function getSelectMenuIndexForAdmin($request)
    {
        if ($request->is('admin/instructors*')) {
            return "2";
        } else if ($request->is('admin/companies*')
                    || $request->is('admin/users*')) {
            return "3";
        } else if ($request->is('admin/trainings*')
                    || $request->is('admin/participants*')
                    || $request->is('admin/managers*')
                    || $request->is('admin/exams*')
                    || $request->is('admin/questions*')
                    || $request->is('admin/supports*')) {
            return "4";
        } else if ($request->is('admin/examinations*')) {
            return "5";
        } else if ($request->is('admin/analysis*')) {
            return "6";
        }
        return '0';
    }
}
