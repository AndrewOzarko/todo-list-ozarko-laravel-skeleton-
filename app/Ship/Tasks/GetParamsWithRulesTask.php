<?php

namespace App\Ship\Tasks;

use App\Ship\Parents\Task;

class GetParamsWithRulesTask extends Task
{
    /**
     * @param  array  $data
     * @param  array  $rules
     * @return array
     */
    public function run(array $data, array $rules)
    {
        $indexesWithRules = collect(array_keys($rules));
        $params = collect(array_keys($data));
        $params = $params->intersect($indexesWithRules);

        $requestData = collect($data)->diff($params)->toArray();

        return $requestData;
    }
}