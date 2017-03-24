<?php
	
	namespace App\Http\Controllers;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use App\User;
	use App\Social;
	use Auth;
	use Socialite;


	class SocialController extends Controller{

		public function __constuct(){
			$this->middleware('guest');
		}


		public function getSocialAuth($provider = null){
			if (!config("services.$provider")) abort('404');

			return Socialite::driver($provider)->redirect();
		}


		public function getSocialAuthCallback($provider = null){
			if ($user = Socialite::driver($provider)->user()) {
				if ($the_user = User::select()->where('email', '=', $user->email)->first()) {
					Auth::login($the_user);
					return redirect('home');
				}else{
					$new_user = new User;
					$new_user->name = $user->name;
					$new_user->email = $user->email;
					$new_user->perfiles = $user->avatar;
					$new_user->active = 1;
					$new_user->social = 1;
					$new_user->save();

					Auth::login($new_user);

					$social = new Social;
					$social->user_id = $new_user->id;
					$social->provider = $provider;
					$social->uid_provider = $user->id;
					$social->save();

					return redirect('home');
				}
			}else{
				return "Ha Ocurrido Un Error...!!!";
			}
		}
	}