<?php
// example of an HTML form generation class
// NOTE: works with validation example: ../security/login_form_validation.php

class FormGenerator
{
    const ERROR_NEED_FORM      = 'ERROR: need to define a top config key "form"';
    const ERROR_NEED_FORM_NAME = 'ERROR: need to define a top config key "form[name]"';
    const ERROR_NEED_ELEMENTS  = 'ERROR: need to define a top config key "elements"';
    const DEFAULT_TYPE         = 'text';
    const DEFAULT_PREFIX       = 'generated_';
    const DEFAULT_SEPARATOR    = '<br>';
    const LABEL_SEPARATOR      = '&nbsp;&nbsp;';
    // $config assumed in this format:
    /*
    $config = [
        'form' => [
            'form_name' => [array for form tag attribs]
        ],
        'elements' => [
            // template
            'name_of_element_1' => [
                // each key is an HTML input tag attribute
                'type' => text | password | textarea | etc.,
                'id' => id_for_this_input
                etc.
            ],
            // text example
            'username' => [
                'type' => 'text',
                'id' => 'username',
                'title' => 'Enter your username',
            ],
            // textarea example
            'comments' => [
                'type' => 'textarea',
                'id' => 'comments',
                'title' => 'Enter your username',
                'rows' => 4,
                'cols' => 80,
            ],
        ]
    ];
    * 
     * 
     */
    protected $config;
    protected $rand = 0;
    public function __construct(array $config)
    {
        if (!isset($config['form'])) {
            throw new InvalidArgumentException(self::ERROR_NEED_FORM);
        } elseif (!isset($config['form'])) {
            throw new InvalidArgumentException(self::ERROR_NEED_FORM);
        } elseif (!isset($config['elements'])) {
            throw new InvalidArgumentException(self::ERROR_NEED_ELEMENTS);
        }
        $this->config = $config;
    }
    public function makeSelect($type, $name, $attribs, $close = TRUE)
    {
        $html = $this->placeLabel('', $attribs);
        if (isset($attribs['value']) && is_array($attribs['value'])) {
            $values = $attribs['value'];
            unset($attribs['value']);
            $html .= $this->makeTag('select', $name, $attribs, FALSE);
            foreach ($values as $key => $value) {
                $html .= '<option value="' . $key . '">'
                       . $value
                       . '</option>' . PHP_EOL;
            }
            $html .= '</select>' . PHP_EOL;
        }
        $html .= self::DEFAULT_SEPARATOR;
        return $html;
    }
    public function makeRadioCheck($type, $name, $attribs, $close = TRUE)
    {
        $html = $this->placeLabel('', $attribs);
        if (isset($attribs['value']) && is_array($attribs['value'])) {
            $values = $attribs['value'];
            $id     = ($attribs['id']) ? $attribs['id'] . '_' : $name . '_';
            $num    = 0;
            foreach ($values as $key => $value) {
                $sub = $attribs;
                $sub['value'] = $key;
                $sub['label'] = $value;
                $sub['id'] = $id . $num++;
                $html .= $this->makeTag('input', $name . '[]', $sub, TRUE, self::LABEL_SEPARATOR);
            }
        }
        $html .= self::DEFAULT_SEPARATOR;
        $html .= PHP_EOL;
        return $html;
    }
    public function placeLabel($input, &$attribs)
    {
        if (isset($attribs['label'])) {
            $input .= $attribs['label'] . self::LABEL_SEPARATOR;
            unset($attribs['label']);
        }
        return $input;
    }
    public function makeTag($type, $name, $attribs, $close = TRUE, $separator = self::DEFAULT_SEPARATOR)
    {
        $input = $this->placeLabel('', $attribs);
        $input .= '<' . $type . ' name="' . $name . '" ';
        foreach ($attribs as $key => $value) {
            if ($key != 'label') $input .= sprintf('%s="%s" ', $key, $value);
        }
        $input .= ($close) ? ' />' : ' >';
        $input .= $separator;
        $input .= PHP_EOL;
        return $input;
    }
    public function theWholeForm()
    {
        $html = '';
        foreach ($this->config['form'] as $name => $attribs) {
            $html .= $this->makeTag('form', $name, $attribs, FALSE);
        }
        foreach ($this->config['elements'] as $name => $attribs) {
            $error = '';
            if (isset($attribs['error'])) {
                if (is_array($attribs['error'])) {
                    $error = implode(self::DEFAULT_SEPARATOR, $attribs['error']);
                } else {
                    $error = $attribs['error'];
                }
                unset($attribs['error']);
            }
            if (!isset($attribs['type'])) {
                $attribs['type'] = self::DEFAULT_TYPE;
            } else {
                $attribs['type'] = strtolower($attribs['type']);
            }
            if ($attribs['type'] == 'checkbox') {
                $html .= $this->makeRadioCheck('checkbox', $name, $attribs, TRUE);
            } elseif ($attribs['type'] == 'radio') {
                $html .= $this->makeRadioCheck('radio', $name, $attribs, TRUE);
            } elseif ($attribs['type'] == 'select') {
                $html .= $this->makeSelect('select', $name, $attribs, TRUE);
            } else {
                $html .= $this->makeTag('input', $name, $attribs, TRUE);
            }
            $html .= $error;
        }
        $html .= '</form>';
        return $html;
    }
}

// example usage:
$config = [
    'form' => [
        'login' => [
            'action' => '/user/login',
            'method' => 'post',
            'id' => 'login'
        ],
    ],
    'elements' => [
        'username' => [
            'label' => 'Username: ',
            'type' => 'text',
            'id' => 'username',
            'title' => 'Enter your username',
        ],
        'password' => [
            'label' => 'Password: ',
            'type' => 'password',
            'id' => 'password',
            'title' => 'Enter your password',
        ],
        // textarea example
        'comments' => [
            'label' => 'Comments: ',
            'type' => 'textarea',
            'id' => 'comments',
            'title' => 'Enter comments',
            'rows' => 4,
            'cols' => 80,
        ],
        // checkbox example
        'status' => [
            'label' => 'Status: ',
            'type' => 'checkbox',
            'id' => 'status',
            'value' => ['Y' => 'Yes', 'N' => 'No'],
        ],
        // select example
        'gender' => [
            'label' => 'Gender: ',
            'type' => 'select',
            'id' => 'status',
            'value' => ['m' => 'Male', 'f' => 'Female', 't' => 'Trans'],
        ],
        'submit' => [
            'type' => 'submit',
            'value' => 'Login'
        ]
    ]
];

$form = new FormGenerator($config);
echo $form->theWholeForm();
