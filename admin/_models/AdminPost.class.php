<?php

/**
 * @author Daniel Lima
 */
class AdminPost {

    private $Data;
    private $Post;
    private $Error;
    private $Result;

    //Tabela
    const Entity = 'post';

    public function ExeCreate(array $Data) {
        $this->Data = $Data;

        //Guarda Campos não obrigatórios
        $Video = $this->Data['video'];
        unset($this->Data['video']);

        if (in_array('', $this->Data)):
            $this->Error = ["Erro ao cadastrarar. Preencha todos os campos corretamente", WS_INFOR];
            $this->Result = false;
        else:
            //Recupera Campos não obrigatórios
            $this->Data['video'] = $Video;

            $this->setData();
            $this->setName();

            if ($this->Data['capa']):
                $upload = new Upload();
                $upload->Image($this->Data['capa'], $this->Data['post']);
            endif;

            if (isset($upload) && $upload->getResult()):
                $this->Data['capa'] = $upload->getResult();
                $this->Create();
            else:
                $this->Data['capa'] = null;
                $this->Create();
            endif;
        endif;
    }

    public function ExeUpdate($PostId, array $Data) {
        $this->Post = (int) $PostId;
        $this->Data = $Data;

        $Video = $this->Data['video'];
        unset($this->Data['video']);

        if (in_array('', $this->Data)):
            $this->Error = ["Para atualizar este post, preencha todos os campos corretamente", WS_ALERT];
            $this->Result = false;
        else:
            $this->Data['video'] = $Video;

            $this->setData();
            $this->setName();

            if (is_array($this->Data['capa'])):
                $readCapa = new Read;
                $readCapa->ExeRead("post", "WHERE idpost=:idpost", "idpost={$this->Post}");
                $capa = '../uploads/' . $readCapa->getResult()[0]['capa'];
                if (file_exists($capa) && !is_dir($capa)):
                    unlink($capa);
                endif;

                $uploadCapa = new Upload();
                $uploadCapa->Image($this->Data['capa'], $this->Data['post']);
            endif;

            if (isset($uploadCapa) && $uploadCapa->getResult()):
                $this->Data['capa'] = $uploadCapa->getResult();
                $this->Update();
            else:
                unset($this->Data['capa']);
                $this->Update();
            endif;


        endif;
    }

    public function ExeDelete($PostId) {
        $this->Post = (int) $PostId;

        $ReadPost = new Read();
        $ReadPost->ExeRead(self::Entity, "WHERE idpost=:idpost", "idpost={$this->Post}");

        if (!$ReadPost->getResult()):
            $this->Error = ['O post que você tentou deletar não existe', WS_ERROR];
        else:
            $PostDelete = $ReadPost->getResult()[0];
            if (file_exists('../uploads/' . $PostDelete['capa']) && !is_dir('../uploads/' . $PostDelete['capa'])):
                unlink('../uploads/' . $PostDelete['capa']);
            endif;

            $readGaleria = new Read();
            $readGaleria->ExeRead("galeria", "WHERE idpost=:idpost", "idpost={$this->Post}");
            if ($readGaleria->getResult()):
                foreach ($readGaleria->getResult() as $gbdel):
                    if (file_exists('../uploads/' . $gbdel['foto']) && !is_dir('../uploads/' . $gbdel['foto'])):
                        unlink('../uploads/' . $gbdel['foto']);
                    endif;
                endforeach;
            endif;

            $deleta = new Delete();
            $deleta->ExeDelete("galeria", "WHERE idpost=:idpost", "idpost={$this->Post}");
            $deleta->ExeDelete(self::Entity, "WHERE idpost=:idpost", "idpost={$this->Post}");
            
            $this->Error = ["O post <b>{$PostDelete['post_nome']}</b> foi removido com sucesso do sistema", WS_ACCEPT];
            $this->Result = true;
            
        endif;
    }

    public function ExeStatus($PostId, $PostStatus) {
        return true;
    }

