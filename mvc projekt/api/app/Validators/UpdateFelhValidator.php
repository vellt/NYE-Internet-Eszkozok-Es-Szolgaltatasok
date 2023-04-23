<?php

namespace App\Validators;
use Illuminate\Http\Request;

class UpdateFelhValidator
{
    public static function rules(Request $request)
    {
        return [
            'vezeteknev'=>'nullable|string|min:1|max:50',
            'keresztnev'=>'nullable|string|min:1|max:50',
            'szuletesi_datum'=>'nullable|date',
            'email'=>'nullable|email:rfc,dns|max:62|unique:felhasznalok,email,'.$request->id, //sajátját figyelmen kívül hagyja
            'jelszo'=>'nullable|string|min:8|max:255',
            'nem'=>'nullable|boolean',
            'profilkep'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hirelevelezes'=>'nullable|boolean',
        ];
    }

    public static function messages()
    {
        return [
            'vezeteknev.string'=>'A vezetéknévnek \'string\' típusúnak kell lennie.',
            'vezeteknev.min'=>'A vezetéknévnek legalább 1 karakter hosszúnak kell lennie.',
            'vezeteknev.max'=>'A vezetéknév legfeljebb 50 karakter hosszú lehet.',
            'keresztnev.string'=>'A keresztnévnek \'string\' típusúnak kell lennie.',
            'keresztnev.min'=>'A keresztnévnek legalább 1 karakter hosszúnak kell lennie.',
            'keresztnev.max'=>'A keresztnév legfeljebb 50 karakter hosszú lehet.',
            'szuletesi_datum.date'=>'A születési dátumnak \'date\' típusúnak kell lennie.',
            'email.email'=>'Érvénytelen E-mail-cím.',
            'email.max'=>'Az E-mail-cím legfeljebb 62 karakter hosszú lehet.',
            'email.unique'=>'Ezzel az E-mail-címmel már regisztráltak.',
            'jelszo.string'=>'A jelszónak \'string\' típusúnak kell lennie.',
            'jelszo.min'=>'A jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'jelszo.max'=>'A jelszó legfeljebb 255 karakter hosszú lehet.',
            'nem.boolean'=>'A felhasználó nemének \'bool\' típusúnak kell lennie.',
            'profilkep.string'=>'A képnek \'image\' típusúnak kell lennie.',
            'profilkep.mimes'=>'Nem megfelelő formátum. Kérem törekedjen a következő formátumok használatára: jpeg,png,jpg,gif,svg.',
            'profilkep.max'=>'A kép legfeljebb 2048 kilobájt (2 MB) lehet.',
            'hirelevelezes.boolean'=>'A hírlevelezési mező értékének \'bool\' típusúnak kell lennie.',
        ];
    }
}
