<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

class Dashboard extends Model
{
	private static $instance = null;
	private function __construct() {}
	
	public static function getInstance()
	{
		if (self::$instance == null)
		{
			self::$instance = new Dashboard();
		}
	
		return self::$instance;
	}

	// public function getSummary($user)
	// {
	// 	if($user->role_id != 7) {
	// 		$workers = DB::table('workers')
	// 					->select('workers.id', 'workers.progress_status_id')
	// 					->where('workers.active', 1)
	// 					->get();

	// 		$total = 0;
	// 		$remain = 0;
	// 		$prepare_doc = 0;
	// 		$prepare_dep = 0;
	// 		$not_leave = 0;
	// 		$arrival = 0;
	// 		foreach($workers as $worker) {

	// 			if($worker->progress_status_id == 1) {
	// 				$remain += 1;
	// 			} else if($worker->progress_status_id == 2) {
	// 				$prepare_doc += 1;
	// 			} else if($worker->progress_status_id == 3) {
	// 				$prepare_dep += 1;
	// 			} else if($worker->progress_status_id == 4) {
	// 				$not_leave += 1;
	// 			} else if($worker->progress_status_id == 5) {
	// 				$arrival += 1;
	// 			}

	// 			$total += 1;
	// 		}

	// 		return [
	// 			'total' => (object) ['value' => $total, 'process_status' => 0],
	// 			'remain' => (object) ['value' => $remain, 'process_status' => 1],
	// 			'prepare_doc' => (object) ['value' => $prepare_doc, 'process_status' => 2],
	// 			'prepare_dep' => (object) ['value' => $prepare_dep, 'process_status' => 3],
	// 			'not_leave' => (object) ['value' => $not_leave, 'process_status' => 4],
	// 			'arrival' => (object) ['value' => $arrival, 'process_status' => 5]
	// 		];
	// 	} else {
	// 		return [
	// 			'total' => (object) ['value' => 3, 'process_status' => 0],
	// 			'remain' => (object) ['value' => 3, 'process_status' => 1],
	// 			'prepare_doc' => (object) ['value' => 0, 'process_status' => 2],
	// 			'prepare_dep' => (object) ['value' => 0, 'process_status' => 3],
	// 			'not_leave' => (object) ['value' => 0, 'process_status' => 4],
	// 			'arrival' => (object) ['value' => 0, 'process_status' => 5]
	// 		];
	// 	}
	// }