    public function gbSend(array $Images, $PostId) {
        $this->Post = (int) $PostId;
        $this->Data = $Images;

        $ImageName = new Read();
        $ImageName->ExeRead("post", "WHERE idpost=:idpost", "idpost={$this->Post}");

        if (!$ImageName->getResult()):
            $this->Error = ['Erro ao enviar galeria. O índice {} não foi encontrado no banco', WS_ERROR];
            $this->Result = false;
        else:
            $ImageName = $ImageName->getResult()[0]['post'];

            $gbFiles = array();
            $gbCount = count($this->Data['tmp_name']);
            $gbKeys = array_keys($this->Data);

            for ($gb = 0; $gb < $gbCount; $gb++):
                foreach ($gbKeys as $Keys):
                    $gbFiles[$gb][$Keys] = $this->Data[$Keys][$gb];
                endforeach;
            endfor;

            $gbSend = new Upload();
            $i = 0;
            $u = 0;

            foreach ($gbFiles as $gbUpload):
                $i++;
                $imgName = "{$ImageName}-gb-{$this->Post}-" . (substr(md5(time() + $i), 0, 5));
                $gbSend->Image($gbUpload, $imgName);

                if ($gbSend->getResult()):
                    $gbImage = $gbSend->getResult();
                    $gbCreate = ['idpost' => $this->Post, 'foto' => $gbImage, 'data' => date('Y-m-d H:i:s')];
                    $insertGb = new Create();
                    $insertGb->ExeCreate('galeria', $gbCreate);
                endif;
            endforeach;

            if ($u >= 1):
                $this->Error = ["Galeria atualizada. Foram enviadas {$u} imagens para a galeria deste post", WS_INFOR];
                $this->Result = true;
            endif;

        endif;
    }

    public function gbRemove($GbImageId) {
        $this->Post = (int) $GbImageId;
        $readGb = new Read();
        $readGb->ExeRead("galeria", "WHERE idgaleria=:idgaleria", "idgaleria={$this->Post}");

        if ($readGb->getResult()):
            $Imagem = '../uploads/' . $readGb->getResult()[0]['foto'];
            if (file_exists($Imagem)):
                unlink($Imagem);
            endif;

            $Delete = new Delete();
            $Delete->ExeDelete("galeria", "WHERE idgaleria=:idgaleria", "idgaleria={$this->Post}");
            if ($Delete->getResult()):
                $this->Error = ["A imagem foi removida com sucesso da galeria", WS_ACCEPT];
                $this->Result = true;
            endif;
        endif;
    }

    function getResult() {
        return $this->Result;
    }

    function getError() {
        return $this->Error;
    }

    //PRIVATES 

    private function setData() {
        $Capa = $this->Data['capa'];
        $Conteudo = $this->Data['conteudo'];
        unset($this->Data['capa'], $this->Data['conteudo']);

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['post'] = Check::Name($this->Data['post_nome']);
        $this->Data['publicacao'] = Check::Data($this->Data['publicacao']);
        $this->Data['destaque_datainicial'] = Check::Data($this->Data['destaque_datainicial']);
        $this->Data['destaque_datafinal'] = Check::Data($this->Data['destaque_datafinal']);

        $this->Data['capa'] = $Capa;
        $this->Data['conteudo'] = $Conteudo;

        $this->Data['idsite'] = $_SESSION['userlogin']['site'];
    }

    private function setName() {
        $Where = (isset($this->Post) ? "idpost != {$this->Post} AND " : "");

        $readName = new Read();
        $readName->ExeRead(self::Entity, "WHERE {$Where} post = :t", "t={$this->Data['post']}");

        if ($readName->getResult()):
            $this->Data['post'] = $this->Data['post'] . '-' . $readName->getRowCount();
        endif;
    }

    private function Create() {
        $cadastra = new Create();
        $cadastra->ExeCreate(self::Entity, $this->Data);
        if ($cadastra->getResult()):
            $this->Error = ["Post {$this->Data['post_nome']} cadastrado com sucesso", WS_ACCEPT];
            $this->Result = $cadastra->getResult();
        endif;
    }

    private function Update() {
        $Update = new Update();
        $Update->ExeUpdate(self::Entity, $this->Data, "WHERE idpost=:idpost", "idpost={$this->Post}");
        if ($Update->getResult()):
            $this->Error = ["Post <b>{$this->Data['post_nome']}</b> foi atualizado com sucesso", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}
