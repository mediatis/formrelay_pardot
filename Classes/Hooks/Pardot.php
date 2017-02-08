<?php
namespace Mediatis\FormrelayPardot\Hooks;

/***************************************************************
*  Copyright notice
*
*  (c) 2009 Michael Vöhringer (mediatis AG) <voehringer@mediatis.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Plugin Send form data to SourceFoce.com
 *
 * @author  Michael Vöhringer (mediatis AG) <voehringer@mediatis.de>
 * @package TYPO3
 * @subpackage  formrelay_pardot
 */
class Pardot extends \Mediatis\Formrelay\AbstractFormrelayHook implements \Mediatis\Formrelay\DataProcessorInterface
{
    protected function isEnabled()
    {
        return $this->conf['enabled'];
    }

    protected function getDispatcher()
    {
        $cookies = array();
        foreach ($_COOKIE as $key => $value) {
            if (preg_match('/^visitor_id[0-9]+$/', $key)) {
                $cookies[$key] = $value;
            }
        }
        return new \Mediatis\Formrelay\DataDispatcher\Curl($this->conf['pardotUrl'], $cookies);
    }

    public function getTsKey()
    {
        return "tx_formrelay_pardot";
    }
}
