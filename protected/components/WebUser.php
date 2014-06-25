<?php

class WebUser extends CWebUser {

    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params = array()) {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $role = $this->getState("Rol");
        if ($role === 'Administrador') {
            return true; // admin role has access to everything
        }
        /**
         * chequeo si es usuario asignado al proyecto
         */
       /* if ($operation === 'usuarioVinculadoProyecto') {
          
            if (isset($params['Proyecto'])) {
                $proyecto = $params['Proyecto'];
                if (isset($params['Funcion'])) {
                    $idFuncion = $params['Funcion'];
                } else {
                    $idFuncion = null;
                }
                $idUsuario = $this->getState('idUsuario');
                return $proyecto->usuarioVinculado($idUsuario, $idFuncion);
            }
        }*/
                
        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }

}
