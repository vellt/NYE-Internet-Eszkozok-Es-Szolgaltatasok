<?php

namespace App\Validators;
use Illuminate\Http\Request;

class StoreDokuValidator
{
    public static function rules()
    {
        return [
            'utvonal'=>'required|string|min:1|max:40|unique:jogi_dokumentumok,utvonal', //sajátját figyelmen kívül hagyja
            'nev'=>'required|string|min:1|max:40',
            'leiras'=>'required',
        ];
    }

    public static function messages()
    {
        return [
            'utvonal.required'=>'Az útvonal beküldése kötelező.',
            'utvonal.string'=>'Az útvonalnak \'string\' típusúnak kell lennie.',
            'utvonal.min'=>'A útvonalnak legalább 1 karakter hosszúnak kell lennie.',
            'utvonal.max'=>'A útvonal legfeljebb 40 karakter hosszú lehet.',
            'utvonal.unique'=>'Ez az útvonal már rögzíve van.',

            'nev.required'=>'A név beküldése kötelező.',
            'nev.string'=>'A névnek \'string\' típusúnak kell lennie.',
            'nev.min'=>'A névnek legalább 1 karakter hosszúnak kell lennie.',
            'nev.max'=>'A név legfeljebb 40 karakter hosszú lehet.',

            'leiras.required'=>'A leírás beküldése kötelező.',
        ];
    }
}
