<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El :attribute debe ser aceptado.',
    'accepted_if' => 'El :attribute debe ser aceptado cuando :other es :value.',
    'active_url' => 'El :attribute no es una url valida.',
    'after' => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El :attribute debe ser una fecha posterior o igual :date.',
    'alpha' => 'El :attribute solo puede contener letras.',
    'alpha_dash' => 'El :attribute solo puede contener letras, numeros, barras y guiones bajos.',
    'alpha_num' => 'El :attribute solo puede contener letras y numeros.',
    'array' => 'El :attribute debe ser un array.',
    'ascii' => 'El :attribute solo puede contener caracteres alfanumericos monobyte.',
    'before' => 'El :attribute debe ser una fecha antes de :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'array' => 'El :attribute debe tener entre :min y :max objetos.',
        'file' => 'El :attribute debe tener entre :min y :max kilobytes.',
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'string' => 'El :attribute debe tener entre :min y :max caracteres.',
    ],
    'boolean' => 'El :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmacion del :attribute no coincide.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El :attribute no es una fecha valida.',
    'date_equals' => 'El :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El :attribute no coincide con el formato :format.',
    'decimal' => 'El :attribute debe tener :decimal decimales.',
    'declined' => 'El :attribute debe ser rechazado.',
    'declined_if' => 'El :attribute dee ser rechazado cuando :other es :value.',
    'different' => 'El :attribute y :other deben ser distintos.',
    'digits' => 'El :attribute debe tener :digits digitos.',
    'digits_between' => 'El :attribute debe tener entre :min y :max digitos.',
    'dimensions' => 'El :attribute tiene dimensiones invalidas.',
    'distinct' => 'El campo :attribute tiene valores duplicados.',
    'doesnt_end_with' => 'El :attribute no puede acabar con: :values.',
    'doesnt_start_with' => 'El :attribute no puede empezar por: :values.',
    'email' => 'El :attribute debe ser un email valido.',
    'ends_with' => 'El :attribute debe acabar por: :values.',
    'enum' => 'El :attribute seleccionado es invalido.',
    'exists' => 'El :attribute seleccionado es invalido.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'array' => 'El :attribute debe teren mas de :value objetos.',
        'file' => 'El :attribute debe ser mayor de :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor de :value.',
        'string' => 'El :attribute debe ser mayor de :value caracteres.',
    ],
    'gte' => [
        'array' => 'El :attribute must have :value items or more.',
        'file' => 'El :attribute debe ser mayor o igual a :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor o igual a :value.',
        'string' => 'El :attribute debe ser mayor o igual a :value caracteres.',
    ],
    'image' => 'El :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado es invalido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El :attribute debe ser un numero entero.',
    'ip' => 'El :attribute debe ser una IP valida.',
    'ipv4' => 'El :attribute debe ser una IPv4 valida.',
    'ipv6' => 'El :attribute debe ser una IPv6 valida.',
    'json' => 'El :attribute debe ser una cadena JSON valida.',
    'lowercase' => 'El :attribute debe estar en minusculas.',
    'lt' => [
        'array' => 'El :attribute debe tener menos de :value objetos.',
        'file' => 'El :attribute debe ser menor de :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor de :value.',
        'string' => 'El :attribute debe ser menor de :value caracteres.',
    ],
    'lte' => [
        'array' => 'El :attribute no debe tener mas de :value objetos.',
        'file' => 'El :attribute debe ser menor o igual a :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor o igual a :value.',
        'string' => 'El :attribute debe ser menor o igual a :value caracteres.',
    ],
    'mac_address' => 'El :attribute debe ser una MAC valida.',
    'max' => [
        'array' => 'El :attribute no debe terner mas de :max objetos.',
        'file' => 'El :attribute no debe ser mayor de :max kilobytes.',
        'numeric' => 'El :attribute no debe ser mayor de :max.',
        'string' => 'El :attribute no debe ser mayor de :max caracteres.',
    ],
    'max_digits' => 'El :attribute no debe terner mas de :max digitos.',
    'mimes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'array' => 'El :attribute debe tener al menos :min objetos.',
        'file' => 'El :attribute debe ser al menos :min kilobytes.',
        'numeric' => 'El :attribute debe ser al menos :min.',
        'string' => 'El :attribute debe ser al menos :min caracteres.',
    ],
    'min_digits' => 'El :attribute debe tener al menos :min digitos.',
    'multiple_of' => 'El :attribute debe ser un multiplo de :value.',
    'not_in' => 'El :attribute seleccionado es invalido.',
    'not_regex' => 'El formato de :attribute es invalido.',
    'numeric' => 'El :attribute debe ser un numero.',
    'password' => [
        'letters' => 'El :attribute debe contener al menos una letra.',
        'mixed' => 'El :attribute debe contener una minuscula y mayuscula.',
        'numbers' => 'El :attribute debe contener un numero.',
        'symbols' => 'El :attribute debe contener un simbolo.',
        'uncompromised' => 'El :attribute ha aparecido en una filtracion de datos. Elige un nuevo :attribute.',
    ],
    'present' => 'El campo :attribute debe estar presente.',
    'prohibited' => 'El campo :attribute esta prohibido.',
    'prohibited_if' => 'El campo :attribute esta prohibido cuando :other es :value.',
    'prohibited_unless' => 'El campo :attribute esta prohibido a no ser que :other esta en :values.',
    'prohibits' => 'El campo :attribute prohibe :other de estar presente.',
    'regex' => 'El formato de :attribute es invalido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_if_accepted' => 'El campo :attribute es obligatorio cuando :other es accepted.',
    'required_unless' => 'El campo :attribute es obligatorio excepto si :other esta en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values esta presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values estan presente.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no esta presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando none of :values estan presente.',
    'same' => 'El :attribute y :other deben coincidir.',
    'size' => [
        'array' => 'El :attribute debe contener :size objetos.',
        'file' => 'El :attribute debe pesar :size kilobytes.',
        'numeric' => 'El :attribute debe ser :size.',
        'string' => 'El :attribute debe tener :size caracteres.',
    ],
    'starts_with' => 'El :attribute debe empezar por: :values.',
    'string' => 'El :attribute debe ser una cadena de texto.',
    'timezone' => 'El :attribute debe ser un huso horario valido.',
    'unique' => 'El :attribute ya ha sido usado.',
    'uploaded' => 'El :attribute ha fallado al ser subido.',
    'uppercase' => 'El :attribute debe estar en mayusculas.',
    'url' => 'El :attribute debe ser una URL valida.',
    'ulid' => 'El :attribute debe ser un ULID valido.',
    'uuid' => 'El :attribute debe ser un UUID valido.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
