<?php

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class GutenbergFormField extends AbstractHandler
{
    protected $codename = 'gutenbergField';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.gutenbergField', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
