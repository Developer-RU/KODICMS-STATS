<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Stats_Reports extends Model_Widget_Decorator {
	
	public function fetch_data()
	{
		return array();
	}
	
    public function hourses($post = NULL) {
        if($post) 
        {
            $query = DB::select('start_datetime', 'address')
                    ->from('stats')
                    //->where('start_datetime', '>', DB::expr('NOW() - INTERVAL 24 HOUR'))
                    ->where('start_datetime', '>=', $post['start_date'] . ' ' . $post['start_time'])
                    ->and_where('start_datetime', '<=', $post['stop_date'] . ' ' . $post['stop_time'])
                    ->execute()
                    ->as_array();
        }
        else
        {
            $query = DB::select('start_datetime', 'address')
                ->from('stats')
                ->where('start_datetime', '>', DB::expr('NOW() - INTERVAL 24 HOUR'))
                ->execute()
                ->as_array();
        }
        $stats_hourses = array(); // Массив (массивов) для построения графика 
		$users = array(); // Массив IP пользователей
		
        // Получаем массив из массива как ключ{значение} в цикле
        foreach ($query as $key) {
		
            $date = new DateTime($key['start_datetime']); // Временная метка
            $date = $date->format('Y-m-d H:00:00');
			
            if (!$stats_hourses)
                $stats_hourses[$date] = array('hour' => $date, 'view' => 0, 'user' => 0);

            if (!$users)
                $users[$date] = array($key['address']); // Собираем IP 

            if (array_key_exists($date, $users)) {
                array_push($users[$date], $key['address']);
            } else {
                $users[$date] = array();
            }

            if (array_key_exists($date, $stats_hourses)) {
                if (in_array($key['address'], $users[$date])) {
                    $stats_hourses[$date]['view'] = 1 + (int) $stats_hourses[$date]['view'];
                    $stats_hourses[$date]['user'] = 1;
                } else {
                    $stats_hourses[$date]['view'] = 1 + (int) $stats_hourses[$date]['view'];
                    $stats_hourses[$date]['user'] = 1 + (int) $stats_hourses[$date]['user'];
                }
            } else {
                $stats_hourses[$date] = array('hour' => $date, 'view' => 0, 'user' => 0);  // Часовая метка записи + пользователь + просмотр
            }
        }

		return $stats_hourses;
    }
	
    public function browsers() {

        $query = DB::select('user_agent')
                ->from('stats')
                ->where('start_datetime', '>', DB::expr('NOW() - INTERVAL 24 HOUR'))
                ->execute()
                ->as_array();

        $res = array();

        foreach ($query as $result) {
            if (strpos($result['user_agent'], "Firefox") != false)
                $browser = "Firefox";
            elseif (strpos($result['user_agent'], "Opera") != false)
                $browser = "Opera";
            elseif (strpos($result['user_agent'], "Chrome") != false)
                $browser = "Chrome";
            elseif (strpos($result['user_agent'], "MSIE") != false)
                $browser = "MSIE";
            elseif (strpos($result['user_agent'], "Safari") != false)
                $browser = "Safari";
            elseif (strpos($result['user_agent'], "Trident") != false)
                $browser = "MSIE";
            else
                $browser = "Неизвестный";
            $res[] = $browser;
        }

        $result = array_count_values($res);
        $all = ( 100 / (array_sum($result)) );
				
        $popular_browsers = array();

        foreach ($result as $key => $value) {
            $popular_browsers[$key] = round($value * $all);
        }
		
        return $popular_browsers;
    }
	
}