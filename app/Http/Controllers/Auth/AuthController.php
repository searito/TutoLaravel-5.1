<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Mail;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    
    protected $redirectPath = 'user';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function postRegister(Request $request){

        $rules = [
            'name' => 'required|min:3|max:16|regex:/^[a-zA-ZñÑáéíóúäëïöü\s]+$/i',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:18|confirmed',
        ];

        $messages = [
            'name.required' => 'El campo es requerido',
            'name.min' => 'El mínimo de caracteres permitidos son 3',
            'name.max' => 'El máximo de caracteres permitidos son 16',
            'name.regex' => 'Sólo se aceptan letras',
            'email.required' => 'El campo es requerido',
            'email.email' => 'El formato de email es incorrecto',
            'email.max' => 'El máximo de caracteres permitidos son 255',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El campo es requerido',
            'password.min' => 'El mínimo de caracteres permitidos son 6',
            'password.max' => 'El máximo de caracteres permitidos son 18',
            'password.confirmed' => 'Los passwords no coinciden',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("auth/register")->withErrors($validator)->withInput();
        }else{
            $user = new User;
            $data['name'] = $user->name = $request->name;
            $data['email'] = $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->remember_token = str_random(100);
            $data['confirm_token'] = $user->confirm_token = str_random(100);
            $user->save();

            Mail::send('emails.register', ['data' => $data], function($mail) use($data){
                $mail->subject('Confirmación De Cuenta');
                $mail->to($data['email'], $data['name']);
            });

            return redirect("auth/register")->with("message", "Hemos Enviado Un Enlace De Confirmación A Su Cuenta De Correo Electrónico.");
        }
    }

    public function confirmRegister($email, $confirm_token){
        $user = new User;
        $the_user = $user->select()->where('email', '=', $email)->where('confirm_token', '=', $confirm_token)->get();

        if (count($the_user) > 0) {
            $active = 1;
            $confirm_token = str_random(100);
            $user->where('email', '=', $email)->update(['active' => $active, 'confirm_token' => $confirm_token]);

            return redirect('auth/register')->with('message', 'Enhorabuena '.$the_user[0]['name'.' Ya Puedes Iniciar Sesión.']);
        }else{
            return redirect('');
        }
    }


    public function postLogin(Request $request){
            
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'active' => 1, 'social' => 0,], $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }else{
            $rules = ['email' => 'required|email', 'password' => 'required',];
            
            $messages = ['email.required' => 'El Campo Es Obligatorio',
                         'email.email' => 'Tiene Que Ser Dirección De Correo Válida',
                         'password.required' => 'Este Campo Es Obligatorio',
                        ];

            $validator = Validator::make($request->all(), $rules, $messages);

            return redirect('auth/login')->withErrors($validator)->withInput()->with('message', 'Error Al Iniciar Sesión');
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    
    /*
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    /*
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }*/
}