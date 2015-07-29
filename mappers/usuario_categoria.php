<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Usuario_Categoria extends Mapper
{
    /**
     * Get Categorias on Usuario
     *
     * @return \Sector\Query
     */
    public function getByUsuario($id)
    {
        return $this->where(['usuarioid' => $id]);
    }	
	
    /**
     * Get Categorias on Usuario
     *
     * @return \Sector\Usuario_Categoria
     */
    public function getByUsuarioAndCategoria($uid, $cid)
    {
        return $this->where(['usuarioid' => $uid])->andWhere(['categoriaid' => $cid])->first();
    }	
}
?>