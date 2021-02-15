<?php

namespace MakarenkoSergey\GoogleFields;

trait DependsField
{
    protected $addressFieldName = 'address';

    public function jsonSerialize()
    {
        if (isset($this->dependsAttribute)) {
            return array_merge([
                'addressFieldName' => $this->addressFieldName,
                'dependsAttribute' => $this->dependsAttribute
            ], parent::jsonSerialize());
        }
        return parent::jsonSerialize();
    }

    public function setAddressField(string $fieldName)
    {
        $this->addressFieldName = $fieldName;
    }

    public function setDependsAttribute(string $dependsAttribute)
    {
        $this->dependsAttribute = $dependsAttribute;
    }

}