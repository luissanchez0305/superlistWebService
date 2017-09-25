<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Usuario_Lista extends Mapper
{
    /**
     * Get Usuarios_Lista by Usuario
     *
     * @return \Sector\Usuario_Lista
     */
    public function getByUser($id)
    {
        return $this->where(['usuarioid' => $id]);
    }	
	
    /**
     * Get Usuarios_Lista by Usuario and Lista
     *
     * @return \Sector\Usuario_Lista
     */
    public function getByUserAndList($uid,$lid)
    {
        return $this->where(['usuarioid' => $uid])->andWhere(['listaid' => $lid])->first();
    }	
}
?>