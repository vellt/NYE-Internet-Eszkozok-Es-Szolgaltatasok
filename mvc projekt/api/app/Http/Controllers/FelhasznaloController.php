<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Felhasznalo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


use App\Validators\StoreFelhValidator;
use App\Validators\UpdateFelhValidator;
use App\Validators\UpdatePwdValidator;

class FelhasznaloController extends Controller
{
    public function store(Request $request){
        try{
            // we validate the data
            $request->validate(StoreFelhValidator::rules(),StoreFelhValidator::messages());

            // elkészítjük az új random címét a képnek ha létezik
            $kepNeve=($request->hasFile('profilkep'))?($kepNeve= Str::random(32) . '.' .  ($request->file('profilkep'))->getClientOriginalExtension()):null;

            // we created todo and saved in the database
            $felhasznalo=Felhasznalo::create([
                'vezeteknev'=>$request['vezeteknev'],
                'keresztnev'=>$request['keresztnev'],
                'szuletesi_datum'=>$request['szuletesi_datum'],
                'email'=>$request['email'],
                'jelszo_hash'=> Hash::make(config('app.salt1').($request['jelszo']).config('app.salt2')),
                'nem'=>$request['nem'],
                'profilkep'=>$kepNeve,
                'hirelevelezes'=>$request['hirelevelezes'],
                ]);

            // elmentjük ha létezik
            if ($request->hasFile('profilkep')) Storage::disk('public')->put($kepNeve, file_get_contents($request->file('profilkep')));

            // return json, NOT view
            return response()->json([
                'status'=>true,
                'message'=>'Felhasználó rögzítve.',
                'errors'=>null,
                'data'=>Felhasznalo::find($felhasznalo['id']),
                ], 201); // add status

        }catch(\Illuminate\Validation\ValidationException $th){
            return response()->json([
                'status'=>false,
                'message'=>'Az adatok nem megfelelőek. Kérem ellenőrízze azokat! ('.($th->validator->errors()->count()).' hiba)',
                'errors'=>$th->validator->errors(),
                'data'=>null,
                ]);
        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }

    public function index(){
        try{
            $felhasznalok=Felhasznalo::all();

            return response()->json([
                'status'=>true,
                'message'=>'Az adatok sikeresen lekérdezve.',
                'errors'=>null,
                'data'=>$felhasznalok,
                ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }

    }

    public function show($id){
        try{
            $felhasznalo=Felhasznalo::find($id);

            if($felhasznalo){
                return response()->json([
                    'status'=>true,
                    'message'=>'Az adatok sikeresen lekérdezve.',
                    'errors'=>null,
                    'data'=>$felhasznalo,
                    ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Felhasználó nem létezik.',
                    'errors'=>null,
                    'data'=>null,
                    ],404);
            }


        }
        catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }

    public function update(Request $request, $id){
        try{
            $felhasznalo=Felhasznalo::find($id);
            if($felhasznalo){
                // we validate the data
                $request->validate(UpdateFelhValidator::rules($request),UpdateFelhValidator::messages());
                $kepNeve=($request->hasFile('profilkep'))?(Str::random(32) . '.' .  ($request->file('profilkep'))->getClientOriginalExtension()):null;

                $data = [];
                if ($request->filled('vezeteknev')) {
                    $data['vezeteknev'] = $request['vezeteknev'];
                }
                if ($request->filled('keresztnev')) {
                    $data['keresztnev'] = $request['keresztnev'];
                }
                if ($request->filled('szuletesi_datum')) {
                    $data['szuletesi_datum'] = $request['szuletesi_datum'];
                }
                if ($request->filled('email')) {
                    $data['email'] = $request['email'];
                }
                if ($request->filled('nem')) {
                    $data['nem'] = $request['nem'];
                }
                if ($request->hasFile('profilkep')) {
                    $data['profilkep'] = $kepNeve;
                }
                if ($request->filled('hirelevelezes')) {
                    $data['hirelevelezes'] = $request['hirelevelezes'];
                }

                if($data!=[]){
                    // return $data;
                    $felhasznalo->update($data);

                    // elmentjük ha létezik
                    if ($request->hasFile('profilkep')) Storage::disk('public')->put($kepNeve, file_get_contents($request->file('profilkep')));

                    return response()->json([
                        'status'=>true,
                        'message'=>'Az adatok sikeresen frissítve.',
                        'errors'=>null,
                        'data'=>$felhasznalo,
                        ]);

                }else{
                    return response()->json([
                    'status'=>false,
                    'message'=>'Nincs frissítendő adat megadva.',
                    'errors'=>null,
                    'data'=>null,
                    ],400);
                }
            } else {
                return response()->json([
                    'status'=>false,
                    'message'=>'Felhasználó nem létezik.',
                    'errors'=>null,
                    'data'=>null,
                    ],404);
            }

            // elkészítjük az új random címét a képnek ha létezik

        }
        catch(\Illuminate\Validation\ValidationException $th){
            return response()->json([
                'status'=>false,
                'message'=>'Az adatok nem megfelelőek. Kérem ellenőrízze azokat! ('.($th->validator->errors()->count()).' hiba)',
                'errors'=>$th->validator->errors(),
                'data'=>null,
                ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }

    public function delete($id){
        try{
            $felhasznalo=Felhasznalo::find($id);
            $pictureName=$felhasznalo['profilkep'];
            if($felhasznalo){
                $felhasznalo->delete();
                if($pictureName) Storage::disk('public')->delete($pictureName);

                return response()->json([
                    'status'=>true,
                    'message'=>'Felhasználó törölve.',
                    'errors'=>null,
                    'data'=>null,
                    ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Felhasználó nem létezik.',
                    'errors'=>null,
                    'data'=>null,
                    ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }
    }

    public function updatePassword(Request $request, $id)
    {
        try{
            $request->validate(UpdatePwdValidator::rules(),UpdatePwdValidator::messages());

            // Megkeressük a felhasználót az ID alapján
            $felhasznalo=Felhasznalo::find($id);
            if($felhasznalo){

                // Ellenőrizzük a jelenlegi jelszót
                if (!Hash::check(config('app.salt1').($request->aktualis_jelszo).config('app.salt2'), $felhasznalo->jelszo)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'A jelenlegi jelszó helytelen.',
                        'errors' => null,
                        'data' => null,
                    ], 401);
                }

                // Frissítjük a felhasználó jelszavát
                $felhasznalo->update([
                    'jelszo_hash' => Hash::make(config('app.salt1').($request->uj_jelszo).config('app.salt2')),
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Az új jelszó sikeresen frissítve lett.',
                    'errors' => null,
                    'data' => null,
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'message'=>'Felhasználó nem létezik.',
                    'errors'=>null,
                    'data'=>null,
                    ]);
            }

        }
        catch(\Illuminate\Validation\ValidationException $th){
            return response()->json([
                'status'=>false,
                'message'=>'Az adatok nem megfelelőek. Kérem ellenőrízze azokat! ('.($th->validator->errors()->count()).' hiba)',
                'data'=>null,
                'errors'=>$th->validator->errors(),
                ]);
        }
        catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>'Valami nagyon félre ment!',
                'errors'=>null,
                'data'=>null,
                ],500);
        }

    }


}
