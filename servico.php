<?php
    
    date_default_timezone_set("America/Sao_Paulo");
    class Servico{
        private $conexao = null;
        private $post = null;

        function __construct($conexao, $post){
            $this->conexao = $conexao;
            $this->post = $post;
        }

        //Retorna todos os posts de um usuario
        public function read($id_usuario){
            $query = 'SELECT p.titulo,p.tempo_planejado,p.tempo_estudado,p.id_post from tb_usuario as u  INNER JOIN tb_post as p on(u.id_usuario = p.id_usuario) where p.id_usuario = ? && p.ativo = 1;';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$id_usuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //Retorna todos os updates de um usuario
        public function readUpd($id_usuario){
            
            
            $query = 'SELECT sum(u.tempo_upd) as tempo_upd, u.date_upd, p.titulo from tb_upd as u LEFT JOIN tb_post as p on(u.id_post = p.id_post) where u.id_usuario = :id group by u.date_upd, p.titulo';
            
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue("id",$id_usuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //Deleta um post
        public function deletar($id_post){
            $query = 'update tb_post set ativo = 0 where id_post = ?;';
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

        public function adicionarUpd($id_post,$id_usuario,$tempo){
            $data = date("Y-m-d");
            $query = 'insert into tb_upd(id_post, id_usuario, tempo_upd, date_upd) values(?,?,?,?)';
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(1,$id_post);
            $stmt->bindValue(2,$id_usuario);
            $stmt->bindValue(3,$tempo);
            $stmt->bindValue(4,$data);
            $stmt->execute();
        }
    }
?>