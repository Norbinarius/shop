<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Поле following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Поле :attribute должно быть принято.',
    'active_url'           => 'Поле :attribute имеет не корректный URL.',
    'after'                => 'Поле :attribute должно быть заполнено после :date.',
    'after_or_equal'       => 'Поле :attribute должно быть заполнено после или равно :date.',
    'alpha'                => 'Поле :attribute может содержать только буквы.',
    'alpha_dash'           => 'Поле :attribute может содержать только буквы, цифры, и дефисы.',
    'alpha_num'            => 'Поле :attribute может содержать только буквы и цифры.',
    'array'                => 'Поле :attribute должно быть массивом.',
    'before'               => 'Поле :attribute должно быть заполнено до :date.',
    'before_or_equal'      => 'Поле :attribute должно быть заполнено до или равно :date.',
    'between'              => [
        'numeric' => 'Количество цифр поля :attribute должно быть между :min и :max.',
        'file'    => 'Размер файла :attribute должно быть между :min и :max килобайтов.',
        'string'  => 'Длина поля :attribute должна быть между :min и :max символов.',
        'array'   => 'Длина массива :attribute должна быть между :min и :max элементов.',
    ],
    'boolean'              => 'Поле :attribute field must be true or false.',
    'confirmed'            => 'Поле :attribute confirmation does not match.',
    'date'                 => 'Поле :attribute is not a valid date.',
    'date_format'          => 'Поле :attribute does not match the format :format.',
    'different'            => 'Поле :attribute and :other must be different.',
    'digits'               => 'Поле :attribute must be :digits digits.',
    'digits_between'       => 'Поле :attribute must be between :min and :max digits.',
    'dimensions'           => 'Поле :attribute has invalid image dimensions.',
    'distinct'             => 'Поле :attribute field has a duplicate value.',
    'email'                => 'Поле :attribute must be a valid email address.',
    'exists'               => 'Поле selected :attribute is invalid.',
    'file'                 => 'Поле :attribute must be a file.',
    'filled'               => 'Поле :attribute field is required.',
    'image'                => 'Поле :attribute must be an image.',
    'in'                   => 'Поле selected :attribute is invalid.',
    'in_array'             => 'Поле :attribute field does not exist in :other.',
    'integer'              => 'Поле :attribute must be an integer.',
    'ip'                   => 'Поле :attribute must be a valid IP address.',
    'json'                 => 'Поле :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Поле :attribute may not be greater than :max.',
        'file'    => 'Поле :attribute may not be greater than :max килобайтов.',
        'string'  => 'Поле :attribute may not be greater than :max символов.',
        'array'   => 'Поле :attribute may not have more than :max items.',
    ],
    'mimes'                => 'Поле :attribute must be a file of type: :values.',
    'mimetypes'            => 'Поле :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Поле :attribute must be at least :min.',
        'file'    => 'Поле :attribute must be at least :min килобайтов.',
        'string'  => 'Поле :attribute must be at least :min символов.',
        'array'   => 'Поле :attribute must have at least :min items.',
    ],
    'not_in'               => 'Поле selected :attribute is invalid.',
    'numeric'              => 'Поле :attribute must be a number.',
    'present'              => 'Поле :attribute field must be present.',
    'regex'                => 'Поле :attribute не соответствует формату.',
    'required'             => 'Поле :attribute не заполнено.',
    'required_if'          => 'Поле :attribute field is required when :other is :value.',
    'required_unless'      => 'Поле :attribute field is required unless :other is in :values.',
    'required_with'        => 'Поле :attribute field is required when :values is present.',
    'required_with_all'    => 'Поле :attribute field is required when :values is present.',
    'required_without'     => 'Поле :attribute field is required when :values is not present.',
    'required_without_all' => 'Поле :attribute field is required when none of :values are present.',
    'same'                 => 'Поле :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'Поле :attribute must be :size.',
        'file'    => 'Поле :attribute must be :size килобайтов.',
        'string'  => 'Поле :attribute must be :size символов.',
        'array'   => 'Поле :attribute must contain :size items.',
    ],
    'string'               => 'Поле :attribute must be a string.',
    'timezone'             => 'Поле :attribute must be a valid zone.',
    'unique'               => 'Поле :attribute уже используется.',
    'uploaded'             => 'Поле :attribute failed to upload.',
    'url'                  => 'Поле :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | Поле following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