	public function getSummary($user, $country = null, $factory = null, $branch = null)
	{
		if($user->role_id == 7) {
			return [
				'total' => (object) ['value' => 3, 'process_status' => 0],
				'remain' => (object) ['value' => 3, 'process_status' => 1],
				'prepare_doc' => (object) ['value' => 0, 'process_status' => 2],
				'prepare_dep' => (object) ['value' => 0, 'process_status' => 3],
				'not_leave' => (object) ['value' => 0, 'process_status' => 4],
				'arrival' => (object) ['value' => 0, 'process_status' => 5]
			];
		} else if($user->role_id == 4) {

			$users_factories = DB::table('user_factory_branches')
						->join("factories", "user_factory_branches.factory_id", "=", "factories.id")
						->select('user_factory_branches.id', 'user_factory_branches.factory_id', 'user_factory_branches.factory_branch_id', 'factories.country_id')
						->where('user_factory_branches.active', 1)
						->where('user_factory_branches.user_id', $user->id)
						->get();
			if($users_factories != null) {
				foreach($users_factories as $item) {
					$branch[] = $item->factory_branch_id;
				}
			}
		}

		$data['countries'] = DB::table('countries')->where('active', 1)->get();

        $total_all          = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1);
        $total_pending      = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 1);
        $total_preparing    = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 2);
        $total_ready        = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 3);
        $total_delay        = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 4);
        $total_reach        = DB::table('workers')->join('worker_factories', 'worker_factories.worker_id', 'workers.id')->where('workers.active', 1)->where('progress_status_id', 5);

        if($country != null){
            $country_id = $country;
            
            $total_all->where(function ($query) use ($country_id) {
				if(is_array($country_id)) {
                	$query->whereIn('worker_factories.country_id', $country_id);
				} else {
					$query->where('worker_factories.country_id', $country_id);
				}
            });
            $total_pending->where(function ($query) use ($country_id) {
				if(is_array($country_id)) {
                	$query->whereIn('worker_factories.country_id', $country_id);
				} else {
					$query->where('worker_factories.country_id', $country_id);
				}
            });
            $total_preparing->where(function ($query) use ($country_id) {
				if(is_array($country_id)) {
                	$query->whereIn('worker_factories.country_id', $country_id);
				} else {
					$query->where('worker_factories.country_id', $country_id);
				}
            });
            $total_ready->where(function ($query) use ($country_id) {
    
				if(is_array($country_id)) {
                	$query->whereIn('worker_factories.country_id', $country_id);
				} else {
					$query->where('worker_factories.country_id', $country_id);
				}
            });
            $total_reach->where(function ($query) use ($country_id) {

				if(is_array($country_id)) {
                	$query->whereIn('worker_factories.country_id', $country_id);
				} else {
					$query->where('worker_factories.country_id', $country_id);
				}
            });
        }
        if($factory != null){
            $factory_id = $factory;
            $total_all->where(function ($query) use ($factory_id) {
				if(is_array($factory_id)) {
                	$query->whereIn('worker_factories.factory_id', $factory_id);
				} else {
					$query->where('worker_factories.factory_id', $factory_id);
				}
            });
            $total_pending->where(function ($query) use ($factory_id) {
				if(is_array($factory_id)) {
                	$query->whereIn('worker_factories.factory_id', $factory_id);
				} else {
					$query->where('worker_factories.factory_id', $factory_id);
				}
            });
            $total_preparing->where(function ($query) use ($factory_id) {
				if(is_array($factory_id)) {
                	$query->whereIn('worker_factories.factory_id', $factory_id);
				} else {
					$query->where('worker_factories.factory_id', $factory_id);
				}
            });
            $total_ready->where(function ($query) use ($factory_id) {
				if(is_array($factory_id)) {
                	$query->whereIn('worker_factories.factory_id', $factory_id);
				} else {
					$query->where('worker_factories.factory_id', $factory_id);
				}
            });
            $total_delay->where(function ($query) use ($factory_id) {
				if(is_array($factory_id)) {
                	$query->whereIn('worker_factories.factory_id', $factory_id);
				} else {
					$query->where('worker_factories.factory_id', $factory_id);
				}
            });
            $total_reach->where(function ($query) use ($factory_id) {
				if(is_array($factory_id)) {
                	$query->whereIn('worker_factories.factory_id', $factory_id);
				} else {
					$query->where('worker_factories.factory_id', $factory_id);
				}
            });
        }
        if($branch != null){
            $branch_id = $branch;
            $total_all->where(function ($query) use ($branch_id) {
				if(is_array($branch_id)) {
                	$query->whereIn('worker_factories.factory_branch_id', $branch_id);
				} else {
					$query->where('worker_factories.factory_branch_id', $branch_id);
				}
            });
            $total_pending->where(function ($query) use ($branch_id) {

				if(is_array($branch_id)) {
                	$query->whereIn('worker_factories.factory_branch_id', $branch_id);
				} else {
					$query->where('worker_factories.factory_branch_id', $branch_id);
				}
            });
            $total_preparing->where(function ($query) use ($branch_id) {
				if(is_array($branch_id)) {
                	$query->whereIn('worker_factories.factory_branch_id', $branch_id);
				} else {
					$query->where('worker_factories.factory_branch_id', $branch_id);
				}
            });
            $total_ready->where(function ($query) use ($branch_id) {
				if(is_array($branch_id)) {
                	$query->whereIn('worker_factories.factory_branch_id', $branch_id);
				} else {
					$query->where('worker_factories.factory_branch_id', $branch_id);
				}
            });
            $total_delay->where(function ($query) use ($branch_id) {
				if(is_array($branch_id)) {
                	$query->where('worker_factories.factory_branch_id', $branch_id);
				} else {
					$query->where('worker_factories.factory_branch_id', $branch_id);
				}
            });
            $total_reach->where(function ($query) use ($branch_id) {
				if(is_array($branch_id)) {
                	$query->whereIn('worker_factories.factory_branch_id', $branch_id);
				} else {
					$query->where('worker_factories.factory_branch_id', $branch_id);
				}
            });
        }

		return [
			'total' => (object) ['value' => $total_all->distinct('workers.id')->count(), 'process_status' => 0],
			'remain' => (object) ['value' => $total_pending->distinct('workers.id')->count(), 'process_status' => 1],
			'prepare_doc' => (object) ['value' => $total_preparing->distinct('workers.id')->count(), 'process_status' => 2],
			'prepare_dep' => (object) ['value' => $total_ready->distinct('workers.id')->count(), 'process_status' => 3],
			'not_leave' => (object) ['value' => $total_delay->distinct('workers.id')->count(), 'process_status' => 4],
			'arrival' => (object) ['value' => $total_reach->distinct('workers.id')->count(), 'process_status' => 5]
		];
	}

	public function getByMonth($user)
	{
		if($user->role_id != 7) {
			$first = Carbon::today()->startOfMonth();
			$last = $first->copy()->endOfMonth();

			$worker_progress_histories = DB::table('worker_progress_histories')
						->select('worker_progress_histories.id', 'worker_progress_histories.progress_status_id')
						->where('worker_progress_histories.active', 1)
						->whereDate('worker_progress_histories.created_at', '<=', $last)
						->whereDate('worker_progress_histories.created_at', '>=', $first)
						->get();

			$new = 0;
			$not_leave = 0;
			$arrival = 0;
			
			foreach($worker_progress_histories as $item) {
				if($item->progress_status_id == 1) {
					$new += 1;
				} else if($item->progress_status_id == 4) {
					$not_leave += 1;
				} else if($item->progress_status_id == 5) {
					$arrival += 1;
				}
			}

			return [
				'current' => Carbon::now()->format('Y-m'),
				'new' => $new,
				'not_leave' => $not_leave,
				'arrival' => $arrival,
			];
		} else {
			return [
				'current' => Carbon::now()->format('Y-m'),
				'new' => 0,
				'not_leave' => 0,
				'arrival' => 0,
			];
		}
	}

	public function getVerifyPassport($user) {
		return [
			'current' => Carbon::now()->format('Y-m'),
			'count' => 0
		];
	}
}
