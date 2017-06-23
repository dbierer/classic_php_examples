<?php
// example of an HTML form generation class

class FormGenerator
{
    const ERROR_NEED_FORM      = 'ERROR: need to define a top config key "form"';
    const ERROR_NEED_FORM_NAME = 'ERROR: need to define a top config key "form[name]"';
    const ERROR_NEED_ELEMENTS  = 'ERROR: need to define a top config key "elements"';
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
    public function makeTag($type, $name, $attribs, $close = TRUE)
    {
        $input = '';
        if (isset($attribs['label'])) {
            $input .= $attribs['label'] . self::LABEL_SEPARATOR;
        }
        $input .= '<' . $type . ' name="' . $name . '" ';
        foreach ($attribs as $key => $value) {
            if ($key != 'label') $input .= sprintf('%s="%s" ', $key, $value);
        }
        $input .= ($close) ? ' />' : ' >';
        $input .= self::DEFAULT_SEPARATOR . PHP_EOL;
        return $input;
    }
    public function theWholeForm()
    {
        $html = '';
        foreach ($this->config['form'] as $name => $attribs) {
            $html .= $this->makeTag('form', $name, $attribs, FALSE);
        }
        foreach ($this->config['elements'] as $name => $attribs) {
            $html .= $this->makeTag('input', $name, $attribs, TRUE);
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
        'submit' => [
            'type' => 'submit',
            'value' => 'login'
        ]
    ]
];

$form = new FormGenerator($config);
echo $form->theWholeForm();
