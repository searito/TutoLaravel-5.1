<?php 
	namespace App\Http\Requests;
	use App\Http\Requests\Request;  #### IMPORTANDO LA CLASE REQUEST  ####


	class MiFormulario extends Request{
		protected $redirect = "home/miformulario";

		public function rules(){
			return [
				'nombre' => 'required|min:3|max:15|regex:/^[a-zA-ZáéíóúñÑ]+$/i',
				'email' => 'required|email',
			];
		}

		public function messages(){
			return [
				'nombre.required' => 'El Campo Nombre Es Requerido',
				'nombre.min' => 'El Mínimo Permitido Son 3 Caracteres',
				'nombre.max' => 'El Máximo Permitido Son 15 Caracteres',
				'nombre.regex' => 'Sólo Se Aceptan Letras',
				'email.required' => 'El Campo Email Es Obligatorio',
				'email.email' => 'El Formato De Email Es Incorrecto'
			];
		}

		public function response(array $errors){
			if ($this->ajax()) {
				return response()->json($errors, 200);
			}else{
				return redirect($this->redirect)->withErrors($errors, 'formulario')->withInput();
			}
		}

		public function authorize(){
			return true;
		}
	}
?>