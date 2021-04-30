<?php
namespace Lab\Login;
// example of an HTML form generation class
// NOTE: works with validation example: ../security/login_form_validation.php

class FormGen
{
    const ERROR_NEED_FORM      = 'ERROR: need to define a top config key "form"';
    const ERROR_NEED_FORM_NAME = 'ERROR: need to define a top config key "form[name]"';
    const ERROR_NEED_ELEMENTS  = 'ERROR: need to define a top config key "elements"';
    const DEFAULT_TYPE         = 'text';
    const DEFAULT_PREFIX       = 'generated_';
    const DEFAULT_SEPARATOR    = '<br>';
    const LABEL_SEPARATOR      = '&nbsp;&nbsp;';

    protected $config;
    protected $rand = 0;
    protected $errors = array();
    
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
    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }
    public function setValue($name, $value)
    {
        if (!in_array($this->config['elements'][$name]['type'], ['select','checkbox','radio'])) {
            $this->config['elements'][$name]['value'] = $value;
        } else {
            $this->config['elements'][$name]['selected'] = $value;
        }
    }
    public function makeErrorHtml($name)
    {
        $output = '';
        if (isset($this->errors[$name])) {
            $output .= '<ul>';
            foreach ($this->errors[$name] as $message) {
                $output .= '<li>' . $message . '</li>' . PHP_EOL;
            }
            $output .= '</ul>';
            $output .= PHP_EOL;
        }
        return $output;
    }
    public function makeSelect($type, $name, $attribs, $close = TRUE)
    {
        $html = $this->placeLabel('', $attribs);
        if (isset($attribs['value']) && is_array($attribs['value'])) {
            $values = $attribs['value'];
            unset($attribs['value']);
            $html .= $this->makeTag('select', $name, $attribs, FALSE, self::DEFAULT_SEPARATOR, FALSE);
            foreach ($values as $key => $value) {
                $html .= '<option value="' . $key . '">'
                       . $value
                       . '</option>' . PHP_EOL;
            }
            $html .= '</select>' . PHP_EOL;
        }
        $html .= $this->makeErrorHtml($name);
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
                $html .= $this->makeTag('input', $name . '[]', $sub, TRUE, self::LABEL_SEPARATOR, FALSE);
            }
        }
        $html .= self::DEFAULT_SEPARATOR;
        $html .= PHP_EOL;
        $html .= $this->makeErrorHtml($name);
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
    public function makeTag($type, $name, $attribs, $close = TRUE, $separator = self::DEFAULT_SEPARATOR, $showError = TRUE)
    {
        $input = $this->placeLabel('', $attribs);
        $input .= '<' . $type . ' name="' . $name . '" ';
        foreach ($attribs as $key => $value) {
            if ($key != 'label') $input .= sprintf('%s="%s" ', $key, $value);
        }
        $input .= ($close) ? ' />' : ' >';
        $input .= $separator;
        $input .= PHP_EOL;
        $input .= ($showError) ? $this->makeErrorHtml($name) : '';
        return $input;
    }
    public function getValue($key)
    {
        return $this->config['elements'][$key]['value'] ?? NULL;
    }
    public function theWholeForm()
    {
        $html = '';
        foreach ($this->config['form'] as $name => $attribs) {
            $html .= $this->makeTag('form', $name, $attribs, FALSE);
        }
        foreach ($this->config['elements'] as $name => $attribs) {
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
        }
        $html .= '</form>';
        return $html;
    }
}
