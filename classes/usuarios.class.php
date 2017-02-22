<?php
class Usuarios {

	public function getTotalUsuarios() {
		global $pdo;

		$sql = $pdo->query("SELECT COUNT(*) as c FROM usuarios");
		$row = $sql->fetch();

		return $row['c'];
	}

	public function cadastrar($nome, $email, $senha, $telefone) {
		global $pdo;
                //verifica se o usuario existe pelo o email
		$sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
		$sql->bindValue(":email", $email);
		$sql->execute();
               //fim da verificacao
		if($sql->rowCount() == 0) {
                        // se não retornar email cadastrado ele cadastra
			$sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha = :senha, telefone = :telefone");
			$sql->bindValue(":nome", $nome);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", md5($senha));
			$sql->bindValue(":telefone", $telefone);
			$sql->execute();

			return true;

		} else {
			return false;
		}

	}
        //faz o login do usuario no sistema
	public function login($email, $senha) {
		global $pdo;

		$sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", md5($senha));
		$sql->execute();
                 
		if($sql->rowCount() > 0) {
                    //achou o usuario salva o id do usuario na sessao
			$dado = $sql->fetch();
			$_SESSION['cLogin'] = $dado['id'];
			return true;
		} else {
			return false;
		}

	}














}
?>