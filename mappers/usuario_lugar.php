<?php
namespace Entity\Mapper;
use Spot\Mapper;

class Usuario_Lugar extends Mapper
{
    /**
     * Get Usuarios_Lugar by Usuario
     *
     * @return \Sector\Usuario_Lugar
     */
    public function getByUser($id)
    {
        return $this->where(['usuarioid' => $id]);
    }	
	
    /**
     * Get Usuarios_Lugar by Usuario and Lugar
     *
     * @return \Sector\Usuario_Lugar
     */
    public function getByUserAndList($uid,$lid)
    {
        return $this->where(['usuarioid' => $uid])->andWhere(['lugarid' => $lid])->first();
    }	
}
?>