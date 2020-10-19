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

    'accepted' => ':attribute onartu beharra dago.',
    'active_url' => ':attribute ez da baliozko URL bat.',
    'after' => ':attribute :date dataren ondorengo data bat izan behar da.',
    'after_or_equal' => ':attribute :date dataren berdina edo ondorengo data bat izan behar da.',
    'alpha' => ':attribute hizkiak besterik ezin ditu izan.',
    'alpha_dash' => ':attribute hizkiak, zenbakiak eta marrak besterik ezin ditu izan.',
    'alpha_num' => ':attribute hizkiak eta zenbakiak besterik ezin ditu izan.',
    'array' => ':attribute bilduma izan behar da.',
    'before' => ':attribute :date aurreko data izan behar da.',
    'before_or_equal' => ':attribute :date aurreko data edo data bera izan behar da.',
    'between' => [
        'numeric' => ':attribute :min eta :max artean egon behar da.',
        'file' => ':attribute-(e)k :min eta :max kilobyte arteko pisua izan behar du.',
        'string' => ':attribute-(e)k :min eta :max karaktere artean izan behar ditu.',
        'array' => ':attribute-(e)k :min eta :max arteko elementu kopurua izan behar du.',
    ],
    'boolean' => ':attribute-(r)en balioa egia edo gezurra izan behar da.',
    'confirmed' => ':attribute-(r)en berrespena ez dator bat.',
    'date' => ':attribute ez da baliozko data.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => ':attribute datak ez du :format formatua.',
    'different' => ':attribute eta :other ezberdinak izan behar dira.',
    'digits' => ':attribute-(e)k :digits digitu eduki behar ditu.',
    'digits_between' => ':attribute-(e)k :min eta :max arteko digitu kopurua eduki behar du.',
    'dimensions' => ':attribute irudiaren neurriak baliogabeak dira.',
    'distinct' => ':attribute-(e)k bikoiztutako balioa dauka.',
    'email' => ':attribute baliozko helbide elektronikoa izan behar da.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'Aukeratutako :attribute baliogabea da.',
    'file' => ':attribute fitxategi bat izan behar da.',
    'filled' => ':attribute derrigorrezkoa da.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => ':attribute irudi bat izan behar da.',
    'in' => ':attribute baliogabea da.',
    'in_array' => ':attribute ez da existizen :other-(e)n.',
    'integer' => ':attribute zenbaki osoa izan behar da.',
    'ip' => ':attribute baliozko IP helbidea izan behar da.',
    'ipv4' => ':attribute baliozko IPv4 helbidea izan behar da.',
    'ipv6' => ':attribute baliozko IPv6 helbidea izan behar da.',
    'json' => ':attribute baliozko JSON karaktere-katea izan behar da.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute ezin da :max baino handiagoa izan.',
        'file' => ':attribute ezin da :max kilobyte baino handiagoa izan.',
        'string' => ':attribute-(e)k ezin du :max karaktere baino gehiago eduki.',
        'array' => ':attribute-(e)k ezin du :max elementu baino gehiago eduki.',
    ],
    'mimes' => ':attribute :values motako fitxategia izan behar da.',
    'mimetypes' => ':attribute :values motako fitxategia izan behar da.',
    'min' => [
        'numeric' => ':attribute-(e)k gutxienez :min-(e)ko tamaina izan behar du.',
        'file' => ':attribute-(e)k gutxienez :min kilobyte izan behar ditu.',
        'string' => ':attribute-(e)k gutxienez :min karaktere izan behar ditu.',
        'array' => ':attribute-(e)k gutxienez :min elementu izan behar ditu.',
    ],
    'not_in' => 'Aukeratutako :attribute baliogabea da.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ':attribute zenbakizkoa izan behar da.',
    'password' => 'The password is incorrect.',
    'present' => ':attribute ezin da hutsik egon.',
    'regex' => ':attribute-(r)en formatoa baliogabea da.',
    'required' => ':attribute derrigorrezkoa da.',
    'required_if' => ':attribute derrigorrezkoa da :other :value denean.',
    'required_unless' => ':attribute derrigorrezkoa da :other :values-(e)n egon ezean.',
    'required_with' => ':attribute derrigorrezkoa da :values dagoenean.',
    'required_with_all' => ':attribute derrigorrezkoa da :values daudenean.',
    'required_without' => ':attribute derrigorrezkoa da :values ez dagoenean.',
    'required_without_all' => ':attribute derrigorrezkoa da :values ez daudenean.',
    'same' => ':attribute eta :other bat etorri behar dira.',
    'size' => [
        'numeric' => ':attribute-(e)k :size tamaina izan behar du.',
        'file' => ':attribute-(e)k :size kilobyte izan behar behar ditu.',
        'string' => ':attribute-(e)k :size karaktere izan behar ditu.',
        'array' => ':attribute-(e)k :size elementu izan behar ditu.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => ':attribute eremua testu bat izan behar da.',
    'timezone' => ':attribute baliozko ordu-eremua izan behar da.',
    'unique' => ':attribute eremua erabilita dago.',
    'uploaded' => ':attribute kargatzerakoan huts egin du.',
    'url' => ':attribute-(r)en formatua baliogabea da.',
    'uuid' => 'The :attribute must be a valid UUID.',

    '404' => 'Ez dugu aurkitu bilatzen duzuna',
    '500' => 'Arazo bat dago. Saiatu beranduago mesedez',
    '403' => 'Ez duzu baimenik hau ikusteko',
    '503' => 'Arazo bat dago. Saiatu beranduago mesedez',


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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => trans('basics::auth.name'),
        'email' => trans('basics::auth.email'),
        'password' => trans('basics::auth.password'),
    ],
];
