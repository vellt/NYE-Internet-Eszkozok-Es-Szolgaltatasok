<?php

namespace App\Validators;
use Illuminate\Http\Request;

class UpdateDokuValidator
{
    public static function rules(Request $request)
    {
        return [
            'utvonal'=>'nullable|string|min:1|max:40|unique:jogi_dokumentumok,utvonal,'.$request->utvonal, //sajátját figyelmen kívül hagyja
            'nev'=>'nullable|string|min:1|max:40',
            'leiras'=>'nullable',
        ];
    }

    public static function messages()
    {
        return [
            'utvonal.string'=>'Az útvonalnak \'string\' típusúnak kell lennie.',
            'utvonal.min'=>'A útvonalnak legalább 1 karakter hosszúnak kell lennie.',
            'utvonal.max'=>'A útvonal legfeljebb 40 karakter hosszú lehet.',
            'utvonal.unique'=>'Ez az útvonal már rögzíve van.',

            'nev.string'=>'A névnek \'string\' típusúnak kell lennie.',
            'nev.min'=>'A névnek legalább 1 karakter hosszúnak kell lennie.',
            'nev.max'=>'A név legfeljebb 40 karakter hosszú lehet.',
        ];
    }
}
