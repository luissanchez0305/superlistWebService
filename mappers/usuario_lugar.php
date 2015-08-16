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
}
?>