<?php


namespace App\Ship\Parents;


use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest implements RequestInterface, ParentInterface
{
    public $urlParameters = [];

    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        $requestData = parent::all($keys);
        $requestData = $this->mergeUrlParametersWithRequestData($requestData);

        return $requestData;
    }

    /**
     * @param array $requestData
     * @return array
     */
    private function mergeUrlParametersWithRequestData(Array $requestData)
    {
        if (isset($this->urlParameters) && !empty($this->urlParameters)) {
            foreach ($this->urlParameters as $param) {
                $requestData[$param] = $this->route($param);
            }
        }
        return $requestData;
    }
}