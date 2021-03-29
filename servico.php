<?php
    class Servico{
        private $conexao = null;
        private $post = null;

        function __construct($conexao, $post){
            $this->conexao = $conexao;
            $this->post = $post;
        }
        //Retorna todos os posts
        public function read($id_usuario){
            $query = 'SELECT p.titulo,p.tempo_planejado,p.tempo_estudado,p.id_post from tb_usuario as u  INNER JOIN tb_post as p on(u.id_usuario = p.id_usuario) where p.id_usuario = ?;';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$id_usuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //Deleta um post
        public function deletar($id_post){
            $query = 'DELETE FROM tb_post where id_post = ?;';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$id_post);
            $stmt->execute();
        }

        //Retorna o id de um usuário, retorna -1 caso usuario não existe
        public function readUsuarios($email,$senha){                     
            $query = "Select id_usuario from tb_usuario where email = ? && senha = ?";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$email);
            $stmt->bindValue(2,$senha);
            $stmt->execute();
            $retorno = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $retorno[0]->id_usuario ? $retorno[0]->id_usuario : -1;
        }

        private function emailExiste($email){
            $query = 'Select id_usuario from tb_usuario where email = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$email);
            $stmt->execute();
            return $stmt->rowCount();
        }

        public function inserirEmail($email,$senha){
            
            $query = 'insert into tb_usuario(email,senha) values(?,?)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$email);
            $stmt->bindValue(2,$senha);
            $stmt->execute();
            
        }

        public function inserirPost(){
            $query = 'insert into tb_post(id_usuario,titulo,tempo_planejado,tempo_estudado) values(?,?,?,0)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$this->post->idUsuario);
            $stmt->bindValue(2,$this->post->titulo);
            $stmt->bindValue(3,$this->post->tempoPlanejado);
            $stmt->execute();
        }

        public function update($tempoPlanejado, $tempoEstudado, $id){
            $query = 'update tb_post set tempo_planejado = ?,tempo_estudado = ? where id_post = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$tempoPlanejado);
            $stmt->bindValue(2,$tempoEstudado);
            $stmt->bindValue(3,$id);
            $stmt->execute();
        }

        public function adicionarTempo($id_post,$tempo){
            $query = 'update tb_post set tempo_estudado = tempo_estudado + ? where id_post = ?';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(2,$id_post);
            $stmt->bindValue(1,$tempo);
            $stmt->execute();
        }
    }
?>