<?php
class MyForm
{
    protected $output = '';
    public function __construct(array $config)
    {
        if (!isset($config['form'])) {
            throw new Exception('Missing FORM config');
        }
        if (!isset($config['elements'])) {
            throw new Exception('Missing ELEMENT config');
        }
        $this->addElements($config['elements']);
        $this->formTag($config['form']);
    }
    public function addElements(array $config)
    {
        foreach ($config as $element) {
            $this->output .= '<br>';
            if (isset($element['label'])) {
                 $this->output .= $element['label'] . ' '; 
            }
            $this->output .= '<input ';
            foreach ($element as $attrib => $value) {
                $this->output .= $attrib . '="' . $value . '" ';
            }
            $this->output .= '/>';
        }
    }
    public function formTag(array $config)
    {
        $formTag = '<form ';
        foreach ($config as $attrib => $value) {
            $formTag .= $attrib . '="' . $value . '" ';
        }
        $formTag .= '>';
        $this->output = $formTag . $this->output . '</form>';
    }
    public function __toString()
    {
        return $this->output;
    }
}

class MyValidators
{
    protected $messages;
    protected $valid = TRUE;
    protected $config;
    protected $filters;
    protected $validators;
    protected $clean = [];
    protected $done = FALSE;
    public function __construct(array $config, array $filters, array $validators)
    {
        if (!isset($config['elements'])) {
            throw new Exception('Missing ELEMENT config');
        }
        $this->config = $config;
        $this->filters = $filters;
        $this->validators = $validators;
    }
    public function validate(array $data)
    {
        foreach ($elements as $item) {
            if (isset($data[$item['name']])) {
                $clean[$item['name']] = $data[$item['name']];
                if (isset($item['filters'])) {
                    foreach ($item['filters'] as $filter) {
                        if (isset($this->filters[$filter])) {
                            $clean[$item['name']] = $this->filters[$filter]['callback']($clean[$item['name']]);
                        }
                    }
                }
                if (isset($item['validators'])) {
                    foreach ($item['validators'] as $validator) {
                        if (isset($this->validators[$validator])) {
                            if (!$this->validators[$validator]['callback']($clean[$item['name']])) {
                                $this->valid = FALSE;
                                $this->messages[] = $this->validators[$validator]['message'];
                            }
                        }
                    }
                }
            }
        }
        return $this->valid;
    }
    public function isValid(array $data = NULL)
    {
        if ($data) {
            return $this->validate($data);
        } else {
            return $this->valid;
        }
    }
    public function getMessages()
    {
        return $this->messages;
    }
}

$validators = [
    'email' => ['callback' => function ($val) { return filter_var($val, FILTER_VALIDATE_EMAIL); },
                'message' => 'Invalid email address'],
    'min1' => ['callback' => function ($val) { return (strlen($val) > 1); },
                'message' => 'Length must Be greater than 1 character']
];
$filters = [
    'trim' => ['callback' => function ($val) { return trim($val); },
                'message' => 'Whitespace trimmed'],
    'strip' => ['callback' => function ($val) { return strip_tags($val); },
                'message' => 'Markup removed'],
];
$config = [
    'form' => [
        'name' => 'MyForm',
        'id' => 'form1',
        'method' => 'post',
        'action' => basename(__FILE__),
    ],
    'elements' => [
        [
            'name' => 'email',
            'type' => 'email',
            'label' => 'Email:',
            'filters' => ['trim','strip'],
            'validators' => ['email','min1'],
        ],
        [
            'name' => 'password',
            'type' => 'password',
            'label' => 'Password:',
            'validators' => ['min1'],
        ],
        [
            'name' => 'submit',
            'type' => 'submit',
            'value' => 'Login',
        ]
    ]
];
$form = new MyForm($config);
$validate = FALSE;
if (isset($_POST['submit'])) {
    $validate = new MyValidator($config, $filters, $validators);
    $validate->validate($_POST);
}
    
?>
<!DOCTYPE html>
<head>
	<title>Login Form with Filtering and Validation</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<body>
<?= $form ?>
<?php 
if ($validate) {
    if ($validate->isValid()) {
        echo 'DATA IS VALID';
    } else {
        echo 'DATA IS NOT VALID';
        echo '<br>';
        echo '<ul>';
        echo implode('<li>', $validate->getMessages());
        echo '</ul>';
    }
}
?>
</body>
</html>
