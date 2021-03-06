<?php
/**
 * This file is part of XNova:Legacies
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-2010, Grégory PLANCHAT <g.planchat at gmail.com>
 * All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

/**
 * Default Object/Relational Mapping objetct
 *
 * @uses        Nova_Core_Orm_DataMapper
 *
 * @access      public
 * @author      gplanchat
 * @category    Nova
 * @package     Core
 * @subpackage  Orm
 */
class Nova_User_Model_Entity_Authentication_DataMapper
    extends Nova_Core_Model_Orm_DataMapper
{
    public function save(Nova_Core_Bo_EntityAbstract $boInstance)
    {
        return array_intersect_key(
            $boInstance->getData(),
            array(
                $boInstance->getIdFieldName() => NULL,
                'server_salt' => NULL,
                'server_hash' => NULL,
                ));
    }

    public function load(Nova_Core_Bo_EntityAbstract $boInstance, Array $daoData)
    {
        $boInstance->setData($daoData);

        return $boInstance;
    }
}
