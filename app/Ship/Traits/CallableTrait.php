<?php
/**
 * Created by PhpStorm.
 * User: sweetjew
 * Date: 26.01.19
 * Time: 17:44
 */

namespace App\Ship\Traits;


use Dotenv\Exception\InvalidPathException;
use Illuminate\Support\Facades\App;
use Prophecy\Exception\Doubler\ClassNotFoundException;

trait CallableTrait
{
    public function call(string $class, array $mainMethodArgs = [], array $extraMethodsToCall = [])
    {
        $class = $this->resolveClass($class);

        $this->setUIIfExist($class);

        $this->callExtraMethods($class, $extraMethodsToCall);

        return $class->run(...$mainMethodArgs);
    }

    /**
     * @param $class
     * @param $extraMethodsToCall
     */
    private function callExtraMethods($class, $extraMethodsToCall)
    {
        // allows calling other methods in the class before calling the main `run` function.
        foreach ($extraMethodsToCall as $methodInfo) {
            // if is array means it method has arguments
            if (is_array($methodInfo)) {
                $this->callWithArguments($class, $methodInfo);
            } else {
                // if is string means it's just the method name without arguments
                $this->callWithoutArguments($class, $methodInfo);
            }
        }
    }

    /**
     * @param $class
     * @param $methodInfo
     */
    private function callWithArguments($class, $methodInfo)
    {
        $method = key($methodInfo);
        $arguments = $methodInfo[$method];
        if (method_exists($class, $method)) {
            $class->$method(...$arguments);
        }
    }

    /**
     * @param $class
     * @param $methodInfo
     */
    private function callWithoutArguments($class, $methodInfo)
    {
        if (method_exists($class, $methodInfo)) {
            $class->$methodInfo();
        }
    }

    /**
     * Get instance from a class string
     *
     * @param $class
     *
     * @return  mixed
     */
    private function resolveClass($class)
    {
        // in case passing style names such as containerName@classType
        if ($this->needsParsing($class)) {

            $parsedClass = $this->parseClassName($class);

            $moduleName = $this->capitalizeFirstLetter($parsedClass[0]);
            $className = $parsedClass[1];

            $this->verifyContainerExist($moduleName);

            $class = $classFullName = $this->buildClassFullName($moduleName, $className);

            $this->verifyClassExist($classFullName);
        }

        return App::make($class);
    }


    /**
     * @param string $class
     * @param string $delimiter
     * @return array
     */
    private function parseClassName(string $class, string $delimiter = '@') : array
    {
        return explode($delimiter, $class);
    }

    /**
     * If it's Style caller like this: containerName@someClass
     *
     * @param        $class
     * @param string $separator
     *
     * @return  int
     */
    private function needsParsing($class, $separator = '@')
    {
        return preg_match('/' . $separator . '/', $class);
    }

    /**
     * @param $string
     *
     * @return  string
     */
    private function capitalizeFirstLetter(string $string) : string
    {
        return ucfirst($string);
    }

    /**
     * @param string $moduleName
     *
     * @return void
     */
    public function verifyContainerExist(string $moduleName) : void
    {
        if (!is_dir(app_path('Modules/' . $moduleName))) {
            throw new InvalidPathException("EducationalModule ($moduleName) is not installed.");
        }
    }

    /**
     * @param $className
     */
    public function verifyClassExist($className)
    {
        if (!class_exists($className)) {
            throw new ClassNotFoundException("Class ($className) is not installed.", $className);
        }
    }

    /**
     * Build namespace for a class in Container.
     *
     * @param $moduleName
     * @param $className
     *
     * @return  string
     */
    public function buildClassFullName($moduleName, $className)
    {
        return 'App\Modules\\' . $moduleName . '\\' . $this->getClassType($className) . 's\\' . $className;
    }

    /**
     * Get the last part of a camel case string.
     * Example input = helloDearWorld | returns = World
     *
     * @param $className
     *
     * @return  mixed
     */
    public function getClassType($className)
    {
        $array = preg_split('/(?=[A-Z])/', $className);

        return end($array);
    }

    /**
     *
     * $this->ui is coming, should be attached on the parent controller, from where the actions was called.
     * It can be WebController and ApiController. Each of them has ui, to inform the action
     * if it needs to handle the request differently.
     *
     * @param $class
     */
    private function setUIIfExist($class)
    {
        if (method_exists($class, 'setUI') && property_exists($this, 'ui')) {
            $class->setUI($this->ui);
        }
    }

}