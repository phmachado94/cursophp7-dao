<?php  

	class Usuario{

		private $id_usuario;
		private $login;
		private $senha;
		private $data_cad;


		//Inicio - métodos mágicos
		public function __construct($login = "", $senha = ""){
			$this->setLogin($login);
			$this->setSenha($senha);
		}

		public function __toString(){
			return json_encode(array(
				"id_usuario" => $this->getIdUsuario(),
				"login" => $this->getLogin(),
				"senha" => $this->getSenha(),
				"data_cad" => $this->getDataCad()->format("d/m/Y H:i:s")
				));
		}
		//Fim - métodos mágicos

		//Inicio - getters e setters
		public function getIdUsuario(){
			return $this->id_usuario;
		}

		public function setIdUsuario($id_usuario){
			$this->id_usuario = $id_usuario;
		}

		public function getLogin(){
			return $this->login;
		}

		public function setLogin($login){
			$this->login = $login;
		}

		public function getSenha(){
			return $this->senha;
		}

		public function setSenha($senha){
			$this->senha = $senha;
		}

		public function getDataCad(){
			return $this->data_cad;
		}

		public function setDataCad($data_cad){
			$this->data_cad = $data_cad;
		}
		//Fim - getters e setters

		public function loadById($id){
			$sql = new Sql();

			$result = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID", array(
					":ID" => $id
				));

			if (count($result) > 0) {
				
				$this->setData($result[0]);
			}
		}

		public static function getList(){

			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY login");
		}

		public static function searchUser($login){
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE login LIKE :SEARCH ORDER BY login", array(
					":SEARCH" => "%" . $login . "%"
				));
		}

		public function login($login, $password){
			$sql = new Sql();

			$result = $sql->select("SELECT * FROM tb_usuarios WHERE login = :LOGIN && senha = :PASSWORD", array(
					":LOGIN" => $login,
					":PASSWORD" => $password
				));

			if (count($result) > 0) {

				$this->setData($result[0]);
			} else {
				throw new Exception("Login e/ou senha inválidos");
				
			}
		}

		public function setData($data){
			$this->setIdUsuario($data['id_usuario']);

			$this->setLogin($data['login']);

			$this->setSenha($data['senha']);

			$this->setDataCad(new DateTime($data['data_cad']));
		}

		public function insert(){
			$sql = new Sql();

			$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
					":LOGIN" => $this->getLogin(),
					":PASSWORD" => $this->getSenha()
				));

			if (count($result) > 0) {
				$this->setData($result[0]);
			}
		}

		public function update($login, $password){
			$this->setLogin($login);
			$this->setSenha($password);

			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET login = :LOGIN, senha = :PASSWORD WHERE id_usuario = :ID", array(
					":LOGIN" => $this->getLogin(),
					":PASSWORD" => $this->getSenha(),
					":ID" => $this->getIdUsuario()
				));
		}
	}

?>

