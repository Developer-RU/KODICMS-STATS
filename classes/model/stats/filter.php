<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Filter extends ORM {

    public function datetime() {
        $request = Request::initial();

        $levels = (array) $request->query('level');

        if (!empty($levels)) {
            $this->where('level', 'in', $levels);
        }

        $date_range = $request->query('created_on');
        if (empty($date_range)) {
            $request->query('created_on', array(
                date('Y-m-d', strtotime("-1 month")), date('Y-m-d')
            ));
        }

        if (is_array($date_range)) {
            $this->where(DB::expr('DATE(created_on)'), 'between', $date_range);
        } else if (Valid::date($date_range)) {
            $this->where(DB::expr('DATE(created_on)'), '=', $date_range);
        }

        return $this;
    }

}
