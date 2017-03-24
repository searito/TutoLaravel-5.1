<?php 
	namespace App\Http\Controllers;
	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use App\Http\Requests\MiFormulario;
	use Validator;
	use App\Comments;
	use App\User;


	class HomeController extends Controller{

		public function home(){
			return View('home.home');
		}

		public function search($search){
			$search = urldecode($search);
			$comments = Comments::select()
									->where('comment', 'LIKE', '%'.$search.'%')
									->orderBy('id', 'desc')
									->paginate(7);

			if (count($comments) == 0) {
				return View('home.search')->with('message', 'No Hay Coincidencias')->with('search', $search);
			}else{
				return View('home.search')->with('comments', $comments)->with('search', $search);
			}
		}


		public function user($id){
			$user = User::select()->where('id', '=', $id)->first();

			if (count($user) == 0) {
				return redirect()->back();
			}else{
				return View('home.user')->with('user', $user);
			}
		}

		public function getId($id){
			return "El Id Es Igual A ".$id;
		}

		public function GetIds($id1, $id2){
			return "El ID 1 Es Igual A ".$id1.", Mientras Que ID 2 Es Igual A ".$id2;
		}

		public function ShowView(){
			$msg = "Aprendiendo Laravel 5";
			$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
			return view('home.showView', ['msg' => $msg, 'array' => $array]);
		}

		public function Form(Request $request){
			if ($request->isMethod("post") && $request->has("name")) {
				$name = $request->input("name");
			}else{
				$name = "";
			}
			return view('home.form', ["name" => $name]);
		}

		//--------------------- CREANDO ACCION PARA CARGAR UNA VISTA DETERMINADA -----------------------//

		public function miFormulario(){
			return View("home.miformulario");
		}

		public function validarMiFormulario(MiFormulario $formulario){
		
			####  AQUI SE USA UNA CLASE QUE ESTÁ EN APP/HTTP/REQUEST/MiFormulario.php  ####

			$validator = Validator::make($formulario->all(), $formulario->rules(), $formulario->messages());

			if ($validator->valid()) {
				
				if ($formulario->ajax()) {
					return response()->json(["valid" => true], 200);
				}else{
				return redirect('home/miformulario')->with('message', 'Formulario Enviado Éxitosamente...');
				}
			}
		}
	}
?>