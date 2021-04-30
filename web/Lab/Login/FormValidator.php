<?php
namespace Lab\Login;

// NOTE: does filtering as well as validation

class FormValidator
{
    
    const CORE_MESSAGE = 'core';
    const ERROR_NEED_ELEMENTS  = 'ERROR: need to define a top config key "elements"';
    const NOT_ALNUM = 'Input must be only letters or numbers';
    const NOT_MAX_STRLEN = 'The length for this field cannot exceed ';
    const NOT_MIN_STRLEN = 'The length for this field must be at least ';
    const NOT_REGEX = 'Input does not meet the required pattern';
    const NOT_EMAIL = 'Invalid email address';
    const NOT_DEFINED = 'There are no validators defined for this element';
    
    protected $config;
    protected $messages = array();
    protected $data = array();
    
    public function __construct(array $config)
    {
        if (!isset($config['elements'])) {
            throw new InvalidArgumentException(self::ERROR_NEED_ELEMENTS);
        }
        $this->config = $config;
    }
    // Core Validation --------------------------------------------------------
    // TODO: figure out how to return validation data
    public function validate(array $data, &$form = NULL)
    {
        $valid = TRUE;
        foreach ($data as $key => &$value) {
            $element = $this->config['elements'][$key] ?? FALSE;
            if ($element) {
                foreach ($element as $callback) {
                    $method = key($callback);
                    $params = current($callback);
                    if (method_exists($this, $method)) {
                        $test = $this->$method($key, $value, $params);
                        // check to see if result is from a validator
                        if (is_bool($test)) {
                            if (!$test) {
                                $valid = FALSE;
                            }
                        // otherwise assume value is from filter
                        } else {
                            $value = $test;
                        }
                    }
                }
                // if form object is present, set value
                if ($form) $form->setValue($key, $value);
            }
        }
        return $valid;            
    }
    public function getErrors()
    {
        return $this->messages;
    }
    // Validators -------------------------------------------------------------
    public function strlen($fieldName, $value, $params)
    {
        $valid = TRUE;
        if (strlen($value) > $params['max']) {
            $valid = FALSE;
            $this->messages[$fieldName][] = self::NOT_MAX_STRLEN . $params['max'];
        } elseif (isset($params['min'])) {
            if (strlen($value) < $params['min']) {
                $valid = FALSE;
                $this->messages[$fieldName][] = self::NOT_MIN_STRLEN . $params['min'];
            }        
        }
        return $valid;
    } 
    public function regex($fieldName, $value, $params)
    {
        $valid = FALSE;
        if (preg_match($params['pattern'], $value)) {
            $valid = TRUE;
        } else {
            $this->messages[$fieldName][] = self::NOT_REGEX;
        }
        return $valid;
    }
    public function email($fieldName, $value)
    {
        $valid = FALSE;
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $valid = TRUE;
        } else {
            $this->messages[$fieldName][] = self::NOT_EMAIL;
        }
        return $valid;
    }
    // Filters ----------------------------------------------------------------
    public function trim($fieldName, $value)
    {
        return trim($value);
    } 
    public function stripTags($fieldName, $value)
    {
        return strip_tags($value);
    } 
}
