<?php

namespace Sokil\Mongo\Validator;

class IpValidator extends \Sokil\Mongo\Validator
{
    public function validateField(\Sokil\Mongo\Document $document, $fieldName, array $params)
    {
        $value = $document->get($fieldName);
        
        // check only if set
        if (!$value) {
            return;
        }

        // check if url valid
        var_dump($value, filter_var($value, FILTER_VALIDATE_IP));
        if(false !== filter_var($value, FILTER_VALIDATE_IP)) {
            return;
        }
        
        if (!isset($params['message'])) {
            $params['message'] = 'Value of field "' . $fieldName . '" is not valid IP address in model ' . get_called_class();
        }

        $document->addError($fieldName, $this->getName(), $params['message']);
    }

}