<?php
// example of an HTML form generation class
// NOTE: works with login form example: ../oop/oop_html_form_generator.php
// NOTE: does filtering as well as validation
class FormValidator
{
    const CORE_MESSAGE = 'core';
    const ERROR_NEED_ELEMENTS  = 'ERROR: need to define a top config key "elements"';
    const NOT_ALNUM = 'Input must be only letters or numbers';
    const NOT_MAX_STRLEN = 'The length for this field cannot exceed ';
    const NOT_MIN_STRLEN = 'The length for this field must be at least ';
    const NOT_REGEX = 'Input does not meet the required pattern';
    const NOT_DEFINED = 'There are no validators defined for this element';
    // $config assumed in this format:
    /*
    $config = [
        'elements' => [
            // template
            'name_of_element_1' => [
                ['name' => 'trim'],
                ['name' => 'stripTags'],
                ['name' => 'alnum'],
                ['name' => 'strlen', 'min' => 1, 'max' => 8],
                etc.
            ],
        ]
    ];
    * 
     * 
     */
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
    public function validate(array $data)
    {
        foreach ($data as $key => $value) {
            if (!isset($this->config['elements'][$key]) {
                $this->messages[self::CORE_MESSAGE][] = self::NOT_DEFINED;
            } else {
                foreach ($this->config['elements'][$key] as $callbacks => $params) {
                    if (isset($callbacks['name'] && method_exists($this, $callbacks['name']) {
                        $this->$callbacks['name']($key, $value, $params);
                    }
                }
            }
        }            
    }
    // Validators -------------------------------------------------------------
    public function strlen($fieldName, $value, ...$params)
    {
        $valid = TRUE;
        if (strlen($value) > $params['max']) {
            $valid = FALSE;
            $this->messages[$fieldName][] = self::NOT_MAX_STRLEN . $params['max'];
        } elseif (isset($params['min']) {
            if (strlen($value) < $params['min']) {
                $valid = FALSE;
                $this->messages[$fieldName][] = self::NOT_MIN_STRLEN . $params['min'];
            }        
        }
        return $valid;
    } 
    public function regex($fieldName, $value, ...$params)
    {
        $valid = FALSE;
        if (preg_match($params['pattern'], $value)) {
            $valid = TRUE;
        } else {
            $this->messages[$fieldName][] = self::NOT_REGEX;
        }
        return $valid;
    }
    // Filters ----------------------------------------------------------------
    public function trim($value)
    {
        return trim($value);
    } 
    public function stripTags($value)
    {
        return strip_tags($value);
    } 
}

// example usage:
$config = [
    'elements' => [
        // template
        'username' => [
            ['trim' => []],
            ['stripTags' => []],
            ['strlen' => ['min' => 1, 'max' => 16]],
            ['regex' => ['pattern' => '/^[A-Z](\w+|\b)+$/']],
        ],
        // NOTE: in production you will most likely NOT validate a password entry!
        //       ... has the potential to give away too much information to an attacker
        'password' => [
            ['trim' => []],
            ['strlen' => ['min' => 1, 'max' => 16]],
        ],
    ]
];

// simulated good $_POST data
$post[] = ['username' => 'Robert Channings, III', 'password' => 'SuperSecret!'];

// simulated bad $_POST data
$post[] = ['username' => 'Robert<script>alert("Hacking");</script>Channings', 'password' => '1<script>alert("Hacking");</script>2'];

$validator = new FormValidator();
